<?php
namespace Clinica\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class EstoqueTable extends AbstractTableGateway
{
    protected $table = 'estoque';
    
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Estoque());
        $this->initialize();
    }
    
    public function fetchAll($pageNumber = 1, $countPerPage = 2)
    {
        $select = new Select();
        $select->from($this->table)->order('id');//nome é o campo NOME na tabela
        
        $adapter = new DbSelect($select, $this->adapter, $this->resultSetPrototype);
        
        $paginator = new Paginator($adapter);
        $paginator->setCurrentPageNumber($pageNumber);
        $paginator->setItemCountPerPage($countPerPage);
        
        return $paginator;
    }
    
    public function getEstoque($idEstoque)
    {
        $idEstoque = (int)$idEstoque;
        $rowSet = $this->select(array('id'=> $idEstoque)); //campo ID da tabela
        $row = $rowSet->current();
        
        if(!$row)
        {
            throw new \Exception("Registro não encontrado");
        }
        return $row;
    }
    
    public function saveEstoque(Estoque $estoque)
    {
        $data = array(
            'nome' => $estoque->nome,
            'valor' => $estoque->valor,
            'quantidade' => $estoque->quantidade,
            
            
        );
        $idEstoque = (int)$estoque->id;
        
        if($idEstoque == 0)
        {//inserir
            $this->insert($data);
        }
        else{ //atualizar
            if($this->getEstoque($idEstoque))
            {
                $this->update($data, array('id' => $idEstoque));
            }
            else
            {
                throw new \Exception("Estoque não encontrado");
            }
        }
    }
    
    public function removerEstoque($idEstoque)
    {
        $idEstoque = (int)$idEstoque;
        if($this->getEstoque($idEstoque))
        {
            $this->delete(array('id'=> $idEstoque));
        }
        else
        {
            throw new \Exception("O estoque não existe");
        }
    }
}
?>
