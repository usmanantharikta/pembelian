<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pjum extends CI_Controller {

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
    $this->load->view('main/home');
  }

  public function process_credit($id_po, $id_top, $id_pjum){
    $data['id_top']=$id_top;
    $data['id_po']=$id_po;
		$data['id_pjum']=$id_pjum;

    //get list bpb_no
    $sql_bpb="SELECT DISTINCT no_bpb from mir_detail where po_id='$id_po'";
    $bpb=$this->general_model->select($sql_bpb);

    if(count($sql_bpb)>0){
      $data['bpb_no']=$bpb;
    }

		$dir = 'uploads/pjum/credit/'.$id_pjum;
		if(is_dir($dir)){
			$files=scandir($dir);
		}else{
			$files='';
		}
		$data['files']=array();
		for ($i=2; $i < count($files) ; $i++) {
			$dump=scandir('uploads/pjum/credit/'.$id_pjum.'/'.$files[$i]);
			if(count($dump)>2){
				array_push($data['files'], array($files[$i]=>$dump[2]));
			}
		}

    $this->load->view('credit/process_credit', $data);
  }

	public function edit_process_credit($id_po, $id_top, $id_pjum){
		$data['id_top']=$id_top;
		$data['id_po']=$id_po;

		//get list bpb_no
		$sql_bpb="SELECT DISTINCT no_bpb from mir_detail where po_id='$id_po'";
		$bpb=$this->general_model->select($sql_bpb);

		if(count($sql_bpb)>0){
			$data['bpb_no']=$bpb;
		}

		$dir = 'uploads/pjum/credit/'.$id_top;
		if(is_dir($dir)){
			$files=scandir($dir);
		}else{
			$files='';
		}
		$data['files']=array();
		for ($i=2; $i < count($files) ; $i++) {
			$dump=scandir('uploads/pjum/credit/'.$id_top.'/'.$files[$i]);
			if(count($dump)>2){
				array_push($data['files'], array($files[$i]=>$dump[2]));
			}
		}

		$this->load->view('credit/process_credit', $data);
	}

	public function process_credit_approve($id_po, $id_top, $id_pjum, $stat){
		$data['id_pjum']=$id_pjum;
		$data['id_top']=$id_top;
		$data['id_po']=$id_po;
		$data['status']=$stat;
		//get list bpb_no
		$sql_bpb="SELECT DISTINCT no_bpb from mir_detail where po_id='$id_po'";
		$bpb=$this->general_model->select($sql_bpb);

		if(count($sql_bpb)>0){
			$data['bpb_no']=$bpb;
		}

		$dir = 'uploads/pjum/credit/'.$id_pjum;
		if(is_dir($dir)){
			$files=scandir($dir);
		}else{
			$files='';
		}
		$data['files']=array();
		for ($i=2; $i < count($files) ; $i++) {
			$dump=scandir('uploads/pjum/credit/'.$id_pjum.'/'.$files[$i]);
			if(count($dump)>2){
				array_push($data['files'], array($files[$i]=>$dump[2]));
			}
		}

		$this->load->view('credit/process_credit', $data);
	}

	public function process_pp_approve($id_po, $id_dp, $type, $id_pjum, $stat){
		$data['id_top']=$id_dp;
		$data['id_po']=$id_po;
		$data['type']=$type;
		$data['id_pjum']=$id_pjum;
		$data['status']=$stat;


		//get list bpb_no
		$sql_bpb="SELECT DISTINCT no_bpb from mir_detail where po_id='$id_po'";
		$bpb=$this->general_model->select($sql_bpb);

		if(count($sql_bpb)>0){
			$data['bpb_no']=$bpb;
		}

		$dir = 'uploads/pjum/'.$type.'/'.$id_dp;
		if(is_dir($dir)){
			$files=scandir($dir);
		}else{
			$files='';
		}
		$data['files']=array();
		for ($i=2; $i < count($files) ; $i++) {
			$dump=scandir('uploads/pjum/'.$type.'/'.$id_dp.'/'.$files[$i]);
			if(count($dump)>2){
				array_push($data['files'], array($files[$i]=>$dump[2]));
			}
		}

		$this->load->view('pp/process_pp', $data);
	}


  public function process_pp($id_po, $id_dp, $type){
    $data['id_top']=$id_dp;
    $data['id_po']=$id_po;
    $data['type']=$type;

    //get list bpb_no
    $sql_bpb="SELECT DISTINCT no_bpb from mir_detail where po_id='$id_po'";
    $bpb=$this->general_model->select($sql_bpb);

    if(count($sql_bpb)>0){
      $data['bpb_no']=$bpb;
    }

		$dir = 'uploads/pjum/'.$type.'/'.$id_dp;
		if(is_dir($dir)){
			$files=scandir($dir);
		}else{
			$files='';
		}
		$data['files']=array();
		for ($i=2; $i < count($files) ; $i++) {
			$dump=scandir('uploads/pjum/'.$type.'/'.$id_dp.'/'.$files[$i]);
			if(count($dump)>2){
				array_push($data['files'], array($files[$i]=>$dump[2]));
			}
		}

    $this->load->view('pp/process_pp', $data);
  }

  public function get_list_pp_by_id($id)
  {
    $sql="SELECT * FROM `po_dp` pd join po_master pm on pm.id_po_master=pd.po_id and pm.status_po='approved' and id_dp=$id";
    $res=$this->general_model->select($sql);

    $table=array();

    foreach ($res as $key) {
      array_push($table, array(
        $key['id_dp'],
        '<a onclick="show_po('.$key['po_id'].')">'.$key['po_no'].'</a>',
        $key['type_pp'],
        $key['persentase'],
        $key['cur_id'].' '.number_format($key['nominal'], 2, '.', ','),
				$key['cur_id'].' '.number_format(floatval($key['nominal'])*floatval($key['persentase'])/100, 2, '.', ','),
        $key['create_by'],
        $key['create_date'],
        // '<a class="btn btn-sm btn-success" title="bjum" href="'.site_url().'pjum/process_pp/'.$key['po_id'].'/'.$key['id_dp'].'/'.$key['type_pp'].'"><i class="glyphicon glyphicon-play"></i>Process</a>'
      ));
    }

    echo json_encode(array('data'=>$table));
  }

	public function validate_pjum()
	{
		$data['error_string']=array();
		$data['inputerror']=array();
		$data['status']=true;

		$colom=array('po_id', 'type_top', 'top_id', 'invoice_no', 'invoice_date', 'ttbp_date', 'ttbp_no');
		$bpbNo=$this->input->post('bpb_no');

		if($this->input->post('type_top')!='DP')
		{
			if($this->input->post('type_top')!='TERMINJ'){
				if(!isset($bpbNo)){
					$data['error_string'][]='Cannot Empty !!!';
					$data['inputerror'][]='bpb_no';
					$data['status']=false;
				}
			}else{
				if($this->cek_depedensi($this->input->post('top_id'))!=0){
					if(!isset($bpbNo)){
						$data['error_string'][]='Cannot Empty !!!';
						$data['inputerror'][]='bpb_no';
						$data['status']=false;
					}
				}
			}
		}

		if($this->input->post('type_top')=='credit' && $this->input->post('invoice_value')==''){
				$data['error_string'][]='Cannot Empty !!!';
				$data['inputerror'][]='invoice_value';
				$data['status']=false;
		}

		for ($i=0; $i < count($colom); $i++) {
			if($this->input->post($colom[$i])==''){
				$data['error_string'][]='Cannot Empty !!!';
				$data['inputerror'][]=$colom[$i];
				$data['status']=false;
			}
		}
		for ($i=0; $i < count($colom) ; $i++) {
			if($this->input->post($colom[$i])=='0000-00-00'){
				$data['error_string'][]='Not Valid !!!';
				$data['inputerror'][]=$colom[$i];
				$data['status']=false;
			}
		}

		if($data['status']===false){
			echo json_encode($data);
			exit();
		}
	}

	public function cek_depedensi($id){
		$sql="select * from po_dp where id_dp=$id";
		$res=$this->general_model->select_row($sql);
		// var_dump($res);
		if(count($res)>0){
			return $res['bpb_ack'];
		}else{
			return 0;
		}

	}

	public function sent_pjum()
	{
		$this->save_pjum(0);
		$this->validate_pjum();
		$update=$this->general_model->update('pjum_master', array('status_pjum'=>'sent'), array('id_pjum'=>$this->input->post('id_pjum')));
		echo json_encode(array('status'=>true, 'id_bjum'=>$update));
	}

	public function sent_pjum_pp()
	{
		$this->save_pjum_pp(0);
		$this->validate_pjum();
		$update=$this->general_model->update('pjum_master_pp', array('status_pjum'=>'sent'), array('top_id'=>$this->input->post('top_id')));
		echo json_encode(array('status'=>true, 'id_bjum'=>$update));
	}

	public function save_pjum($id)
	{
		$id_pjum=$this->input->post('id_pjum');
		$colom=array('doc_no', 'doc_date', 'invoice_value', 'po_id', 'top_id', 'invoice_no', 'invoice_date', 'ttbp_date', 'ttbp_no', 'fp_no', 'fp_date', 'sj_no', 'sj_date');
		$bpbNo=$this->input->post('bpb_no');
		if(isset($bpbNo)){
		$data=array('bpb_no'=>implode('-',$bpbNo), 'type_top_pjum'=>$this->input->post('type_top'), 'create_by'=>$_SESSION['nik'], 'create_date'=>date('Y-m-d'));
	}else{
		$data=array('bpb_no'=>'', 'type_top_pjum'=>$this->input->post('type_top'), 'create_by'=>$_SESSION['nik'], 'create_date'=>date('Y-m-d'));
	}

		//get data FROM
		for ($i=0; $i < count($colom); $i++) {
			$dump=array($colom[$i]=>$this->input->post($colom[$i]));
			$data=array_merge($data, $dump);
		}

		//cek sudah ada apa blm di dp
		$sql="select * from pjum_master where id_pjum='$id_pjum'";
		$res=$this->general_model->select_row($sql);

		if(count($res)>0){
			$this->general_model->update('pjum_master', $data, array('id_pjum'=>$id_pjum));
			$insert=$id_pjum;
		}else{
			$insert=$this->general_model->insert('pjum_master', $data);
		}

		$files=array('invoice', 'fp', 'sj', 'ttbp', 'doc');
		//upload attachment
		$dataa['error_string'] = array();
		$dataa['inputerror'][] = array();
		$dataa['status'] = TRUE;

		for ($i=0; $i < count($files) ; $i++) {
			$up_mes=$this->upload_file($insert, $this->input->post('type_top'), $files[$i]);

			if(($up_mes!=1) && ($up_mes!=null)){
				$dataa['error_string'][] = $up_mes;
				$dataa['inputerror'][] =  $files;
				$dataa['status'] = FALSE;
			}
		}

		if($dataa['status']===FALSE){
			if($id==1){
			echo json_encode($dataa);
			}
		}
		else {
			if($id==1){
			echo json_encode(array('status'=>true, 'id_pjum'=>$insert));
			}
		}
		// echo json_encode(array('status'=>true, 'result'=>$insert));
	}

	public function save_pjum_pp($id)
	{
		$id_pjum=$this->input->post('top_id');
		$colom=array('doc_no', 'doc_date', 'invoice_value', 'po_id', 'top_id', 'invoice_no', 'invoice_date', 'ttbp_date', 'ttbp_no', 'fp_no', 'fp_date', 'sj_no', 'sj_date');
		$bpbNo=$this->input->post('bpb_no');
		if(isset($bpbNo)){
		$data=array('bpb_no'=>implode('-',$bpbNo), 'type_top_pjum'=>$this->input->post('type_top'), 'create_by'=>$_SESSION['nik'], 'create_date'=>date('Y-m-d'));
	}else{
		$data=array('bpb_no'=>'', 'type_top_pjum'=>$this->input->post('type_top'), 'create_by'=>$_SESSION['nik'], 'create_date'=>date('Y-m-d'));
	}

		//get data FROM
		for ($i=0; $i < count($colom); $i++) {
			$dump=array($colom[$i]=>$this->input->post($colom[$i]));
			$data=array_merge($data, $dump);
		}

		//cek sudah ada apa blm di dp
		$sql="select * from pjum_master_pp where top_id='".$this->input->post('top_id')."'";
		$res=$this->general_model->select_row($sql);

		if(count($res)>0){
			$this->general_model->update('pjum_master_pp', $data, array('top_id'=>$id_pjum));
			$insert=$id_pjum;
		}else{
			$insert=$this->general_model->insert('pjum_master_pp', $data);
		}

		$files=array('invoice', 'fp', 'sj', 'ttbp', 'doc');
		//upload attachment
		$dataa['error_string'] = array();
		$dataa['inputerror'][] = array();
		$dataa['status'] = TRUE;

		for ($i=0; $i < count($files) ; $i++) {
			$up_mes=$this->upload_file( $this->input->post('top_id'), $this->input->post('type_top'), $files[$i]);

			if(($up_mes!=1) && ($up_mes!=null)){
				$dataa['error_string'][] = $up_mes;
				$dataa['inputerror'][] =  $files;
				$dataa['status'] = FALSE;
			}
		}

		if($dataa['status']===FALSE){
			if($id==1){
			echo json_encode($dataa);
			}
		}
		else {
			if($id==1){
			echo json_encode(array('status'=>true, 'id_pjum'=>$insert));
			}
		}
		// echo json_encode(array('status'=>true, 'result'=>$insert));
	}

	//upload file on sppr
	public function upload_file($id_po, $type, $name)
	{
		// var_dump($_FILES);
		$filesCount = count($_FILES[$name]['name']);
		// echo $_FILES[$name]['name'][0].'</br>';
		if($_FILES[$name]['name'][0]!=''){
			for($i = 0; $i < $filesCount; $i++){
					$_FILES['userFile']['name'] = $_FILES[$name]['name'][$i];
					$_FILES['userFile']['type'] = $_FILES[$name]['type'][$i];
					$_FILES['userFile']['tmp_name'] = $_FILES[$name]['tmp_name'][$i];
					$_FILES['userFile']['error'] = $_FILES[$name]['error'][$i];
					$_FILES['userFile']['size'] = $_FILES[$name]['size'][$i];

					$uploadPath = 'uploads/pjum/'.$type.'/'.$id_po.'/'.$name;
					if (!is_dir($uploadPath)) {
							 mkdir($uploadPath, 0775, TRUE);
					 }
					 $config['upload_path'] = $uploadPath;
					 $config['allowed_types'] = '*';
					 // $config['allowed_types'] = 'pdf';
					 // $config['max_size']	= '4800';
					 $this->load->library('upload', $config);
					 $this->upload->initialize($config);
					 if ( ! $this->upload->do_upload('userFile'))
					 {
						 return $_FILES['userFile']['name'].' '.$this->upload->display_errors();
						 // echo json_encode('upload failed');
					 }else{
						 return 1;
						 // echo json_encode('upload succes');
					 }
			}
		}
	}

	public function get_data_pjum($id_top){
		$sql="select * from pjum_master where id_pjum=$id_top";
		$res=$this->general_model->select_row($sql);
		$data=array(
			$res['doc_no'],
			$res['doc_date'],
			$res['invoice_no'],
			$res['invoice_value'],
			$res['invoice_date'],
			$res['sj_no'],
			$res['sj_date'],
			$res['fp_no'],
			$res['fp_date'],
			$res['ttbp_no'],
			$res['ttbp_date'],
			explode(',',$res['bpb_no']),
		);
		echo json_encode($data);
	}

	public function get_data_pjum_pp($id_top){
		$sql="select * from pjum_master_pp where top_id=$id_top";
		$res=$this->general_model->select_row($sql);
		$data=array(
			$res['doc_no'],
			$res['doc_date'],
			$res['invoice_no'],
			$res['invoice_date'],
			$res['sj_no'],
			$res['sj_date'],
			$res['fp_no'],
			$res['fp_date'],
			$res['ttbp_no'],
			$res['ttbp_date'],
			explode(',',$res['bpb_no']),
		);
		echo json_encode($data);
	}

	public function delete_pjum(){
		$id_bjum=$this->input->post('id');
		$folder=$this->input->post('folder');
		$file=$this->input->post('file');
		$type=$this->input->post('type');

		$path_file_nya=$_SERVER['DOCUMENT_ROOT'].'/pembelian/uploads/pjum/'.$type.'/'.$id_bjum.'/'.$folder.'/'.$file;
		// if(file_exists($path_file_nya.'/'.$file)){
		if(unlink($path_file_nya))
		{
			echo json_encode(array('status'=>true, 'path'=>$path_file_nya));
		}else{
			echo json_encode(array('status'=>false, 'path'=>$path_file_nya, 'dss'=>'wee'));

		}
	// }else{
	// 	echo json_encode(array('status'=>false, 'path'=>$path_file_nya));
	//
	// }
	}

	public function list_pjum_approval_c()
	{
		$this->load->view('credit/list_pjum_approval');
	}

	public function list_pjum_approval_pp(){
		$this->load->view('pp/list_pjum_pp_approval');
	}

	public function list_pjum_approved_pp(){
		$this->load->view('pp/list_pjum_pp_approved');
	}

	public function list_pjum_approved_c()
	{
		$this->load->view('credit/list_pjum_approved');
	}

	public function get_list_pjum_credit()
	{
		$sql="select pj.id_pjum,pt.type_top, pj.ttbp_no, pj.po_id, pm.po_no, pt.id_top, pt.nominal, pj.create_by, pj.create_date, pj.status_pjum from pjum_master pj
					join po_master pm on pm.id_po_master=pj.po_id
					join po_top pt on pt.id_top=pj.top_id where status_pjum='sent'";
		$res=$this->general_model->select($sql);
		$table=array();

		foreach ($res as $key) {

			if($_SESSION['level']=='kabag')
			{
				$button='<a class="btn btn-sm btn-success" title="bjum" href="'.site_url().'pjum/process_credit_approve/'.$key['po_id'].'/'.$key['id_top'].'/'.$key['id_pjum'].'/'.sha1($key['status_pjum']).'"><i class="glyphicon glyphicon-play"></i> Approve TTBP</a>';
			}
			else{
				$button="";
			}

			array_push($table, array(
				$key['ttbp_no'],
				'<a onclick="show_po('.$key['po_id'].')">'.$key['po_no'].'</a>',
				$key['id_top'],
				$key['type_top'],
				$key['nominal'],
				$key['create_by'],
				$key['create_date'],
				'<span class="label label-sm label-success">'.$key['status_pjum'].'</span>',
				$button
			));
		}

		echo json_encode(array('data'=>$table));
	}

//get list pp APPROVAL
	public function get_list_pjum_pp()
	{
		$sql="select pj.id_pjum,pd.id_dp,pd.type_pp,pm.cur_id,pd.persentase, pj.ttbp_no, pj.po_id, pm.po_no, pd.nominal, pd.nominal_dp, pj.create_by, pj.create_date, pj.status_pjum from pjum_master_pp pj
					join po_master pm on pm.id_po_master=pj.po_id
					join po_dp pd on pd.id_dp=pj.top_id where status_pjum='sent'";
		$res=$this->general_model->select($sql);
		$table=array();

		foreach ($res as $key) {

			if($_SESSION['level']=='kabag')
			{
				$button='<a class="btn btn-sm btn-success" title="bjum" href="'.site_url().'pjum/process_pp_approve/'.$key['po_id'].'/'.$key['id_dp'].'/'.$key['type_pp'].'/'.$key['id_pjum'].'/'.sha1($key['status_pjum']).'"><i class="glyphicon glyphicon-play"></i> Approve TTBP</a>';
			}
			else{
				$button="";
			}

			array_push($table, array(
				$key['ttbp_no'],
				'<a onclick="show_po('.$key['po_id'].')">'.$key['po_no'].'</a>',
				$key['id_dp'],
				$key['type_pp'],
				$key['persentase'],
				$key['cur_id'].' '.number_format($key['nominal'], 2, '.', ','),
				$key['cur_id'].' '.number_format(floatval($key['nominal'])*floatval($key['persentase'])/100, 2, '.', ','),
				$key['create_by'],
				$key['create_date'],
				'<span class="label label-sm label-success">'.$key['status_pjum'].'</span>',
				$button
			));
		}

		echo json_encode(array('data'=>$table));
	}

	//get approved
	public function get_list_pjum_pp_approved(){
		$sql="select pj.approve_by, pj.approve_date, pj.id_pjum,pd.id_dp,pd.type_pp,pm.cur_id,pd.persentase, pj.ttbp_no, pj.po_id, pm.po_no, pd.nominal, pd.nominal_dp, pj.create_by, pj.create_date, pj.status_pjum from pjum_master_pp pj
					join po_master pm on pm.id_po_master=pj.po_id
					join po_dp pd on pd.id_dp=pj.top_id where status_pjum='approved' and type_top_pjum!='credit'";
		$res=$this->general_model->select($sql);
		$table=array();

		foreach ($res as $key) {

			if($_SESSION['level']=='kabag')
			{
				$button='<a class="btn btn-sm btn-success" title="bjum" href="'.site_url().'pjum/process_pp_approve/'.$key['po_id'].'/'.$key['id_dp'].'/'.$key['type_pp'].'/'.$key['id_pjum'].'/'.sha1($key['status_pjum']).'"><i class="glyphicon glyphicon-play"></i> Approve PJUM</a>';
			}
			else{
				$button="";
			}

			array_push($table, array(
				'<a href="'.site_url().'pjum/process_pp_approve/'.$key['po_id'].'/'.$key['id_dp'].'/'.$key['type_pp'].'/'.$key['id_pjum'].'/'.sha1($key['status_pjum']).'">'.$key['ttbp_no'].'</a>',
				'<a onclick="show_po('.$key['po_id'].')">'.$key['po_no'].'</a>',
				$key['id_dp'],
				$key['type_pp'],
				$key['persentase'],
				$key['cur_id'].' '.number_format($key['nominal'], 2, '.', ','),
				$key['cur_id'].' '.number_format(floatval($key['nominal'])*floatval($key['persentase'])/100, 2, '.', ','),
				$key['create_by'],
				$key['create_date'],
				$key['approve_by'],
				$key['approve_date'],
				'<span class="label label-sm label-success">'.$key['status_pjum'].'</span>',
				// $button
			));
		}

		echo json_encode(array('data'=>$table));
	}

	public function get_list_pjum_credit_approved()
	{
		$sql="select pj.id_pjum,pt.type_top, pj.ttbp_no, pj.po_id, pm.po_no, pt.id_top, pt.nominal, pj.create_by, pj.create_date, pj.status_pjum from pjum_master pj
					join po_master pm on pm.id_po_master=pj.po_id
					join po_top pt on pt.id_top=pj.top_id where status_pjum='approved'";
		$res=$this->general_model->select($sql);
		$table=array();

		foreach ($res as $key) {

			if($_SESSION['level']=='kabag')
			{
				$button='<a class="btn btn-sm btn-success" title="bjum" href="'.site_url().'pjum/process_credit_approve/'.$key['po_id'].'/'.$key['id_top'].'/'.$key['id_pjum'].'/'.sha1($key['status_pjum']).'"><i class="glyphicon glyphicon-play"></i> Approve TTBP</a>';
			}
			else{
				$button="";
			}

			array_push($table, array(
				'<a href="'.site_url().'pjum/process_credit_approve/'.$key['po_id'].'/'.$key['id_top'].'/'.$key['id_pjum'].'/'.sha1($key['status_pjum']).'">'.$key['ttbp_no'].'</a>',
				'<a onclick="show_po('.$key['po_id'].')">'.$key['po_no'].'</a>',
				$key['id_top'],
				$key['type_top'],
				$key['nominal'],
				$key['create_by'],
				$key['create_date'],
				'<span class="label label-sm label-success">'.$key['status_pjum'].'</span>',
				// $button
			));
		}

		echo json_encode(array('data'=>$table));
	}

	public function approve_pjum($id){
		$update=$this->general_model->update('pjum_master', array('status_pjum'=>'approved', 'approve_by'=>$_SESSION['nik'], 'approve_date'=>date('Y-m-d')), array('id_pjum'=>$id));
		echo json_encode(array('status'=>true));
	}

	public function approve_pjum_pp($id){
		$update=$this->general_model->update('pjum_master_pp', array('status_pjum'=>'approved', 'approve_by'=>$_SESSION['nik'], 'approve_date'=>date('Y-m-d')), array('id_pjum'=>$id));
		echo json_encode(array('status'=>true));
	}

	//call view for input doc COD by id list cod
	public function input_doc_cod($id_po, $id_top, $id_pjum){
		$data['id_po']=$id_po;
		$data['id_top']=$id_top;
		$data['id_pjum']=$id_pjum;
		$table=array();

		$arr_cod=explode('-', $id_top);
		$table=array();
		$sum=0.0;
		if(count($arr_cod)>0){
			for ($i=0; $i < count($arr_cod); $i++) {
				$ret=$this->get_list_cod_by_id($arr_cod[$i]);
				$sum+=$ret[1];
				array_push($table, $ret[0]);
			}
		}else {

		}

		$data['table']=$table;
		$data['sum']=$sum;

		//get bpbp no
		//get list bpb_no
		$sql_bpb="SELECT DISTINCT no_bpb from mir_detail where po_id='$id_po'";
		$bpb=$this->general_model->select($sql_bpb);
		// var_dump($bpb);
		// exit;
		if(count($sql_bpb)>0){
			$data['bpb_no']=$bpb;
		}

		$dir = 'uploads/pjum/cod/'.$id_pjum;
		if(is_dir($dir)){
			$files=scandir($dir);
		}else{
			$files='';
		}
		$data['files']=array();
		for ($i=2; $i < count($files) ; $i++) {
			$dump=scandir('uploads/pjum/cod/'.$id_pjum.'/'.$files[$i]);
			if(count($dump)>2){
				array_push($data['files'], array($files[$i]=>$dump[2]));
			}
		}

		$this->load->view('cod/input_doc_cod', $data);
	}

	public function get_list_cod_by_id($id)
	{
		$sql="SELECT * FROM `po_top` pt
		join po_master pm on pm.id_po_master=pt.po_id
		join db_pembelian.po_supplier ps on ps.supplier_code=pm.code_supplier
		where type_top='cod' and pm.status_po='approved' and id_top=$id";
		$res=$this->general_model->select($sql);

		foreach ($res as $key) {
			$table=array(
				$key['id_top'],
				'<a onclick="show_po('.$key['po_id'].')">'.$key['po_no'].'</a>',
				$key['supplier_name'],
				$key['cur_id'].' '.number_format($key['nominal'], 2, '.',',' ),
				$key['create_by'],
				$key['create_date']
			);
		}
		return array($table, floatval($key['nominal']));
	}

	public function sent_mail()
	{
		// $config = Array(
		// 'protocol' => 'smtp',
		// 'smtp_host' => 'ssl://smtp.googlemail.com',
		// 'smtp_port' => 465,
		// 'smtp_user' => 'antharikta7@gmail.com', // change it to yours
		// 'smtp_pass' => 'antharikta', // change it to yours
		// 'mailtype' => 'html',
		// 'charset' => 'iso-8859-1',
		// 'wordwrap' => TRUE
		// );
		$this->load->library('email');
		$this->email->from('system@mbpurchasing.com', 'System Pembelian MB');
		$this->email->to('uuhusman@gmail.com');
		// $this->email->cc('another@another-example.com');
		// $this->email->bcc('them@their-example.com');
		$message='<img src="http://www.maju-bersama.com/_shared/assets/images/logo.png" alt="logo MB"> <br> <br>';
		$message.='<p>Dear GM of Energy </p>';
		$message.='<p>PO Baru dengan nomer <b>P00001</b> membutuhkan Approval dari anda !!!</p>';
		$message.='<a href="http://192.168.25.3/pembelian/gm/list_po_approval_gm">Silahkan Klik disini untuk melakukan Approval </a>';
		$message.='<p> Terimakasih, <br> Sistem Pembelian MB </p>';
		$this->email->subject('New PO P'.rand(0,10000).' Need for Approval');
		$this->email->message($message);
		$this->email->set_mailtype('html');
		if($this->email->send())
		{
		echo 'Email sent.';
		}
		else
		{
		show_error($this->email->print_debugger());
		}
	}


}
