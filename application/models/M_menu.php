<?php

class M_menu extends CI_Model {

	function get_parent_menu($parentId, $id_user, $id_grup){
		$this->db->select('pb_menu.pbMenuId, pb_menu.pbMenuName, pb_menu.pbMenuUrl, pb_menu.pbMenuIcon, pb_menu.pbMenuTitle, pb_menu.pbParentId, Deriv1.Count');
        $this->db->from('pb_role');
        $this->db->join('pb_user', 'pb_role.pbRoleGroup = pb_user.pbUserGroup');
		$this->db->join('pb_menu', 'pb_role.pbRoleMenu = pb_menu.pbMenuId');
        $this->db->join('(SELECT pbParentId, COUNT(*) AS COUNT FROM `pb_menu` GROUP BY pbParentId) as Deriv1', 'pb_menu.pbMenuId = Deriv1.pbParentId','LEFT');
		$this->db->where('pb_menu.pbParentId', $parentId);
		$this->db->where('pb_menu.pbMenuHidden', '0');
        $this->db->where('pb_role.pbRoleGroup', $id_grup);
		$this->db->where('pb_user.pbUserId', $id_user);
		$this->db->where('pb_role.pbRoleActive','1');
		$this->db->order_by('pb_menu.pbMenuSort');
        $query = $this->db->get();
        //echo "<pre>".$this->db->last_query()."</pre>";
        return $query->result();
	}

	function get_menu_id($menuUri){
		$query = $this->db->get_where('pb_menu',array('pbMenuUrl' => $menuUri));
		if($query->num_rows() > 0){
			foreach ($query->result() as $row) {
				return $row->pbMenuId;
			}
		}else{
				return FALSE;
		}
	}

	function get_authority_grup($id_menu, $id_grup, $id_user){
		$this->db->select('pb_menu.pbMenuId, pb_menu.pbMenuName, pb_menu.pbMenuUrl');
        $this->db->from('pb_role');
        $this->db->join('pb_user', 'pb_role.pbRoleGroup = pb_user.pbUserGroup');
		$this->db->join('pb_menu', 'pb_role.pbRoleMenu = pb_menu.pbMenuId');
        $this->db->where('pb_role.pbRoleGroup', $id_grup);
		$this->db->where('pb_user.pbUserId', $id_user);
		$this->db->where('pb_role.pbRoleActive','1');
		$this->db->where('pb_menu.pbMenuId', $id_menu);
		$this->db->order_by('pb_menu.pbMenuSort');
        $query = $this->db->get();
        
        if($query->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}

	}

	//function for breadcrumb
	function get_parent_menu_breadcrumb($uri){
		$query = $this->db->get_where('pb_menu',array('pbMenuUrl' => $uri));
		return $query->result();
	}

	function get_parent_menu_id_breadcrumb($id){
		$query = $this->db->get_where('pb_menu',array('pbMenuId' => $id));
		return $query->result();
	}
}