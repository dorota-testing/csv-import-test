<?php
namespace Service;
use Model\User;
class UserHandler
{

	private $database;
	private $arrConfig;

	function __construct(array $arrConfig, Database $objDatabase)
	{
		$this->database = $objDatabase;
		$this->arrConfig = $arrConfig;
	}

	public function sayHello(){
    return 'Hello';
  }

	/** 
	 * Returns array of values of one user
	 * @param int $id - if specified, will return user with this id
	 * @param string $email - if specified, will return user with this email
	 */

	public function get_user_by_email_or_id(int $id, string $email)
	{
		//prepare users
		$result = array();

		if ($id != '' && ctype_digit($id) && $email == '') {
			$this->database->query('SELECT * FROM users WHERE userid=:userid');
			$this->database->bind(':userid', $id);
			$result = $this->database->resultsingle();
			if (!empty($result)) {
				return $result;
			}
		}
		if ($email != '' && $id == '') {
			$this->database->query('SELECT * FROM users WHERE email=:email');
			$this->database->bind(':email', $email);
			$result = $this->database->resultsingle();
			if (!empty($result)) {
				return $result;
			}
		}
		return;
	}

	/**
	 *  returns array of User objects
	 */
	public function get_users()
	{
		//prepare users
		$users = array();

		$usersData = $this->query_for_users();
		foreach ($usersData as $userData) {
			$users[] = $this->createUserFromData($userData);
		}
		return $users;
	}

	private function query_for_users()
	{
		$result = array();

		$this->database->query("SELECT * FROM users ");

		$result = $this->database->resultset();
		return $result;
	}

	/** 
	 * this turns database result into an object (fills in empty object User form model class)
	 */
	private function createUserFromData(array $userData)
	{
		$user = new User();
		$user->setId($userData['id']);
		$user->setEmail($userData['email']);
		$user->setForename($userData['forename']);
		$user->setSurname($userData['surname']);
		$user->setPassword($userData['password']);
		$user->setRole($userData['role']);
		return $user;
	}
}
