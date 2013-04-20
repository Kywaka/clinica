<?php
namespace Clinica\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class PacienteTable extends AbstractTableGateway
{
    protected $table = 'paciente';
    
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Paciente());
        $this->initialize();
    }
    
    public function fetchAll($pageNumber = 1, $countPerPage = 2)
    {
        $select = new Select();
        $select->from($this->table)->order('paciente_id');//nome é o campo NOME na tabela
        
        $adapter = new DbSelect($select, $this->adapter, $this->resultSetPrototype);
        
        $paginator = new Paginator($adapter);
        $paginator->setCurrentPageNumber($pageNumber);
        $paginator->setItemCountPerPage($countPerPage);
        
        return $paginator;
    }
    
    public function getPaciente($idPaciente)
    {
        $idPaciente = (int)$idPaciente;
        $rowSet = $this->select(array('paciente_id'=> $idPaciente)); //campo ID da tabela
        $row = $rowSet->current();
        
        if(!$row)
        {
            throw new \Exception("Registro não encontrado");
        }
        return $row;
    }
    
    public function savePaciente(Paciente $paciente)
    {
        $data = array(
            'paciente_nome' => $paciente->paciente_nome,
            'paciente_data_nasc' => $paciente->paciente_data_nasc,
            'paciente_cpf' => $paciente->paciente_cpf,
            'paciente_endereco' => $paciente->paciente_endereco,
            'paciente_forma_pgto' => $paciente->paciente_forma_pgto,
            'paciente_telefone' => $paciente->paciente_telefone,
            'paciente_celular'=>$paciente->paciente_celular,
            'paciente_email' => $paciente->paciente_email,
            'paciente_login'=> $paciente->paciente_login,
            'paciente_senha'=> $paciente->paciente_senha
            
        );
        $idPaciente = (int)$paciente->paciente_id;
        
        if($idPaciente == 0)
        {//inserir
            $this->insert($data);
        }
        else{ //atualizar
            if($this->getPaciente($idPaciente))
            {
                $this->update($data, array('paciente_id' => $idPaciente));
            }
            else
            {
                throw new \Exception("Paciente não encontrado");
            }
        }
    }
    
    public function removerPaciente($idPaciente)
    {
        $idPaciente = (int)$idPaciente;
        if($this->getPaciente($idPaciente))
        {
            $this->delete(array('paciente_id'=> $idPaciente));
        }
        else
        {
            throw new \Exception("O paciente não existe");
        }
    }
}
?>
