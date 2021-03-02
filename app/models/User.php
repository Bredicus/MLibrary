<?php
class User extends Model 
{
	var $user_id; //int
	var $username; //str
	var $email; //str
	var $role; //enum
	var $password_hash; //str
	var $confirmed; //bool
    
	public function find($user_id) {
		$SQL = 'SELECT * FROM User WHERE user_id = :user_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['user_id' => $user_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
		return $stmt->fetch();
    }    
    
	public function findUser($username) {
		$SQL = 'SELECT * FROM User WHERE username = :username';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['username' => $username]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
		return $stmt->fetch();
    }        
    
    public function create() {
		$SQL = 'INSERT INTO User(username, password_hash) VALUE(:username, :password_hash)';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['username' => $this->username, 'password_hash' => $this->password_hash]);
		return $stmt->rowCount();	
	} 
}
?>