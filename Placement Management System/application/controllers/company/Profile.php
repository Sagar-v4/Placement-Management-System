<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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

		$this->load->view('company/profile', $data);
		
	}

	public function personalUpdate() {

		$this->load->library('form_validation');
		$this->load->model('Company_update_model');
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('link', 'Link', 'trim|required');
		
		if ( $this->form_validation->run() == TRUE) {
			
			// Success !
			$companyArray = array();

			// Personal Details
			$companyArray['company_name'] = $this->input->post('name');
			$companyArray['company_link'] = $this->input->post('link');

			// Store Data In Database
			if ( !empty($companyArray) ) {

				// company array is not empty - success !
				$this->Company_update_model->personal($companyArray);
				$this->session->set_flashdata('updatePSMsg','Your account has been updated successfully.');
				redirect( base_url().'company/profile/index' );
		
			} else {

				// When Inserted Data is Empty - Failure !
				$this->session->set_flashdata('updatePFMsg','Please insert all required fields to update an accout.');
				redirect(base_url().'company/profile/index');

			}
		} else {

			// Failure !
			$this->session->set_flashdata('updatePFMsg','Please insert all the required fields with proper values to update an accout.');
			redirect(base_url().'company/profile/index');
		}
	}

	public function descriptionUpdate() {

		$this->load->library('form_validation');
		$this->load->model('Company_update_model');
		
		// Contact information
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		
		if ( $this->form_validation->run() == TRUE) {
			
			// Success !

			// description information
			$companyDescription = $this->input->post('description');
			
			// Store Data In Database
			if ( !empty($companyDescription) ) {

				// company array is not empty - success !
				$this->Company_update_model->description($companyDescription);
				$this->session->set_flashdata('updateCSMsg','Your account has been updated successfully.');
				redirect( base_url().'company/profile/index' );
		
			} else {

				// When Inserted Data is Empty - Failure !
				$this->session->set_flashdata('updateCFMsg','Please insert all required fields to update an accout.');
				redirect(base_url().'company/profile/index');

			}
		} else {

			// Failure !
			$this->session->set_flashdata('updateCFMsg','Please insert all the required fields with proper values to update an accout.');
			redirect(base_url().'company/profile/index');
		}
	}
	
	public function proUpdate() {

		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info($this->session->userdata['company']['email']);
		$id = md5( $userInfo['email'] );

		$data = array();
		$file_element_name = 'proPic';
		$user_upload_path = './uploads/imgs/' . $id .'/';

		if (!is_dir('./uploads/imgs/' . $id)) {
			mkdir('./uploads/imgs/' . $id);

		} 
		
		$dir = './uploads/imgs/' . $id;
		if (!is_dir($dir.'/index.html')) {
			$myfile = fopen($dir."/index.html", "w") or die("Unable to open file!");
			$txt = "<!DOCTYPE html>
					<html>
					<head>
						<title>403 Forbidden</title>
					</head>
					<body>

					<p>Directory access is forbidden.</p>

					</body>
					</html>";
			fwrite($myfile, $txt);
			fclose($myfile);
		}

		$config['upload_path'] = './' . $user_upload_path;
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']  = 1024 * 4;
		$config['encrypt_name'] = TRUE;
 
		$this->load->library('upload', $config);
 
		if (!$this->upload->do_upload($file_element_name))
		{
			$this->session->set_flashdata('updatePPFMsg', $this->upload->display_errors());
			redirect(base_url().'company/profile/index');
			
		}
		else
		{
			$data_upload = $this->upload->data();
 
			$file_name = $data_upload["file_name"];
			$file_name_thumb = $data_upload['raw_name'] . '_thumb' . $data_upload['file_ext'];
 
			$this->load->library('image_lib');
			$config_resize['image_library'] = 'gd2';	
			$config_resize['create_thumb'] = TRUE;
			$config_resize['maintain_ratio'] = TRUE;
			$config_resize['master_dim'] = 'height';
			$config_resize['quality'] = "100%";
			$config_resize['source_image'] = './' . $user_upload_path . $file_name;
 
			$config_resize['height'] = 64;
			$config_resize['width'] = 1;
			$this->image_lib->initialize($config_resize);
			$this->image_lib->resize();
 
			$data["file_name_url"] = base_url() . $user_upload_path . $file_name;
			$data["file_name_thumb_url"] = base_url() . $user_upload_path . $file_name_thumb;

			$profile = $user_upload_path . $file_name;
			$thumb = $user_upload_path . $file_name_thumb;
			$this->load->model('Company_update_model');
			$this->Company_update_model->proUpload($profile, $thumb);
			$this->session->set_flashdata('updatePPSMsg','Your Profile Pic has been updated successfully.');

			redirect( base_url().'company/profile/index' );

		}
 
		redirect(base_url().'company/profile/index');	
	}
	
	public function proRemove() {
		
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['company']['email'] );

		$update = array(
			'company_profile_pic' => './uploads/system/profile/other.png',
			'company_profile_pic_thumb' => './uploads/system/profile/other_thumb.png'
		);

		$this->db->where('company_id', $userInfo['cid']);
		$this->db->update('pms_company_media', $update);
		
		$this->session->set_flashdata('updatePPSMsg','Profile Picture has been Removed');

		redirect( base_url().'company/profile/index' );


	}
	
	public function covUpdate() {

		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info($this->session->userdata['company']['email']);
		$id = md5( $userInfo['email']);

		$data = array();
 
		$file_element_name = 'coverPic';
 
		$user_upload_path = './uploads/imgs/' . $id .'/';
		if (!is_dir('./uploads/imgs/' . $id)) {
			mkdir('./uploads/imgs/' . $id);
		}
		
		$dir = './uploads/imgs/' . $id;
		if (!is_dir($dir.'/index.html')) {
			$myfile = fopen($dir."/index.html", "w") or die("Unable to open file!");
			$txt = "<!DOCTYPE html>
					<html>
					<head>
						<title>403 Forbidden</title>
					</head>
					<body>

					<p>Directory access is forbidden.</p>

					</body>
					</html>";
			fwrite($myfile, $txt);
			fclose($myfile);
		}
 
		$config['upload_path'] = './' . $user_upload_path;
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']  = 1024 * 4;
		$config['encrypt_name'] = TRUE;
 
		$this->load->library('upload', $config);
 
		if (!$this->upload->do_upload($file_element_name))
		{
			$this->session->set_flashdata('updateCPFMsg', $this->upload->display_errors());
			redirect(base_url().'company/profile/index');
			
		}
		else
		{
			$data_upload = $this->upload->data();
 
			$file_name = $data_upload["file_name"];
 
			$data["file_name_url"] = base_url() . $user_upload_path . $file_name;
			
			$cover = $user_upload_path . $file_name;
			$this->load->model('Company_update_model');
			$this->Company_update_model->covUpload($cover);
			$this->session->set_flashdata('updateCPSMsg','Your Cover Pic has been updated successfully.');

			redirect( base_url().'company/profile/index' );
		}
 
			redirect(base_url().'company/profile/index');

		
	}

	
	public function covRemove() {
		
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['company']['email'] );

		$update = array(
			'company_cover_pic' => './uploads/system/cover.jfif'
		);

		$this->db->where('company_id', $userInfo['cid']);
		$this->db->update('pms_company_media', $update);
		
		$this->session->set_flashdata('updateCPSMsg','Cover Picture has been Removed');

		redirect( base_url().'company/profile/index' );


	}
	

}
