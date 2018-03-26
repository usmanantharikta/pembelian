<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan extends CI_Controller {

	/**
	 * This controller use for access to application like
	 *
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->model('general_model');
		$this->load->library('excel');
		// $this->load->model('marketing_model');
	}

  public function index()
  {
    $this->load->view('main/home_keuangan');
  }

	public function list_bum()
	{
		$this->load->view('keuangan/list_bum');
	}

	public function list_pjum_ack(){
		$this->load->view('keuangan/list_bjum');
	}

	public function list_bum_approved()
	{
		$this->load->view('keuangan/list_bum_approved');
	}

	public function get_bum_need_ack()
	{
		$sql="SELECT pb.*, pm.id_po_master, pm.po_no, pm.cur_id, bj.status_bjum FROM `po_bum` pb
		join po_master pm on pm.id_po_master=pb.po_id
		left join po_bjum bj on bj.bum_id=pb.id_bum
		where pb.status_bum='approved' and pb.ack_bum='open'";

		$result=$this->general_model->select($sql);

		// var_dump($result);
		$table=array();

		foreach ($result as $key ) {
			$button='<a class="btn btn-sm btn-success" onclick="ack_bum('.$key['id_bum'].')" title="ACK"><i class="glyphicon glyphicon-play"></i> ACK BUM</a>';
			$stat_icon='<span class="label label-sm label-success">Approved</span>';

			// if($key['status_bum']=='open'){
			// 	$stat_icon='<span class="label label-sm label-success">Open</span>';
			// 	$button='<a class="btn btn-sm btn-warning" title="Cancel" onclick="cancel('.$key['id_bum'].')"><i class="glyphicon glyphicon-stop"></i> Cancel</a>';
			// 	if($_SESSION['level']=='kabag')
			// 	{
			// 		$button1='<a class="btn btn-sm btn-success" title="Cancel" onclick="approve('.$key['id_bum'].')"><i class="glyphicon glyphicon-pencil"></i> Approve</a>';
			// 	}
			// 	else{
			// 		$button1='';
			// 	}
			// }
			// else{
			// 	$stat_icon='<span class="label label-sm label-danger">Cancel</span>';
			// 	$button='';
			// 	if($_SESSION['level']=='kabag')
			// 	{
			// 		$button1='';
			// 	}else {
			// 		$button1='';
			// 	}
			// }

			$date = new DateTime($key['create_date']);
			$date->add(new DateInterval('P'.$key['lama_hari'].'D'));
			$end_date=$date->format('Y-m-d');

			array_push($table, array(
				'<a onclick="show_po('.$key['po_id'].')">'.$key['po_no'].'</a>',
				$key['bum_no'],
				$key['nama'].'-'.$key['jabatan'],
				$key['description'],
				$key['lama_hari'],
				$key['cur_id'].' '.number_format($key['nominal_bum'],2,",","."),
				$key['create_date'],
				$end_date,
				$key['approve_by'],
				$key['approve_date'],
				// $stat_icon,
				'<span class="label label-sm label-info">'.$key['ack_bum'].'</span>',
				$button
			));
		}

		echo json_encode(array('data'=>$table));
	}

	public function get_bum_acked()
	{
		$sql="SELECT pb.*, pm.id_po_master, pm.po_no, pm.cur_id, bj.status_bjum FROM `po_bum` pb
		join po_master pm on pm.id_po_master=pb.po_id
		left join po_bjum bj on bj.bum_id=pb.id_bum
		where pb.status_bum='approved' and pb.ack_bum!='open'";

		$result=$this->general_model->select($sql);

		// var_dump($result);
		$table=array();

		foreach ($result as $key ) {
			$stat_icon='<span class="label label-sm label-success">Approved</span>';


			$date = new DateTime($key['create_date']);
			$date->add(new DateInterval('P'.$key['lama_hari'].'D'));
			$end_date=$date->format('Y-m-d');

			array_push($table, array(
				'<a onclick="show_po('.$key['po_id'].')">'.$key['po_no'].'</a>',
				$key['bum_no'],
				$key['nama'].'-'.$key['jabatan'],
				$key['description'],
				$key['lama_hari'],
				$key['cur_id'].' '.number_format($key['nominal_bum'],2,",","."),
				$key['create_date'],
				$end_date,
				$key['approve_by'],
				$key['approve_date'],
				// $stat_icon,
				'<span class="label label-sm label-info">'.$key['ack_bum'].'</span>',
				// $button
			));
		}

		echo json_encode(array('data'=>$table));
	}

	public function ack_bum($id)
	{
		$update=$this->general_model->update('po_bum', array('ack_bum'=>'approved', 'ack_by'=>$_SESSION['nik'], 'ack_date'=>date('Y-m-d')), array('id_bum'=>$id));
		echo json_encode(array('status'=>true, 'id'=>$update));
	}

	public function ack_pjum($id)
	{
		$update=$this->general_model->update('po_bjum', array('ack_pjum'=>'approved', 'ack_by'=>$_SESSION['nik'], 'ack_date'=>date('Y-m-d')), array('id_bjum'=>$id));
		echo json_encode(array('status'=>true, 'id'=>$update));
	}

	public function approve_bjum($id)
	{
		$update=$this->general_model->update('po_bjum', array('status_bjum'=>'approved', 'approve_by'=>$_SESSION['nik'], 'approve_date'=>date('Y-m-d')), array('id_bjum'=>$id));
		echo json_encode(array('status'=>true, 'id'=>$update));
	}

	public function get_list_pjum_ack()
	{
		$sql="SELECT * FROM `po_bjum` pb
		join po_master pm on pm.id_po_master=pb.po_id
		WHERE `status_bjum` = 'approved' and ack_pjum!='approved'";
		$res=$this->general_model->select($sql);

		$table=array();

		foreach ($res as $key) {
			$this->session->set_userdata(array('id_bjum'=>$key['id_bjum']));
			$stat='<span class="label label-sm label-success">'.$key['ack_pjum'].'</span>';
			array_push($table, array(
				'<a href="'.site_url().'bum/view_bjum/'.$key['po_id'].'/'.$key['bum_id'].'/'.$key['status_bjum'].'">'.$key['id_bjum'].'</a>',
				'<a onclick="show_po('.$key['po_id'].')">'.$key['po_no'].'</a>',
				$key['bum_no'],
				$key['jumlah_bum'],
				$key['jumlah_bjum'],
				$key['selisih'],
				$key['create_by'],
				$stat,
				$key['approve_by'],
				$key['approve_date'],
				'<a class="btn btn-sm btn-success" onclick="ack_pjum('.$key['id_bjum'].')" title="ACK"><i class="glyphicon glyphicon-play"></i> ACK PJUM</a>'
			));
		}

		echo json_encode(array('data'=>$table));
	}

	public function get_list_pjum_acked()
	{
		$sql="SELECT * FROM `po_bjum` pb
		join po_master pm on pm.id_po_master=pb.po_id
		WHERE `status_bjum` = 'approved' and ack_pjum='approved'";
		$res=$this->general_model->select($sql);

		$table=array();

		foreach ($res as $key) {
			$this->session->set_userdata(array('id_bjum'=>$key['id_bjum']));
			$stat='<span class="label label-sm label-success">'.$key['ack_pjum'].'</span>';
			array_push($table, array(
				'<a href="'.site_url().'bum/view_bjum/'.$key['po_id'].'/'.$key['bum_id'].'/'.$key['status_bjum'].'">'.$key['id_bjum'].'</a>',
				'<a onclick="show_po('.$key['po_id'].')">'.$key['po_no'].'</a>',
				$key['bum_no'],
				$key['jumlah_bum'],
				$key['jumlah_bjum'],
				$key['selisih'],
				$key['create_by'],
				$stat,
				$key['ack_by'],
				$key['ack_date'],
				// '<a class="btn btn-sm btn-success" onclick="ack_pjum('.$key['id_bjum'].')" title="ACK"><i class="glyphicon glyphicon-play"></i> ACK PJUM</a>'
			));
		}

		echo json_encode(array('data'=>$table));
	}

	public function list_bjum_approved(){
		$this->load->view('keuangan/list_bjum_approved');
	}

	public function list_p_cod(){
		$this->load->view('keuangan/list_r_cod');
	}

	public function list_approved_cod(){
		$this->load->view('keuangan/list_r_cod_approved');
	}

	public function get_list_cod_roll()
	{
		$sql="SELECT * FROM `roll_cod` where status_roll='approved' and ack_status!='approved'";
		$res=$this->general_model->select($sql);
		$table=array();
		foreach ($res as $key ) {

			if($key['ack_status']=='open'){
				$stat_icon='<span class="label label-sm label-success">Open</span>';
				// $button='<a class="btn btn-sm btn-warning" title="Cancel" onclick="cancel('.$key['id_bum'].')"><i class="glyphicon glyphicon-stop"></i> Cancel</a>';
				if($_SESSION['level']=='kabag')
				{
					$button1='<a class="btn btn-sm btn-success" title="Cancel" onclick="ack('.$key['id_roll'].')"><i class="glyphicon glyphicon-pencil"></i> ACK</a>';
				}
				else{
					$button1='';
				}
			}
			else{
				$stat_icon='<span class="label label-sm label-danger">Cancel</span>';
				$button='';
				if($_SESSION['level']=='kabag')
				{
					$button1='';
				}else {
					$button1='';
				}
			}

			array_push($table, array(
				'<a href="'.site_url().'bum/approve_view_cod/'.$key['roll_ids'].'/'.$key['roll_no'].'/'.$key['id_roll'].'/'.$key['status_roll'].'">'.$key['roll_no'].'</a>',
				$key['roll_date'],
				number_format($key['roll_total'],2,",","."),
				$key['create_by'],
				$key['create_date'],
				$stat_icon,
				$button1
			));
		}

		echo json_encode(array('data'=>$table));
	}

	public function approve_cod($id){
		$up=$this->general_model->update('roll_cod', array('ack_status'=>'approved', 'ack_by'=>$_SESSION['nik'], 'ack_date'=>date('Y-m-d')), array('id_roll'=>$id));
		// if($up!=0){
		// 	$sql="select roll_ids from roll_cod";
		// 	$res=$this->general_model->select_row($sql);
		// 	$id_cod=explode('-',$res['roll_ids']);
		// 	for ($i=0; $i < count($id_cod); $i++) {
		// 		$this->general_model->update('po_top', array('status_top'=>'done'), array('id_top'=>$id_cod[$i]));
		// 	}
		// }
		echo json_encode(array('status'=>true));
	}
	public function get_list_cod_roll_approved()
	{
		$sql="SELECT * FROM `roll_cod` where status_roll='approved' and ack_status='approved'";
		$res=$this->general_model->select($sql);
		$table=array();
		foreach ($res as $key ) {
				$stat_icon='<span class="label label-sm label-success">Approved</span>';

			// if($key['status_roll']=='open'){
			// 	$stat_icon='<span class="label label-sm label-success">Open</span>';
			// 	// $button='<a class="btn btn-sm btn-warning" title="Cancel" onclick="cancel('.$key['id_bum'].')"><i class="glyphicon glyphicon-stop"></i> Cancel</a>';
			// 	if($_SESSION['level']=='kabag')
			// 	{
			// 		$button1='<a class="btn btn-sm btn-success" title="Cancel" onclick="approve('.$key['id_roll'].')"><i class="glyphicon glyphicon-pencil"></i> Approve</a>';
			// 	}
			// 	else{
			// 		$button1='';
			// 	}
			// }
			// else{
			// 	$stat_icon='<span class="label label-sm label-danger">Cancel</span>';
			// 	$button='';
			// 	if($_SESSION['level']=='kabag')
			// 	{
			// 		$button1='';
			// 	}else {
			// 		$button1='';
			// 	}
			// }

			array_push($table, array(
				'<a href="'.site_url().'bum/approve_view_cod/'.$key['roll_ids'].'/'.$key['roll_no'].'/'.$key['id_roll'].'/'.$key['status_roll'].'">'.$key['roll_no'].'</a>',
				$key['roll_date'],
				number_format($key['roll_total'],2,",","."),
				$key['create_by'],
				$key['create_date'],
				$stat_icon,
				$key['ack_by'],
				$key['ack_date']
				// $button1
			));
		}

		echo json_encode(array('data'=>$table));
	}

}
