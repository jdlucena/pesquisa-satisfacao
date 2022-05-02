<?php

abstract class Conexao
{
	protected $db_connection = null;
    protected $db_mysql = null;
    public $messages = [];
    public $errors = [];

    // conexão com o banco SQL
    protected function __construct()
    {
        // se a conexão já existe
        if ($this->db_connection != null) {
            return true;            
        } else {
            try {
                // conexão com o banco SQL usando PDO
                $this->db_connection = new PDO("sqlsrv:Server=".DB_HOST.";Database=".DB_NAME, DB_USER, DB_PASS);
                $this->db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return true;
            } catch (PDOException $e) {
                $this->errors[] = $e->getMessage();
            }
        }

        // retorno padrão
        return false;
    }

    // conexão com o banco MySQL
    protected function conexaoMysql()
    {
        // se a conexão já existe
        if ($this->db_mysql != null) {
            return true;
        } else {
            try {
                // conexão com o banco usando PDO com charset por razões de segurança:
                // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
                // @see http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers#Connecting_to_MySQL says:
                $this->db_mysql = new PDO('mysql:host=' . DM_HOST . ';dbname=' . DM_NAME . ';charset=utf8', DM_USER, DM_PASS);
                return true;
            } catch (PDOException $e) {
                $this->errors[] = $e->getMessage();
            }
        }
        // retorno padrão
        return false;
    }
}
