<?php

/**
 * Class Database
 *
 * @author     Michel Zuidema <michelgzuidema@gmail.com>
 */
class Database {
	private $host;
	private $username;
	private $password;
	private $database;
	private $connection;

	public function __construct() {
		$this->connect();
	}

	/**
       * 
       * Maakt een connectie met de database
       *
       * @return MySQLi connectie
       */
	public function connect() {
		$this->host = "localhost";
		$this->username = "mzuidema";
		$this->password = "A5f%jc49";
		$this->database = "ekApplicatie";

		$this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

		if($this->connection->connect_error) {
			die("Something went wrong");
		} else {
			return $this->connection;
		}
	}

	/**
       * 
       * Pakt de huidige MySQLi connectie
       *
       * @return MySQLi connectie
       */
	public function getConnection() {
		if($this->connection == null) {
			$this->connect();
		}

		return $this->connection;
	}
}

?>