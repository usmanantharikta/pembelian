<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {

	/**
	 * This controller use for access to application like
	 * view login
	 */

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('access_model');
		$this->load->model('general_model');
	}

  public function logout(){
    $sessiondata=array(
      'username'=>'',
      'level'=>'',
      'division'=>'',
    );
      $this->session->unset_userdata($sessiondata);
      $this->session->sess_destroy();
      redirect('/login', 'location');
  }

	public function password($user, $pass, $div, $level)
	{
		// echo $user;
		// echo ;
		$data=array(
			'user_id'=>15,
			'nik'=>1117827,
			'username'=>$user,
			'password'=>password_hash($pass, PASSWORD_DEFAULT),
			'division'=>$div,
			'level'=>$level
		);
		$res=$this->general_model->insert_ms('db_user', $data);
		echo $res;
	}

}
