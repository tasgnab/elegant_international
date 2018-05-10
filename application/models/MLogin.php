<?php 

class MLogin extends MY_Model{

	function validateUsername($username){
		$this->db->where('username',$username);
		$result = $this->db->get('login')->num_rows();
		if($result==1)
			return true;
		else
			return false;
	}

	function validateLogin($data){
		$this->db->where($data);
		$result = $this->db->get('login')->num_rows();
		if($result==1)
			return true;
		else
			return false;
	}

	function getUserData($username){
		$this->db->select('*');
		$this->db->where('username',$username);
		return $this->db->get('login')->row();	
	}

	function getFailedAttempt($username){
		$this->db->select('failed_attempt');
		$this->db->from('login');
		$this->db->where('username',$username);
		$result = $this->db->get()->row();
		return $result->failed_attempt;
	}

	function validateLastFailedAttempt($username){
		$query = $this->db->query("SELECT * FROM login WHERE ( UNIX_TIMESTAMP(current_timestamp) - UNIX_TIMESTAMP( last_failed_attempt ) <= ".$this->config->item('cfg_lock_duration')." ) and username = ".$this->db->escape($username));
		if ($query->num_rows()==1){
			return true;
		} else {
			return false;
		}
	}

	function updateFailedAttempt($username){
		$this->db->set('failed_attempt','failed_attempt+1', FALSE);
		$this->db->set('last_failed_attempt','NOW()', FALSE);
		$this->db->where('username',$username);
		$this->db->update('login');
	}

	function updateSuccessfulLogin($username){
		$this->db->set('failed_attempt',0);
		$this->db->set('last_login','NOW()', FALSE);
		$this->db->where('username',$username);
		$this->db->update('login');
	}

	function changePassword($username,$data){
		$this->db->set($data);
		$this->db->where('username',$username);
		$this->db->update('login');
	}
}
?>