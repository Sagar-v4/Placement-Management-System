<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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
		$data['userInfo'] = $userInfo;
		$this->load->view('admin/profile', $data);
	}

	public function personalUpdate() {

		$this->load->model('Admin_update_model');
		
		$this->form_validation->set_rules('first_name', 'First name', 'trim|required');
		$this->form_validation->set_rules('middle_name', 'Middle name', 'trim');
		$this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('dob', 'Dob', 'trim|required');
		
		if ( $this->form_validation->run() == TRUE)
		{
			// Success !
			$adminArray = array();

			// Personal Details
			$adminArray['first_name'] = $this->input->post('first_name');
			$adminArray['middle_name'] = $this->input->post('middle_name');
			$adminArray['last_name'] = $this->input->post('last_name');
			$adminArray['gender'] = $this->input->post('gender');
			$adminArray['dob'] = $this->input->post('dob');
			
			// Store Data In Database
			if ( !empty($adminArray) ) {

				// student array is not empty - success !
				$this->Admin_update_model->personal($adminArray);
				$this->session->set_flashdata('updatePSMsg','Your account has been updated successfully.');
				redirect( base_url().'admin/profile/index' );
		
			} else {

				// When Inserted Data is Empty - Failure !
				$this->session->set_flashdata('updatePFMsg','Please insert all required fields to update an accout.');
				redirect(base_url().'admin/profile/index');
			
			}

			
		} else {

			// Failure !
			$this->session->set_flashdata('updatePFMsg','Please insert all the required fields with proper values to update an accout.');
			redirect(base_url().'admin/profile/index');
		}
	}

	public function proUpdate() {

		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info($this->session->userdata['admin']['email']);
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
			redirect(base_url().'admin/profile/index');
			
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

			$profile = $user_upload_path . $file_name;
			$thumb = $user_upload_path . $file_name_thumb;
			$this->load->model('Admin_update_model');
			$this->Admin_update_model->proUpload($profile, $thumb);
			$this->session->set_flashdata('updatePPSMsg','Your Profile Pic has been updated successfully.');

			redirect( base_url().'admin/profile/index' );

		}
 
		redirect(base_url().'admin/profile/index');	
	}

	public function proRemove() {
		
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['admin']['email'] );

		if ( $userInfo['gender'] == 'male' ) {
			$update = array(
				'admin_profile_pic' => './uploads/system/profile/male.png',
				'admin_profile_pic_thumb' => './uploads/system/profile/male_thumb.png'
			);

		} else if ( $userInfo['gender'] == 'female' ) {
			$update = array(
				'admin_profile_pic' => './uploads/system/profile/female.png',
				'admin_profile_pic_thumb' => './uploads/system/profile/female_thumb.png'
			);

		} else {
			$update = array(
				'admin_profile_pic' => './uploads/system/profile/other.png',
				'admin_profile_pic_thumb' => './uploads/system/profile/other_thumb.png'
			);
		}

		$this->db->where('admin_id', $userInfo['aid']);
		$this->db->update('pms_admin_media', $update);
		
		$this->session->set_flashdata('updatePPSMsg','Profile Picture has been Removed');

		redirect( base_url().'admin/profile/index' );


	}
	
	public function covUpdate() {

		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info($this->session->userdata['admin']['email']);
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
 
		if (!$this->upload->do_upload($file_element_name)) {
			
			$this->session->set_flashdata('updateCPFMsg', $this->upload->display_errors());
			redirect(base_url().'admin/profile/index');
			
		} else {
			$data_upload = $this->upload->data();
 
			$file_name = $data_upload["file_name"];
 
			$data["file_name_url"] = base_url() . $user_upload_path . $file_name;
			
			$cover = $user_upload_path . $file_name;
			$this->load->model('Admin_update_model');
			$this->Admin_update_model->covUpload($cover);
			$this->session->set_flashdata('updateCPSMsg','Your Cover Pic has been updated successfully.');

			redirect( base_url().'admin/profile/index' );
		}
 
			redirect(base_url().'admin/profile/index');

		
	}

	public function covRemove() {
		
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['admin']['email'] );

		$update = array(
			'admin_cover_pic' => './uploads/system/cover.jfif'
		);

		$this->db->where('admin_id', $userInfo['aid']);
		$this->db->update('pms_admin_media', $update);
		
		$this->session->set_flashdata('updateCPSMsg','Cover Picture has been Removed');

		redirect( base_url().'admin/profile/index' );


	}
}

?>
