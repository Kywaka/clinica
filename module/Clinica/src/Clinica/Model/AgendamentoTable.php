<?php
namespace Clinica\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class AgendamentoTable extends AbstractTableGateway
{
    protected $table = 'agendamento';
    
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Agendamento());
        $this->initialize();
    }
    
    public function fetchAll($pageNumber = 1, $countPerPage = 2)
    {
        $select = new Select();
        $select->from($this->table)->order('agendamento_id');//nome é o campo NOME na tabela
        
        $adapter = new DbSelect($select, $this->adapter, $this->resultSetPrototype);
        
        $paginator = new Paginator($adapter);
        $paginator->setCurrentPageNumber($pageNumber);
        $paginator->setItemCountPerPage($countPerPage);
        
        return $paginator;
    }
    
    public function getAgenadamento($idAgendamento)
    {
        $idAgendamento = (int)$idAgendamento;
        $rowSet = $this->select(array('agendamento_id'=> $idAgendamento)); //campo ID da tabela
        $row = $rowSet->current();
        
        if(!$row)
        {
            throw new \Exception("Registro não encontrado");
        }
        return $row;
    }
    
    public function saveAgendamento(Agendamento $agendamento)
    {
        $data = array(
            'agendamento_nome' => $agendamento->agendamento_nome,
            'agendamento_data_nasc' => $agendamento->agendamento_data_nasc,
            'agendamento_cpf' => $agendamento->agendamento_cpf,
            'agendamento_endereco' => $agendamento->agendamento_endereco,
            'agendamento_forma_pgto' => $agendamento->agendamento_forma_pgto,
            'agendamento_telefone' => $agendamento->agendamento_telefone,
            'agendamento_celular'=>$agendamento->agendamento_celular,
            'agendamento_email' => $agendamento->agendamento_email,
            'agendamento_login'=> $agendamento->agendamento_login,
            'agendamento_senha'=> $agendamento->agendamento_senha
            
        );
        $idAgendamento = (int)$agendamento->agendamento_id;
        
        if($idAgendamento == 0)
        {//inserir
            $this->insert($data);
        }
        else{ //atualizar
            if($this->getAgendamento($idAgendamento))
            {
                $this->update($data, array('agendamento_id' => $idAgendamento));
            }
            else
            {
                throw new \Exception("Agendamento não encontrado");
            }
        }
    }
    
    public function removerAgendamento($idAgendamento)
    {
        $idAgendamento = (int)$idAgendamento;
        if($this->getAgendamento($idAgendamento))
        {
            $this->delete(array('agendamento_id'=> $idAgendamento));
        }
        else
        {
            throw new \Exception("O agendamento não existe");
        }
    }
}
?>
