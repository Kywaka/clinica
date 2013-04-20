<?php
namespace Clinica\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class FornecedorTable extends AbstractTableGateway
{
    protected $table = 'fornecedor';
    
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Fornecedor());
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
    
    public function getFornecedor($idFornecedor)
    {
        $idFornecedor = (int)$idFornecedor;
        $rowSet = $this->select(array('id'=> $idFornecedor)); //campo ID da tabela
        $row = $rowSet->current();
        
        if(!$row)
        {
            throw new \Exception("Registro não encontrado");
        }
        return $row;
    }
    
    public function saveFornecedor(Fornecedor $fornecedor)
    {
        $data = array(
            'nome' => $fornecedor->nome,
            'cnpj' => $fornecedor->cnpj,
            'endereco' => $fornecedor->endereco,
            'telefone1' => $fornecedor->telefone1,
            'telefone2' => $fornecedor->telefone2,
            'email'=>$fornecedor->email,
            
        );
        $idFornecedor = (int)$fornecedor->id;
        
        if($idFornecedor == 0)
        {//inserir
            $this->insert($data);
        }
        else{ //atualizar
            if($this->getFornecedor($idFornecedor))
            {
                $this->update($data, array('id' => $idFornecedor));
            }
            else
            {
                throw new \Exception("Fornecedor não encontrado");
            }
        }
    }
    
    public function removerFornecedor($idFornecedor)
    {
        $idFornecedor = (int)$idFornecedor;
        if($this->getFornecedor($idFornecedor))
        {
            $this->delete(array('id'=> $idFornecedor));
        }
        else
        {
            throw new \Exception("O fornecedor não existe");
        }
    }
}
?>