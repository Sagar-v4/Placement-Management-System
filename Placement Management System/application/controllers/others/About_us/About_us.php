<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_us extends CI_Controller {

	public function index()	{
        
		$this->load->view('others/About_us/index');
			
	}

	public function message() {

		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('subject', 'Password', 'trim|required');
		$this->form_validation->set_rules('message', 'Password', 'trim|required');

		if ( $this->form_validation->run() == TRUE) {

			$data['contact_email'] = $this->input->post('email');
			$data['contact_subject'] = $this->input->post('subject');
			$data['contact_message'] = $this->input->post('message');
			
            date_default_timezone_set('Asia/Kolkata');
            $data['contact_created_at'] = date('Y/m/d H:i:s', time());

			$this->db->insert('pms_contact_us', $data);
			
			$this->session->set_flashdata('msgs', 'Message Submitted !');
			redirect( base_url().'others/About_us/About_us/index' );

		} else {

			
			$this->session->set_flashdata('msgf', 'Message Not Submitted !');
			redirect( base_url().'others/About_us/About_us/index' );

		}

	}
	
}
