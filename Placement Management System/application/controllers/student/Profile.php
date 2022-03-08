<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct() {

		parent::__construct();

		// Session expire OR try to Login from the URL (Preventing)
		$student = $this->session->userdata( 'student' );

		if ( empty($student) ) {
			$this->session->set_flashdata('msg', 'Your Session has been expired. Please try again.');
			redirect(base_url().'login/login/index');
		}

		// Acount Active / Deactive
		$this->load->model('Check_status_model');
		$studentStatus = $this->Check_status_model->checkStatus( $this->session->userdata['student']['email'] );

		if ( $studentStatus != 1 ) {

			// Destroy session
			$this->session->set_flashdata('msg', 'Your account has been deactivated. Please contact administrator.');
			$this->session->unset_userdata( 'student' );
			redirect(base_url().'login/login/index');
		}
	}

	public function index()	{
        
		$this->load->library('form_validation');
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info($this->session->userdata['student']['email']);

		$this->load->model('Notification_fetch_model');
		$quickNotifications = $this->Notification_fetch_model->get_quick_Notifications();
		
		$data['userInfo'] = $userInfo;
		$data['quickNotifications'] = $quickNotifications;
		
		if ( empty($userInfo['r12']) || ( empty($userInfo['percentage_h']) && empty($userInfo['cgpa_h']) ) ) {
		    
		    $this->session->set_flashdata('ProMsg','Please update PERCENTAGES and HIGHEST ACADEMIC QUALIFYING DEGREE to Apply in Requirements.');
		    
		}

		$this->load->view('student/profile', $data);
		
	}

	public function personalUpdate() {

		$this->load->library('form_validation');
		$this->load->model('Student_update_model');
		
		$this->form_validation->set_rules('first_name', 'First name', 'trim|required');
		$this->form_validation->set_rules('middle_name', 'Middle name', 'trim');
		$this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('dob', 'Dob', 'trim|required');
		
		if ( $this->form_validation->run() == TRUE) {
			
			// Success !
			$studentArray = array();

			// Personal Details
			$studentArray['first_name'] = $this->input->post('first_name');
			$studentArray['middle_name'] = $this->input->post('middle_name');
			$studentArray['last_name'] = $this->input->post('last_name');
			$studentArray['gender'] = $this->input->post('gender');
			$studentArray['dob'] = $this->input->post('dob');
			
			// Store Data In Database
			if ( !empty($studentArray) ) {

				// student array is not empty - success !
				$this->Student_update_model->personal($studentArray);
				$this->session->set_flashdata('updatePSMsg','Your account has been updated successfully.');
				redirect( base_url().'student/profile/index' );
		
			} else {

				// When Inserted Data is Empty - Failure !
				$this->session->set_flashdata('updatePFMsg','Please insert all required fields to update an accout.');
				redirect(base_url().'student/profile/index');

			}
		} else {

			// Failure !
			$this->session->set_flashdata('updatePFMsg','Please insert all the required fields with proper values to update an accout.');
			redirect(base_url().'student/profile/index');
		}
	}

	public function contactUpdate() {

		$this->load->library('form_validation');
		$this->load->model('Student_update_model');
		
		// Contact information
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('std', 'Std', 'trim');
		$this->form_validation->set_rules('telephone', 'Telephone', 'trim');
		
		if ( $this->form_validation->run() == TRUE) {
			
			// Success !
			$studentArray = array();

			// Contact information
			$studentArray['mobile_number'] = $this->input->post('phone');
			$studentArray['std_code'] = $this->input->post('std');
			$studentArray['telephone_number'] = $this->input->post('telephone');
			
			// Store Data In Database
			if ( !empty($studentArray) ) {

				// student array is not empty - success !
				$this->Student_update_model->contact($studentArray);
				$this->session->set_flashdata('updateCSMsg','Your account has been updated successfully.');
				redirect( base_url().'student/profile/index' );
		
			} else {

				// When Inserted Data is Empty - Failure !
				$this->session->set_flashdata('updateCFMsg','Please insert all required fields to update an accout.');
				redirect(base_url().'student/profile/index');

			}
		} else {

			// Failure !
			$this->session->set_flashdata('updateCFMsg','Please insert all the required fields with proper values to update an accout.');
			redirect(base_url().'student/profile/index');
		}
	}

	public function addressUpdate() {

		$this->load->library('form_validation');
		$this->load->model('Student_update_model');
		
		// Address information
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('locality', 'Locality', 'trim|required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('district', 'District', 'trim|required');
		$this->form_validation->set_rules('pincode', 'Pincode', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('country', 'Country', 'trim|required');
		
		if ( $this->form_validation->run() == TRUE) {
			
			// Success !
			$studentArray = array();

			// Address
			$studentArray['address'] = $this->input->post('address');
			$studentArray['locality'] = $this->input->post('locality');
			$studentArray['city'] = $this->input->post('city');
			$studentArray['district'] = $this->input->post('district');
			$studentArray['pincode'] = $this->input->post('pincode');
			$studentArray['state'] = $this->input->post('state');
			$studentArray['country'] = $this->input->post('country');
			
			// print_r($studentArray);

			// Store Data In Database
			if ( !empty($studentArray) ) {

				// student array is not empty - success !
				$this->Student_update_model->address($studentArray);
				$this->session->set_flashdata('updateASMsg','Your account has been updated successfully.');
				redirect( base_url().'student/profile/index' );
		
			} else {

				// When Inserted Data is Empty - Failure !
				$this->session->set_flashdata('updateAFMsg','Please insert all required fields to update an accout.');
				redirect(base_url().'student/profile/index');

			}
		} else {

			// Failure !
			$this->session->set_flashdata('updateAFMsg','Please insert all the required fields with proper values to update an accout.');
			redirect(base_url().'student/profile/index');
		}
	}

	public function percentageUpdate() {

		$this->load->library('form_validation');
		$this->load->model('Student_update_model');
		
		// 10th & 12th Overall Percentage
		$this->form_validation->set_rules('std_10', 'Std 10', 'numeric|required|greater_than[32.99]|less_than[100.01]');
		$this->form_validation->set_rules('std_12', 'Std 12', 'numeric|required|greater_than[32.99]|less_than[100.01]');
		
		if ( $this->form_validation->run() == TRUE) {
			
			// Success !
			$studentArray = array();

			// 10th & 12th Overall Percentage
			$studentArray['tenth_percentage'] = $this->input->post('std_10');
			$studentArray['twelfth_percentage'] = $this->input->post('std_12');
			
			// Store Data In Database
			if ( !empty($studentArray) ) {

				// student array is not empty - success !
				$this->Student_update_model->percentage($studentArray);
				$this->session->set_flashdata('updatePrSMsg','Your account has been updated successfully.');
				redirect( base_url().'student/profile/index' );
		
			} else {

				// When Inserted Data is Empty - Failure !
				$this->session->set_flashdata('updatePrFMsg','Please insert all required fields to update an accout.');
				redirect(base_url().'student/profile/index');

			}
		} else {

			// Failure !
			$this->session->set_flashdata('updatePrFMsg','Please insert all the required fields with proper values to update an accout.');
			redirect(base_url().'student/profile/index');
		}
	}

	public function highDegreeUpdate() {

		$this->load->library('form_validation');
		$this->load->model('Student_update_model');
		
		// Highest Academic Qualifying Degree
		$this->form_validation->set_rules('high_degree', 'High degree', 'trim|required');
		$this->form_validation->set_rules('high_discipline', 'High discipline', 'trim|required');
		$this->form_validation->set_rules('high_university', 'High university', 'trim|required');
		$this->form_validation->set_rules('high_city', 'High city', 'trim|required');
		$this->form_validation->set_rules('high_state', 'High state', 'trim|required');
		$this->form_validation->set_rules('high_mm_yyyy', 'High mm yyyy', 'trim|required');
		$this->form_validation->set_rules('marks', 'Marks', 'trim|required');

		if ( $this->input->post('marks') == "high_percentage" ) {
			$this->form_validation->set_rules('high_marks', 'High marks', 'numeric|required|greater_than[32.99]|less_than[100.01]');
		} else if ( $this->input->post('marks') == "high_cgpa" ) {
			$this->form_validation->set_rules('high_marks', 'High marks', 'numeric|required|greater_than[2.9]|less_than[10.01]');
		}
		
		if ( $this->form_validation->run() == TRUE) {
			
			// Success !
			$studentArray = array();

			// Highest Academic Qualifying Degree
			$studentArray['high_degree'] = $this->input->post('high_degree');
			$studentArray['high_discipline'] = $this->input->post('high_discipline');
			$studentArray['high_university'] = $this->input->post('high_university');
			$studentArray['high_city'] = $this->input->post('high_city');
			$studentArray['high_state'] = $this->input->post('high_state');
			$studentArray['high_mm_yyyy'] = $this->input->post('high_mm_yyyy');

			if ( $this->input->post('marks') == "high_percentage" ) {
				$studentArray['high_percentage'] = $this->input->post('high_marks');
			} else if ( $this->input->post('marks') == "high_cgpa" ) {
				$studentArray['high_cgpa'] = $this->input->post('high_marks');
			}
			
			// Store Data In Database
			if ( !empty($studentArray) ) {

				// student array is not empty - success !
				$this->Student_update_model->highDegree($studentArray);
				$this->session->set_flashdata('updateHdSMsg','Your account has been updated successfully.');
				redirect( base_url().'student/profile/index' );
		
			} else {

				// When Inserted Data is Empty - Failure !
				$this->session->set_flashdata('updateHdFMsg','Please insert all required fields to update an account.');
				redirect(base_url().'student/profile/index');

			}
		} else {

			// Failure !
			$this->session->set_flashdata('updateHdFMsg','Please insert all the required fields with proper values to update an account.');
			redirect(base_url().'student/profile/index');
		}
	}
	
	public function proUpdate() {

		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info($this->session->userdata['student']['email']);
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
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']  = 1024 * 4;
		$config['encrypt_name'] = TRUE;
 
		$this->load->library('upload', $config);
 
		if (!$this->upload->do_upload($file_element_name))
		{
			$this->session->set_flashdata('updatePPFMsg', $this->upload->display_errors());
			redirect(base_url().'student/profile/index');
			
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
			$this->load->model('Student_update_model');
			$this->Student_update_model->proUpload($profile, $thumb);
			$this->session->set_flashdata('updatePPSMsg','Your Profile Pic has been updated successfully.');

			redirect( base_url().'student/profile/index' );

		}
 
		redirect(base_url().'student/profile/index');	
	}
	
	public function proRemove() {
		
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['student']['email'] );

		if ( $userInfo['gender'] == 'male' ) {
			$update = array(
				'student_profile_pic' => './uploads/system/profile/male.png',
				'student_profile_pic_thumb' => './uploads/system/profile/male_thumb.png'
			);

		} else if ( $userInfo['gender'] == 'female' ) {
			$update = array(
				'student_profile_pic' => './uploads/system/profile/female.png',
				'student_profile_pic_thumb' => './uploads/system/profile/female_thumb.png'
			);

		} else {
			$update = array(
				'student_profile_pic' => './uploads/system/profile/other.png',
				'student_profile_pic_thumb' => './uploads/system/profile/other_thumb.png'
			);
		}

		$this->db->where('student_id', $userInfo['sid']);
		$this->db->update('pms_student_media', $update);
		
		$this->session->set_flashdata('updatePPSMsg','Profile Picture has been Removed');

		redirect( base_url().'student/profile/index' );


	}
	
	public function covUpdate() {

		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info($this->session->userdata['student']['email']);
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
			redirect(base_url().'student/profile/index');
			
		}
		else
		{
			$data_upload = $this->upload->data();
 
			$file_name = $data_upload["file_name"];
 
			$data["file_name_url"] = base_url() . $user_upload_path . $file_name;
			
			$cover = $user_upload_path . $file_name;
			$this->load->model('Student_update_model');
			$this->Student_update_model->covUpload($cover);
			$this->session->set_flashdata('updateCPSMsg','Your Cover Pic has been updated successfully.');

			redirect( base_url().'student/profile/index' );
		}
 
			redirect(base_url().'student/profile/index');

		
	}
	
	public function covRemove() {
		
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['student']['email'] );

		$update = array(
			'student_cover_pic' => './uploads/system/cover.jfif'
		);

		$this->db->where('student_id', $userInfo['sid']);
		$this->db->update('pms_student_media', $update);
		
		$this->session->set_flashdata('updateCPSMsg','Cover Picture has been Removed');

		redirect( base_url().'student/profile/index' );


	}

}
