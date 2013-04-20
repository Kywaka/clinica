<?php
namespace Clinica\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class FuncionarioTable extends AbstractTableGateway
{
    protected $table = 'funcionario';
    
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Funcionario());
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
    
    public function getFuncionario($id)
    {
        $id = (int)$id;
        $rowSet = $this->select(array('id'=> $id)); //campo ID da tabela
        $row = $rowSet->current();
        
        if(!$row)
        {
            throw new \Exception("Registro não encontrado");
        }
        return $row;
    }
    
    public function saveFuncionario(Funcionario $funcionario)
    {
        $data = array(
            'nome' => $funcionario->nome,
            'login' => $funcionario->login,
            'senha' => $funcionario->senha,
            'cargo' => $funcionario->cargo,
            'salario' => $funcionario->salario,
            'cpf' => $funcionario->cpf,
            'endereco'=>$funcionario->endereco,
            'telefone1' => $funcionario->telefone1,
            'telefone2'=> $funcionario->telefone2,
            'email'=> $funcionario->email
            
        );
        $idFuncionario = (int)$funcionario->id;
        
        if($idFuncionario == 0)
        {//inserir
            $this->insert($data);
        }
        else{ //atualizar
            if($this->getFuncionario($idFuncionario))
            {
                $this->update($data, array('id' => $idFuncionario));
            }
            else
            {
                throw new \Exception("Funcionario não encontrado");
            }
        }
    }
    
    public function removerFuncionario($idFuncionario)
    {
        $idFuncionario = (int)$idFuncionario;
        if($this->getFuncionario($idFuncionario))
        {
            $this->delete(array('id'=> $idFuncionario));
        }
        else
        {
            throw new \Exception("O funcionario não existe");
        }
    }
}
?>
