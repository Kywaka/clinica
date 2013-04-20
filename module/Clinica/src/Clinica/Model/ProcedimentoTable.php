<?php
namespace Clinica\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class ProcedimentoTable extends AbstractTableGateway
{
    protected $table = 'procedimento';
    
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Procedimento());
        $this->initialize();
    }
    
    public function fetchAll($pageNumber = 1, $countPerPage = 2)
    {
        $select = new Select();
        $select->from($this->table)->order('idProcedimento');//nome é o campo NOME na tabela
        
        $adapter = new DbSelect($select, $this->adapter, $this->resultSetPrototype);
        
        $paginator = new Paginator($adapter);
        $paginator->setCurrentPageNumber($pageNumber);
        $paginator->setItemCountPerPage($countPerPage);
        
        return $paginator;
    }
    
    public function getProcedimento($idProcedimento)
    {
        $idProcedimento = (int)$idProcedimento;
        $rowSet = $this->select(array('idProcedimento'=> $idProcedimento)); //campo ID da tabela
        $row = $rowSet->current();
        
        if(!$row)
        {
            throw new \Exception("Registro não encontrado =>".$idProcedimento);
        }
        return $row;
    }
    
    public function saveProcedimento(Procedimento $procedimento)
    {
        $data = array(
            'nome' => $procedimento->nome,
            'valor' => $procedimento->cnpj,
            
        );
        $idProcedimento = (int)$procedimento->idProcedimento;
        
        if($idProcedimento == 0)
        {//inserir
            $this->insert($data);
        }
        else{ //atualizar
            if($this->getProcedimento($idProcedimento))
            {
                $this->update($data, array('idProcedimento' => $idProcedimento));
            }
            else
            {
                throw new \Exception("Procedimento não encontrado".$idProcedimento);
            }
        }
    }
    
    public function removerProcedimento($idProcedimento)
    {
        $idProcedimento = (int)$idProcedimento;
        if($this->getProcedimento($idProcedimento))
        {
            $this->delete(array('idProcedimento'=> $idProcedimento));
        }
        else
        {
            throw new \Exception("O Procedimento não existe");
        }
    }
}
?>