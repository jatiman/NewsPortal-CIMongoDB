<?php

class M_article extends CI_Model {

	private $grid_fs;

	public function __construct() {
		parent::__construct();
		$this->grid_fs = $this->mongo_db->db->getGridFS();
	}

    public function get_all(){
		return $this->mongo_db->select(['_id','title','content','time_publish','category'])->get('artikel');
    }
	
	function insert_article_text($table,$data){
        return $this->mongo_db->insert($table, $data);
	}

    function insert_article_image($data){
		$this->db->trans_begin();
        $this->db->insert('pb_article_image', $data);
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		}
		else {
			$this->db->trans_commit();
			return 1;
		}
    }

    function insert_article_video($data){
		$this->db->trans_begin();
        $this->db->insert('pb_article_video', $data);
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		}
		else {
			$this->db->trans_commit();
			return 1;
		}
    }

    function get_status_by_article($id){
    	$this->db->select('pbArticleStatusPublish');
    	$this->db->where('pbArticleId',$id);
    	$query = $this->db->get('pb_article');
    	return $query->result();
    }
	
    function get_article_by_id($id){
        return $this->mongo_db->where(array('_id' => new MongoId($id)))->get('artikel');
    }
    function get_article_by_id_mobile($id){
        $query = $this->db->get_where('pb_article',array('pbArticleId'=>$id));
       	$row = $query->row();
    }

    function get_article_video_by_id($id){
        $query = $this->db->get_where('pb_article_video',array('pbArticleVideoArticleId'=>$id));
        return $query->result();
    }

    function get_article_image_by_id($id){
        $query = $this->db->get_where('pb_article_image',array('pbArticleImageArticleId'=>$id));
        return $query->result();
    }
	
	function get_file_name($id){
		$query = $this->db->get_where('pb_article_image',array('pbArticleImageArticleId' => $id));
		return $query->result();
	}

	function delete_article($id) {
        $query = $this->mongo_db->where('_id',new MongoDB\BSON\ObjectId("$id"))->delete('artikel');

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
		return $this->mongo_db->set($data)->where('_id',new MongoDB\BSON\ObjectId("$articleId"))->update('artikel');
    }

    function update_article_video($data, $videoId){
        $this->db->trans_begin();
		$this->db->where('pbArticleVideoId', $videoId);
		$this->db->update('pb_article_video', $data);
        
        if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		}
		else {
			$this->db->trans_commit();
			return 1;
		}		
    }

    function get_file_name_perpic($id){
		$query = $this->db->get_where('pb_article_image',array('pbArticleImageId' => $id));
		return $query->result();
	}

	function delete_image($id) {
        $query = $this->db->delete('pb_article_image', array('pbArticleImageId' => $id));

		 if ($query) { 
			echo 1; 
	    } 
	    else { 
	    	echo 0; 
	    } 
	}

	function delete_video($id) {
        $query = $this->db->delete('pb_article_video', array('pbArticleVideoId' => $id));

		if ($query) { 
			return 1; 
	    } 
	    else { 
	    	return 0; 
	    }
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

