<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_status_model extends CI_Model {

	public function changeStatus( $id ) {

		$this->db->where('user_id', $id);
		$userStatus = $this->db->get('pms_users')->row_array();

		if ( $userStatus['user_status'] == 1) {

			$update = array('user_status' => 0);
			$this->db->where('user_id', $id);
			$this->db->update('pms_users', $update);

		} elseif ( $userStatus['user_status'] == 0) {

			$update = array('user_status' => 1);
			$this->db->where('user_id', $id);
			$this->db->update('pms_users', $update);

		}

	}
	
	public function changePower( $aid ) {

		$this->db->where('admin_id', $aid);
		$userPower = $this->db->get('pms_admin_info')->row_array();

		if ( $userPower['admin_power'] == 1) {

			$update = array('admin_power' => 0);
			$this->db->where('admin_id', $aid);
			$this->db->update('pms_admin_info', $update);

		} elseif ( $userPower['admin_power'] == 0) {

			$update = array('admin_power' => 1);
			$this->db->where('admin_id', $aid);
			$this->db->update('pms_admin_info', $update);

		}

	}
}
