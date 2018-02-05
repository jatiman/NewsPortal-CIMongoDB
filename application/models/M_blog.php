<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class M_blog extends CI_Model {

		public function get(){
			return $this->mongo_db->select(['_id','title','content','date_published'])->get('artikel');
		}

		public function get_where(){
			//return $this->mongo_db->aggregate('comment',['$group' => ['_id' => "artikel_id",'total'=>['sum'=>'']]]);
                     				//{ $sort => { 'total'=> -1 } }]
			return $this->mongo_db->select(['_id','title','content','date_published'])->get('artikel');
		}

		public function get_detail($id){
			return $this->mongo_db->where('_id',new MongoDB\BSON\ObjectId("$id"))->get('artikel');
		}

		public function insert($table,$data){
			return $this->mongo_db->insert($table,$data);
		}

		public function cariBerita($src){
			return $this->mongo_db->where('title',new MongoDB\BSON\Regex("$src"))->get('artikel');
		}

		public function get_sport(){
			return $this->mongo_db->where('category','sport')->get('artikel');
		}

		public function get_tekno(){
			return $this->mongo_db->where('category','tekno')->get('artikel');
		}

		public function get_oto(){
			return $this->mongo_db->where('category','otomotif')->get('artikel');
		}
}
/* End of file M_blog.php */
/* Location: ./application/models/M_blog.php */
