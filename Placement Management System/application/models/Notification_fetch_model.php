<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_fetch_model extends CI_Model {

	public function get_quick_Notifications() {

		function time_elapsed_string($datetime, $full = false) {
			date_default_timezone_set("Asia/Kolkata");
			$now = new DateTime;
			$ago = new DateTime($datetime);
			$diff = $now->diff($ago);
			
		
			$diff->w = floor($diff->d / 7);
			$diff->d -= $diff->w * 7;
		
			$string = array(
				'y' => 'year',
				'm' => 'month',
				'w' => 'week',
				'd' => 'day',
				'h' => 'hour',
				'i' => 'minute',
				's' => 'second',
			);
			foreach ($string as $k => &$v) {
				if ($diff->$k) {
					$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
				} else {
					unset($string[$k]);
				}
			}
		
			if (!$full) $string = array_slice($string, 0, 1);
			return $string ? implode(', ', $string) . ' ago' : 'just now';
		}
		
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info($this->session->userdata['student']['email']);

		$this->db->where('student_id', $userInfo['sid']);
		$this->db->where('student_notification_seen', 0);
		$notifications = $this->db->get('pms_student_notification')->result_array();

		if( !empty($notifications) ) {
			$i = 0;
			foreach($notifications as $notification) {
				
				$notifications[$i]['time'] = time_elapsed_string($notification['student_notification_created_at']);

				$i++;
			}
		}
        

        return $notifications;

    }
	
	public function get_quick_com_Notifications() {

		function time_elapsed_string($datetime, $full = false) {
			date_default_timezone_set("Asia/Kolkata");
			$now = new DateTime;
			$ago = new DateTime($datetime);
			$diff = $now->diff($ago);
			
		
			$diff->w = floor($diff->d / 7);
			$diff->d -= $diff->w * 7;
		
			$string = array(
				'y' => 'year',
				'm' => 'month',
				'w' => 'week',
				'd' => 'day',
				'h' => 'hour',
				'i' => 'minute',
				's' => 'second',
			);
			foreach ($string as $k => &$v) {
				if ($diff->$k) {
					$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
				} else {
					unset($string[$k]);
				}
			}
		
			if (!$full) $string = array_slice($string, 0, 1);
			return $string ? implode(', ', $string) . ' ago' : 'just now';
		}
		
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info($this->session->userdata['company']['email']);

		$this->db->where('company_id', $userInfo['cid']);
		$this->db->where('company_notification_seen', 0);
		$notifications = $this->db->get('pms_company_notification')->result_array();

		if( !empty($notifications) ) {
			$i = 0;
			foreach($notifications as $notification) {
				
				$notifications[$i]['time'] = time_elapsed_string($notification['company_notification_created_at']);

				$i++;
			}
		}
        

        return $notifications;

    }

    public function get_Notifications() {
        
		function time_elapsed_string($datetime, $full = false) {
			date_default_timezone_set("Asia/Kolkata");
			$now = new DateTime;
			$ago = new DateTime($datetime);
			$diff = $now->diff($ago);
			
		
			$diff->w = floor($diff->d / 7);
			$diff->d -= $diff->w * 7;
		
			$string = array(
				'y' => 'year',
				'm' => 'month',
				'w' => 'week',
				'd' => 'day',
				'h' => 'hour',
				'i' => 'minute',
				's' => 'second',
			);
			foreach ($string as $k => &$v) {
				if ($diff->$k) {
					$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
				} else {
					unset($string[$k]);
				}
			}
		
			if (!$full) $string = array_slice($string, 0, 1);
			return $string ? implode(', ', $string) . ' ago' : 'just now';
		}
		
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info($this->session->userdata['student']['email']);

		$this->db->where('student_id', $userInfo['sid']);
		$notifications = $this->db->get('pms_student_notification')->result_array();

		if( !empty($notifications) ) {
			$i = 0;
			foreach($notifications as $notification) {
								
				$notifications[$i]['time'] = time_elapsed_string($notification['student_notification_created_at']);
				
				$i++;
			}
		}

        return $notifications;
    }
	
    public function get_com_Notifications() {
        
		function time_elapsed_string($datetime, $full = false) {
			date_default_timezone_set("Asia/Kolkata");
			$now = new DateTime;
			$ago = new DateTime($datetime);
			$diff = $now->diff($ago);
			
		
			$diff->w = floor($diff->d / 7);
			$diff->d -= $diff->w * 7;
		
			$string = array(
				'y' => 'year',
				'm' => 'month',
				'w' => 'week',
				'd' => 'day',
				'h' => 'hour',
				'i' => 'minute',
				's' => 'second',
			);
			foreach ($string as $k => &$v) {
				if ($diff->$k) {
					$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
				} else {
					unset($string[$k]);
				}
			}
		
			if (!$full) $string = array_slice($string, 0, 1);
			return $string ? implode(', ', $string) . ' ago' : 'just now';
		}
		
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info($this->session->userdata['company']['email']);

		$this->db->where('company_id', $userInfo['cid']);
		$notifications = $this->db->get('pms_company_notification')->result_array();

		if( !empty($notifications) ) {
			$i = 0;
			foreach($notifications as $notification) {
								
				$notifications[$i]['time'] = time_elapsed_string($notification['company_notification_created_at']);
				
				$i++;
			}
		}

        return $notifications;
    }
}
