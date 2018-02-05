<?php

class M_article extends CI_Model {

    public function get_all(){
		return $this->mongo_db->select(['_id','title','content','date_published'])->get('artikel');
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
        return $this->mongo_db->where('_id',new MongoDB\BSON\ObjectId("$id"))->get('artikel');
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

	function check_article_title($title, $category){
		$this->db->select('pbArticleTitle');
        $this->db->from('pb_article');
		$this->db->where('pbArticleTitle', $title);
		$this->db->where('pbArticleCategoryId', $category);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            echo 1;
        }
        else {
            echo 0;
        }	
	}

	function update_article_text($data, $articleId){
	//var_dump($data);die();        
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
}

