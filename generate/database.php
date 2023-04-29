<?php

class Database
{
    // DB Params
    private $_host = 'localhost';
    private $_port = '3307';
    private $_db_name = 'sales_db';
    private $_username = 'root';
    private $_password = '';
    private $_connection;

    // DB Connect
    public function initConnection()
    {
        $this->_connection = null;

        try {
            $this->_connection = new PDO('mysql:host=' . $this->_host . ';port=' . $this->_port . ';dbname=' . $this->_db_name, $this->_username, $this->_password);
            $this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exp) {
            echo 'Connection Error: ' . $exp->getMessage();
        }

        return $this->_connection;
    }
}
