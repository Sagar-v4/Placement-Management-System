<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_info_model extends CI_Model {

	public function store_student_data($studentArray) {
        
                date_default_timezone_set('Asia/Kolkata');
                $studentArray['student_created_at'] = date('Y/m/d H:i:s', time());
                
                // Insert in pms_student_info Table
                $this->db->insert('pms_student_info', $studentArray);

		        $this->db->where('student_email', $studentArray['student_email']);
                $student = $this->db->get('pms_student_info')->row_array();

                $user['student_id'] = $student['student_id'];
                $user['user_email'] = $student['student_email'];
                $user['user_password'] = $student['student_password'];
                $user['user_role'] = "student";
                $user['user_created_at'] = $student['student_created_at'];
                
                $userMedia['student_id'] = $user['student_id'];
                if ( $student['student_gender'] == "male") {

                        $userMedia['student_profile_pic'] = './uploads/system/profile/male.png';
                        $userMedia['student_profile_pic_thumb'] = './uploads/system/profile/male_thumb.png';

                } elseif ( $student['student_gender'] == "female") {

                        $userMedia['student_profile_pic'] = './uploads/system/profile/female.png';
                        $userMedia['student_profile_pic_thumb'] = './uploads/system/profile/female_thumb.png';

                } elseif ( $student['student_gender'] == "other" ) {

                        $userMedia['student_profile_pic'] = './uploads/system/profile/other.png';
                        $userMedia['student_profile_pic_thumb'] = './uploads/system/profile/other_thumb.png';

                }
                $userMedia['student_cover_pic'] = './uploads/system/cover.jfif';

                // Insert in pms_users & pms_student_media Table
                $this->db->insert('pms_users', $user);
                $this->db->insert('pms_student_media', $userMedia);

	}
}
