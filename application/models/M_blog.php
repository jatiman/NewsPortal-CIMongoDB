<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class M_blog extends CI_Model {

		private $grid_fs;

		public function __construct() {
			parent::__construct();
			$this->grid_fs = $this->mongo_db->db->getGridFS();
		}

		public function get(){
			return $this->mongo_db->select(['_id','title','content','date_published','image_metadata'])->get('artikel');
		}

		public function get_where(){
			//return $this->mongo_db->aggregate('comment',['$group' => ['_id' => "artikel_id",'total'=>['sum'=>'']]]);
                     				//{ $sort => { 'total'=> -1 } }]
			return $this->mongo_db->select(['_id','title','content','date_published'])->get('artikel');
		}

		public function get_detail($id){
			return $this->mongo_db->where(array('_id' => new MongoId($id)))->get('artikel');
		}

		public function insert($table,$data){
			return $this->mongo_db->insert($table,$data);
		}

		public function cariBerita($src){
			return $this->mongo_db->like('title',$src,'im',TRUE,TRUE)->get('artikel');
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


		public function get_image_from_filestream($where) {
			return $this->grid_fs->findOne($where);
		}
}
/* End of file M_blog.php */
/* Location: ./application/models/M_blog.php */
