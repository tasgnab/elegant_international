<?php
class MUser extends MY_Model {
    function __construct(){
      parent::__construct();
    }

    function count_user($where){
			$this->db->from('user');
			$this->db->where($where);
			return $this->db->count_all_results();;
		}

		function get_failed_attemps($where){
			$this->db->select('failed_attemps');
			$this->db->from('user');
			$this->db->where($where);
			$query = $this->db->get();
			$ret = $query->row();
			return $ret->failed_attemps;
		}

		function update_failed_login($where){
			$this->db->set('failed_attemps', 'failed_attemps+1', FALSE);
			$this->db->set('last_failed', 'CURRENT_TIMESTAMP', FALSE);
			$this->db->set('updated_by', $this->session->userdata('username'));
			$this->db->where($where);
			$this->db->update('user');
		}

		function update_successful_login($where){
			$this->db->set('last_successful', 'CURRENT_TIMESTAMP', FALSE);
			$this->db->set('failed_attemps', 0);
			$this->db->set('updated_by', $this->session->userdata('username'));
			$this->db->where($where);
			$this->db->update('user');
		}

		function update_set_disable($where){
			$data = array('is_disabled' => 'Y');
			$data = $this->appendUpdatedBy($data);
			$this->db->set($data);
			$this->db->where($where);
			$this->db->update('user');
		}

		function update_password($data){
			$data = $this->appendUpdatedBy($data);
			$this->db->where(array('username' => $this->session->userdata('username')));
			$this->db->update('user');
			if ($this->db->affected_rows() == 1){
				return true;
			}
			return false;
		}

}