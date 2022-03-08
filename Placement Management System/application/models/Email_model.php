<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_model extends CI_Model {

	public function sendEmail( $emailArray ) {
        
        $to = $emailArray['to'];
        $subject = $emailArray['subject'];#subject Of the email

        $from = $emailArray['from']; #Gmail ID It Cant Be Company/admin/student

        $emailContent = $emailArray['msg']; #C=Email Contant

        // SMTP Code

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '60';

        $config['smtp_user'] = 'Your_Mail_ID@mail.com';     #Gmail ID
        $config['smtp_pass'] = 'APP PASSWORD';              #Gmail Password

        $config['charset'] = 'utf8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';
        $config['validation'] = TRUE;

        // Initialization
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($emailContent);
        
        if( $this->email->send() ) {
            return true;
        } else {
            return false;
        }

	}

}
