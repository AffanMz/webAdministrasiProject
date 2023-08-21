<?php 

class Login_model {
	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function configLog($user, $pw) {
		$this->db->query('SELECT * FROM data_user WHERE username = :nama');
		$this->db->bind('nama',$user);
		$data = $this->db->single();

		if ($data == NULL) {
			return 1;
		} elseif ($data['pass'] != $pw) {
			return 2;
		} else {
			$_SESSION['data'] = $data['id_admin'];
			return 3;
		}
	}

	public function getDataById($id) {
		$this->db->query('SELECT * FROM data_user WHERE id_admin = :id');
		$this->db->bind('id',$id);
		return $this->db->single();
	}
	
}