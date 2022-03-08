<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Changepassword extends CI_Controller {

	public function __construct() {

		parent::__construct();

		// Session expire OR try to Login from the URL (Preventing)
		$company = $this->session->userdata( 'company' );

		if ( empty($company) ) {
			$this->session->set_flashdata('msg', 'Your Session has been expired. Please try again.');
			redirect(base_url().'login/login/index');
		}

		// Acount Active / Deactive
		$this->load->model('Check_status_model');
		$companyStatus = $this->Check_status_model->checkStatus( $this->session->userdata['company']['email'] );

		if ( $companyStatus != 1 ) {

			// Destroy session
			$this->session->set_flashdata('msg', 'Your account has been deactivated. Please contact administrator.');
			$this->session->unset_userdata( 'company' );
			redirect(base_url().'login/login/index');
		}
	}

	public function index()	{
        
        $this->load->library('form_validation');
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info($this->session->userdata['company']['email']);

		$this->load->model('Notification_fetch_model');
		$quickNotifications = $this->Notification_fetch_model->get_quick_com_Notifications();
		
		$data['userInfo'] = $userInfo;
		$data['quickNotifications'] = $quickNotifications;

		$this->load->view('company/changepassword', $data);
		
	}
    
	public function changePassword() {

		$this->load->library('form_validation');
		
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info($this->session->userdata['company']['email']);

		$this->form_validation->set_rules('curpassword', 'CurPassword', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Cpassword', 'trim|required|matches[password]');

		if ( $this->form_validation->run() == TRUE) { 

			// Success - Not Empty
			$email = $this->session->userdata['company']['email'];
			$curpassword = $this->input->post('curpassword');
			$password = $this->input->post('password');
			$cpassword = $this->input->post('cpassword');

			
			if ( password_verify( $curpassword, $userInfo['password']) ) {
			 
				if ( $password === $cpassword ) {

					// Passwords Matched
					$this->db->where('user_email', $email);
					$user = $this->db->get('pms_users')->row_array();
					date_default_timezone_set('Asia/Kolkata');

					if ( $user['user_email'] == $email ) {

						// Success - Email correct
						$this->load->model('Change_password_model');
						if ( $this->Change_password_model->changePassword( $email, $password ) ) {
							
							$notiArray['company_id'] = $userInfo['cid'];
							$notiArray['company_notification_class'] = "fab fa-expeditedssl text-warning";
							$notiArray['company_notification_detail'] = "You Changed Account Password.";
							$notiArray['company_notification_created_at'] =  date('Y/m/d H:i:s', time());
							$this->db->insert( 'pms_company_notification', $notiArray );

							$this->session->set_flashdata('msgss', 'Password has been changed Succesfully.');
							redirect( base_url().'company/changepassword/index' );
						}

					} else {

						// Failure - Email incorrect
						$this->session->set_flashdata('msgsf', 'Email not Found.');
						redirect( base_url().'company/changepassword/index' );

					}

				} else {
					
					// Failure - Passwords Mismatch
					$this->session->set_flashdata('msgsf', 'Passwords are not the same.');
					redirect( base_url().'company/changepassword/index' );

				}

			} else {
				
					// Failure - Passwords Mismatch
					$this->session->set_flashdata('msgsf', 'Wrong Current Password.');
					redirect( base_url().'company/changepassword/index' );
			}

		} else {

			// Failure - Invalid Inputs
			$this->index();

		}

	}
}
