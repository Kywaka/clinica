<?php
namespace Clinica\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class ReceituarioTable extends AbstractTableGateway
{
    protected $table = 'receituario';
    
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Receituario());
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
    
    public function getReceituario($idReceituario)
    {
        $idReceituario = (int)$idReceituario;
        $rowSet = $this->select(array('id'=> $idReceituario)); //campo ID da tabela
        $row = $rowSet->current();
        
        if(!$row)
        {
            throw new \Exception("Registro não encontrado");
        }
        return $row;
    }
    
    public function saveReceituario(Receituario $receituario)
    {
        $data = array(
            'obs' => $receituario->obs,
            'medicacao' => $receituario->medicacao,
            'nome_dentista' => $receituario->nome_dentista,
            'nome_paciente' => $receituario->nome_paciente,
            
            
        );
        $idReceituario = (int)$receituario->id;
        
        if($idReceituario == 0)
        {//inserir
            $this->insert($data);
        }
        else{ //atualizar
            if($this->getReceituario($idReceituario))
            {
                $this->update($data, array('id' => $idReceituario));
            }
            else
            {
                throw new \Exception("Receituario não encontrado");
            }
        }
    }
    
    public function removerReceituario($idReceituario)
    {
        $idReceituario = (int)$idReceituario;
        if($this->getReceituario($idReceituario))
        {
            $this->delete(array('id'=> $idReceituario));
        }
        else
        {
            throw new \Exception("O receituario não existe");
        }
    }
}
?>
