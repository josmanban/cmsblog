<?php

namespace Librerias;

use \PDO;
use \PDOException;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AccesoDatos {

    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $dbName = DB_NAME;
    private $connection;
    private static $instance = null;

    private function __construct() {
        try {
            $this->connection = new PDO(
                    'mysql:host=' . $this->host . ';dbname=' . $this->dbName . ';charset=utf8', $this->user, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {

            throw $e;
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new AccesoDatos();
        }

        return self::$instance;
    }

    public function getHost() {
        return $this->host;
    }

    public function getUser() {
        return $this->user;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getDbName() {
        return $this->dbName;
    }

    public function getConnection() {
        if (!$this->connection) {
            $this->AccesoDatos();
        }
        return $this->connection;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setDbName($dbName) {
        $this->dbName = $dbName;
    }

    public function setConnection($connection) {
        $this->connection = $connection;
    }

    public function open() {
        
    }

    public function close() {
        $this->connection = null;
        self::$instance = null;
    }

    public function executeQuery($query, $parameters = []) {
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($parameters);
            if (stripos($query, 'INSERT') === false || stripos($query, 'INSERT') <> 0)
                return $stmt->rowCount();
            else
                return $this->connection->lastInsertId();
        } catch (\Exception $e) {
            $this->close();
            throw $e;
        }
    }

    public function getResult($query, $parameters) {
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($parameters);
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $rows;
        } catch (\Exception $e) {
            $this->close();
            throw $e;
        }
    }

    public function getCell($query, $parameters) {
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($parameters);
            $rows = $stmt->fetchAll(\PDO::FETCH_NUM);
            return $rows[0][0];
        } catch (\Exception $e) {
            $this->close();
            throw $e;
        }
    }

    public function beginTransaction() {
        $this->connection->beginTransaction();
    }

    public function commit() {
        $this->connection->commit();
    }

    public function rollBack() {
        $this->connection->rollBack();
        $this->close();
    }

    public function executeTransaction() {
        
    }

}
