<?php
namespace Service;
use PDO;
use PDOException;

class Database
{
	private $host;
	private $user;
	private $password;
	private $database_name;
	private $dbh;
	private $error;
	private $stmt;
	private $arrConfig;

	public function __construct($arrConfig)
	{
		$this->database_name = $arrConfig['database_name'];
		$this->host = $arrConfig['database_host'];
		$this->user = $arrConfig['database_user'];
		$this->password = $arrConfig['database_password'];

		//set DSN
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->database_name;
		//set options
		$options = array(
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		);
		try {
			$this->dbh = new PDO($dsn, $this->user, $this->password, $options);
		} catch (PDOException $e) {

			$this->error = $e->getMessage();
		}
	}
	/**
	 * This runs the query
	 * @param string $query - mysql query
	 */
	public function query($query)
	{
		$this->stmt = $this->dbh->prepare($query);
	}

	/**
	 * This binds params to the query
	 * @param string $param - parameter to bind
	 * @param string $value - value of the param
	 * @param string $type - optional type
	 */
	public function bind($param, $value, $type = null)
	{
		if (is_null($type)) {
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}

	/**
	 * This returns last insert id
	 * @return int - last insert id
	 */
	public function lastInsertId()
	{
		return $this->dbh->lastInsertId();
	}

	/**
	 * This executes the query
	 * @param array - parameters
	 */
	public function execute($params = array())
	{
		if (empty($params)) {
			return $this->stmt->execute();
		} else {
			return $this->stmt->execute($params);
		}
	}

	/**
	 * This gets single row
	 * @param array - parameters
	 * @return array - returns assoc array
	 */
	public function resultsingle($params = array())
	{
		if (empty($params)) {
			$this->execute();
		} else {
			$this->stmt->execute($params);
		}
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * This gets multiple rows
	 * @param array - parameters
	 * @return array - returns multidimentional assoc array
	 */
	public function resultset($params = array())
	{
		if (empty($params)) {
			$this->execute();
		} else {
			$this->stmt->execute($params);
		}
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}
