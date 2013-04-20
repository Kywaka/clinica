<?php
namespace Clinica\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class AtestadoTable extends AbstractTableGateway
{
    protected $table = 'atestado';
    
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Atestado());
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
    
    public function getAtestado($idAtestado)
    {
        $idAtestado = (int)$idAtestado;
        $rowSet = $this->select(array('id'=> $idAtestado)); //campo ID da tabela
        $row = $rowSet->current();
        
        if(!$row)
        {
            throw new \Exception("Registro não encontrado");
        }
        return $row;
    }
    
    public function saveAtestado(Atestado $atestado)
    {
        $data = array(
            'obs' => $atestado->obs,
            'data' => $atestado->data,
            'hora' => $atestado->hora,
            'nome_dentista' => $atestado->nome_dentista,
            'nome_paciente' => $atestado->nome_paciente,
            
            
        );
        $idAtestado = (int)$atestado->id;
        
        if($idAtestado == 0)
        {//inserir
            $this->insert($data);
        }
        else{ //atualizar
            if($this->getAtestado($idAtestado))
            {
                $this->update($data, array('id' => $idAtestado));
            }
            else
            {
                throw new \Exception("Atestado não encontrado");
            }
        }
    }
    
    public function removerAtestado($idAtestado)
    {
        $idAtestado = (int)$idAtestado;
        if($this->getAtestado($idAtestado))
        {
            $this->delete(array('id'=> $idAtestado));
        }
        else
        {
            throw new \Exception("O atestado não existe");
        }
    }
}
?>
