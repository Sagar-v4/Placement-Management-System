<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admindetail extends CI_Controller {

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

		$data = array();
        
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['admin']['email'] );
        
		$this->load->model('Users_model');
		$admins = $this->Users_model->getAllAdmins();
		
		$this->db->where('user_role', 'admin');
		$status = $this->db->get('pms_users')->result_array();

		$data['userInfo'] = $userInfo;		
		$data['admins'] = $admins;
		$data['status'] = $status;		
		
		$this->load->view('admin/admindetail', $data);
	}

	public function changePower( $aid ) {
	    
	    if ($aid == 1) {
	    	redirect(base_url().'admin/admindetail/index');
	    }

		$this->load->model('Change_status_model');
		$this->Change_status_model->changePower( $aid );

		redirect(base_url().'admin/admindetail/index');

	}
	
	public function changeStatus( $id ) {
	    
	    if ($id == 4) {
	    	redirect(base_url().'admin/admindetail/index');
	    }

		$this->load->model('Change_status_model');
		$this->Change_status_model->changeStatus( $id );

		redirect(base_url().'admin/admindetail/index');

	}
	
	public function resetPW( $id ) {
	    
	    if ($id == 1) {
	    	redirect(base_url().'admin/admindetail/index');
	    }
		
		$this->load->model('Change_password_model');
		$this->load->model('Email_model');
		
        $this->db->where('admin_id', $id);
        $userInfo = $this->db->get('pms_admin_info')->row_array();

		if ( $this->Change_password_model->changePassword(  $userInfo['admin_email'], $userInfo['admin_email'] ) ) {
			
			$emailArray['to'] = $userInfo['admin_email'];
			$emailArray['subject'] = "Alert - Password Reset";
			$emailArray['from'] = "pms.bussiness@gmail.com";
			$emailArray['msg'] = "Your Password has been reset successfully.<br>ID : ".$userInfo['admin_email']."<br>PW : ".$userInfo['admin_email'];

			$this->Email_model->sendEmail($emailArray);

			$this->session->set_flashdata('updateRSMsg','Password Reset successfully.');
		} else {
			$this->session->set_flashdata('updateRFMsg','Password Reset Failed.');
		}

		redirect(base_url().'admin/admindetail/index');
	}
}

?>
