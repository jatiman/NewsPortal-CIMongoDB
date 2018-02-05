<?php

class M_dashboard extends CI_Model {

    function articles() {
        return $this->mongo_db->select(['_id','title','content','date_published'])->get('artikel');
    }

    function total_articles(){
        return $this->mongo_db->count('artikel');
    }

    function total_comments(){
        return $this->mongo_db->count('comment');
    }
	
    function article_rank() {
       return $this->mongo_db->select(['_id','title','content','date_published'])->get('artikel');
    }
}