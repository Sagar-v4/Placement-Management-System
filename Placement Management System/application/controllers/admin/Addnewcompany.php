<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addnewcompany extends CI_Controller {

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
		
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['admin']['email'] );

		
		if ( $userInfo['power'] != 1 ) {
		    
		    $data['userInfo'] = $userInfo;		
		    $this->load->view('admin/profile', $data);

		}

	}

	public function index()	{
        
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['admin']['email'] );

		$data['userInfo'] = $userInfo;		
		
		if ( $userInfo['power'] == 1 ) {
		    
		    $data['userInfo'] = $userInfo;	
		    
		    $this->load->view('admin/addnewcompany', $data);

		} else {
		    
		    $this->load->view('admin/profile', $data);
		
		}

	}

	public function authenticate() {

		// Load Libraries & Models
		$this->load->library('form_validation');
		$this->load->model('Company_info_model');
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[pms_users.user_email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ( $this->form_validation->run() == TRUE) {

			$companyArray = array();

			$companyArray['company_name'] = $this->input->post('name');
			$companyArray['company_email'] = $this->input->post('email');
			$companyArray['company_password'] = password_hash( $this->input->post('password'), PASSWORD_DEFAULT);

			// Store Data In Database
			if ( !empty($companyArray) ) {

				// company array is not empty - success !
				$this->Company_info_model->store_company_data($companyArray);
				
				$emailArray['to'] = $this->input->post('email');
				$emailArray['subject'] = "Welcome";
				$emailArray['from'] = "pms.bussiness@gmail.com";
				$emailArray['msg'] = "Hello,".$companyArray['company_name']." Thanks for Sign Up !!!";
				
				$this->load->model('Email_model');
				$this->Email_model->sendEmail($emailArray);

				$this->session->set_flashdata('signuplogCMsg','Company account has been created successfully.');
				redirect( base_url().'admin/addnewcompany' );
		
			} else {

				// When Inserted Data is Empty - Failure !
				$this->session->set_flashdata('signupCMsg','Please insert data to create an accout.');
				// $this->load->view('admin/addnewcompany');
				$this->index();

			}

		} else {

			// Failure !
			$this->session->set_flashdata('signupCMsg','Please insert all the required fields with proper values to create an accout.');
// 			$this->load->view('admin/addnewcompany');
            $this->index();
		}

	}
}

?>
