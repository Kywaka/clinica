<?php
$db = array(
    
    'database' => 'clinica',
    'username' => 'root',
    'password' => '123',
    'hostname' => 'localhost',
);

return array(
    
    'service_manager' => array(
        'factories' => array(
            'zend_db_adapter' => function ($sm) use ($db){
                return new Zend\Db\Adapter\Adapter(array(
                    'driver' => 'pdo',
                    'dsn' => 'mysql:dbname='.$db['database']. ';host='. $db['hostname'],
                    'database' => $db['database'],
                    'username' => $db['username'],
                    'password' => $db['password'],
                    'hostname' => $db['hostname'],
                    
                ));
            }
        )
    )
    
);
?>