<?php

class M_management_user extends CI_Model {

    function get_all() {
        return $this->mongo_db->select(['_id','realname','username'])->get('user');
    }

    function get_all_group() {
        $this->db->select('*');
        $this->db->from('pb_group');
		$this->db->order_by('pbGroupName','asc');
        $query = $this->db->get();
        return $query->result();
    }
	
	function get_user_by_id($id) {
        return $this->mongo_db->where('_id',new MongoId("$id"))->get('user');
    }
	
	function insert_user($data){
		return $this->mongo_db->insert('user', $data);
    }
	
	function update_user($data, $userId){
        return $this->mongo_db->set($data)->where('_id',new MongoId("$userId"))->update('user');		
    }
	
	function delete_user($id) {
        $query = $this->mongo_db->where('_id',new MongoId("$id"))->delete('user');
        if ($query) { 
			echo 1; 
	    } 
	    else { 
	    	echo 0; 
	    }  
	}
	
	function check_username($username){
		$res = $this->mongo_db->where('username',$username)->get('user');

        if (count($res) > 0) {
            echo 1;
        }else {
            echo 0;
        }	
	}

	function get_file_name($userId){
		$this->db->select('pbUserPic');        
		$this->db->where('pbUserId', $userId);
        $query = $this->db->get('pb_user');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
            	return $row->pbUserPic;
            }
        }else {
            echo 0;
        }
	}
}

