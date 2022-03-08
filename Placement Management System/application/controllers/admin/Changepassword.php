<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Changepassword extends CI_Controller {

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
        
		$this->load->library('form_validation');
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['admin']['email'] );

		$data['userInfo'] = $userInfo;
		
		$this->load->view('admin/changepassword', $data);
	}
	
	
	public function changePassword() {

		$this->load->library('form_validation');
		
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info($this->session->userdata['admin']['email']);

		$this->form_validation->set_rules('curpassword', 'CurPassword', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Cpassword', 'trim|required|matches[password]');

		if ( $this->form_validation->run() == TRUE) { 

			// Success - Not Empty
			$email = $this->session->userdata['admin']['email'];
			$curpassword = $this->input->post('curpassword');
			$password = $this->input->post('password');
			$cpassword = $this->input->post('cpassword');

			if ( password_verify( $curpassword, $userInfo['password']) ) {

				if ( $password === $cpassword ) {

					// Passwords Matched
					$this->db->where('user_email', $email);
					$user = $this->db->get('pms_users')->row_array();

					if ( $user['user_email'] == $email ) {

						// Success - Email correct
						$this->load->model('Change_password_model');
						$this->Change_password_model->changePassword( $email, $password );

						$this->session->set_flashdata('msgas', 'Password has been changed Succesfully.');
						redirect( base_url().'admin/changepassword/index' );

					} else {

						// Failure - Email incorrect
						$this->session->set_flashdata('msgaf', 'Email not Found.');
						redirect( base_url().'admin/changepassword/index' );

					}

				} else {
					
					// Failure - Passwords Mismatch
					$this->session->set_flashdata('msgaf', 'Passwords are not the same.');
					redirect( base_url().'admin/changepassword/index' );

				}

			} else {
				
				// Failure - Passwords Mismatch
				$this->session->set_flashdata('msgaf', 'Current Password is wrong.');
				redirect( base_url().'admin/changepassword/index' );
			}

		} else {

			// Failure - Invalid Inputs
			$this->index();

		}

	}

}

?>
