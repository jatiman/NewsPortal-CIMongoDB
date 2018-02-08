<?php

class M_article extends CI_Model {

	private $grid_fs;

	public function __construct() {
		parent::__construct();
		$this->grid_fs = $this->mongo_db->db->getGridFS();
	}

    public function get_all(){
		return $this->mongo_db->select(['_id','title','content','date_published','category','image_metadata'])->get('artikel');
    }
	
	function insert_article_text($table,$data){
        return $this->mongo_db->insert($table, $data);
	}

    function get_article_by_id($id){
        return $this->mongo_db->where(array('_id' => new MongoId($id)))->get('artikel');
    }

	function delete_article($id) {
        $query = $this->mongo_db->where(array('_id' => new MongoId($id)))->delete('artikel');

		if ($query) { 
			echo 1; 
	    } 
	    else { 
	    	echo 0; 
	    } 
	}

	function check_article_title($title){
        $query = $this->mongo_db->where('title',$title)->get('artikel');

        if (count($query) > 0) {
            echo 1;
        }
        else {
            echo 0;
        }	
	}

	function update_article_text($data, $articleId){
		return $this->mongo_db->set($data)->where(array('_id' => new MongoId($id)))->update('artikel');
    }

	// add image
	public function insert_image_filestream($data, $options, $is_edit) {
		return $this->grid_fs->storeUpload($data, $options);
	}

	public function insert_data($table_name, $data) {
		return $this->mongo_db->insert($table_name, $data);
	}

	public function get_image_from_filestream($where) {
		return $this->grid_fs->findOne($where);
	}

	public function get_list_category() {
		$arr = ['otomotif', 'sport', 'tekno'];
		$data = [];
		foreach ($arr as $key => $value) {
			$tmp = new stdClass();
			$tmp->value = $value;
			$tmp->name = ucfirst($value);
			array_push($data, $tmp);
			unset($tmp);
		}
		return $data;
	}

	public function update_data($table_name, $data, $where) {
		return $this->mongo_db->where($where)->set($data)->update($table_name);
	}

}

