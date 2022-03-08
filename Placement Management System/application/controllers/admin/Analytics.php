<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analytics extends CI_Controller {

	public function __construct() {

		parent::__construct();

		// Session expire OR try to Login from the URL (Preventing)
		$admin = $this->session->userdata( 'admin' );

		if ( empty($admin) ) {
			$this->session->set_flashdata('msg', 'Your Session has been expired. Please try again.');
			redirect(base_url().'login/login/index');
		}

		// Acount Active / Deactive
		$this->load->model('Check_status_model');
		$adminStatus = $this->Check_status_model->checkStatus( $this->session->userdata['admin']['email'] );

		if ( $adminStatus != 1 ) {

			// Destroy session
			$this->session->set_flashdata('msg', 'Your account has been deactivated. Please contact administrator.');
			$this->session->unset_userdata( 'admin' );
			redirect(base_url().'login/login/index');
		}

	}

	public function index()	{
	    
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['admin']['email'] );

		$studentGender =  $this->db->select('student_gender, count(*) as gender')->group_by('student_gender')->get('pms_student_info')->result_array();

		$totalUsers = $this->db->select('user_role, count(*) as role')->group_by('user_role')->get('pms_users')->result_array();

		function getDbSize() {
        
			$CI =& get_instance();
			
			$dbName = $CI->db->database;
			
			$dbName = $CI->db->escape($dbName);
			
			$sql = "SELECT table_schema AS db_name, sum( data_length + index_length ) / 1024 / 1024 AS db_size_mb
					FROM information_schema.TABLES
					WHERE table_schema = $dbName
					GROUP BY table_schema ;";
			
			$query = $CI->db->query($sql);
			
			if ($query->num_rows() == 1) {
			   $row = $query->row();
			   $size = $row->db_size_mb;
			   return round($size, 2); // mb
			} else {
				log_message('ERROR', "*** Unexpected number of rows returned " . ' | line ' . __LINE__ . ' of ' . __FILE__);
				show_error('Sorry, an error has occured.');
				
			}
		}
		// Database Size
		$databaseSize = getDbSize();

		// Calculating Size
		$projectTotalSize = 120.21;
		$projectMediaSize = 4.81;

		$data['userInfo'] = $userInfo;
		$data['studentGender'] = $studentGender;
		$data['projectTotalSize'] = $projectTotalSize - $projectMediaSize;
		$data['projectMediaSize'] = $projectMediaSize;
		$data['databaseSize'] = $databaseSize;
		$data['totalSize'] = $databaseSize + $projectTotalSize;

		$data['totalUsers'] = $totalUsers;

		$this->load->view('admin/analytics', $data);
	}
}

?>
