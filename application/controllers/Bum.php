<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bum extends CI_Controller {

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
    $this->load->view('bum/list_bum');
  }

	public function list_bum_approved()
	{
		$this->load->view('bum/list_bum_approved');
	}

  public function get_bum_approval()
  {
    $sql="SELECT * FROM `po_bum` pb
    join po_master pm on pm.id_po_master=pb.po_id
    where pb.status_bum='open' and pm.status_po='approved' or pb.status_bum='cancel'";

    $result=$this->general_model->select($sql);

    $table=array();

    foreach ($result as $key ) {

      if($key['status_bum']=='open'){
        $stat_icon='<span class="label label-sm label-success">Open</span>';
        // $button='<a class="btn btn-sm btn-warning" title="Cancel" onclick="cancel('.$key['id_bum'].')"><i class="glyphicon glyphicon-stop"></i> Cancel</a>';
        if($_SESSION['level']=='kabag')
        {
          $button1='<a class="btn btn-sm btn-success" title="Cancel" onclick="approve('.$key['id_bum'].')"><i class="glyphicon glyphicon-pencil"></i> Approve</a>';
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
				$stat_icon,
        $button1
      ));
    }

    echo json_encode(array('data'=>$table));
  }

	public function get_bum_approved()
	{
		$sql="SELECT pb.*, pm.id_po_master, pm.po_no, pm.cur_id, bj.status_bjum FROM `po_bum` pb
		join po_master pm on pm.id_po_master=pb.po_id
		left join po_bjum bj on bj.bum_id=pb.id_bum
		where pb.status_bum='approved'";

		$result=$this->general_model->select($sql);

		// var_dump($result);
		$table=array();

		foreach ($result as $key ) {
			if($key['status_bjum']==NULL){
			$button='<a class="btn btn-sm btn-success" title="bjum" href="'.site_url().'bum/create_bjum/'.$key['id_po_master'].'/'.$key['id_bum'].'"><i class="glyphicon glyphicon-play"></i> Create PJUM</a>';
		}
		else if (($key['status_bjum']=='approved')) {
			$button="";
		}
		else {

			$button='<a class="btn btn-sm btn-success" title="bjum" href="'.site_url().'bum/edit_bjum/'.$key['id_po_master'].'/'.$key['id_bum'].'"><i class="glyphicon glyphicon-play"></i> Edit PJUM</a>';

		}

		if($key['ack_bum']=='open'){
			$stat_icon='<span class="label label-sm label-success">Waiting ACK by Keuangan</span>';
			$button='';
		}else{
			$stat_icon='<span class="label label-sm label-success">Approved</span>';
		}

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
				$stat_icon,
				$button
			));
		}

		echo json_encode(array('data'=>$table));
	}

	public function approve_bum($id)
	{
		$update=$this->general_model->update('po_bum', array('status_bum'=>'approved', 'approve_by'=>$_SESSION['nik'], 'approve_date'=>date('Y-m-d')), array('id_bum'=>$id));
		echo json_encode(array('status'=>true, 'id'=>$update));
	}

	public function approve_bjum($id)
	{
		$update=$this->general_model->update('po_bjum', array('status_bjum'=>'approved', 'approve_by'=>$_SESSION['nik'], 'approve_date'=>date('Y-m-d')), array('id_bjum'=>$id));
		echo json_encode(array('status'=>true, 'id'=>$update));
	}

	public function list_cod()
	{
		$this->load->view('cod/list_cod');
	}

	public function list_cod_input()
	{
		$this->load->view('cod/list_cod_doc');
	}

	public function get_list_cod()
	{
		$sql="SELECT * FROM `po_top` pt join po_master pm on pm.id_po_master=pt.po_id where type_top='cod' and pm.status_po='approved' and status_top!='done'";
		$res=$this->general_model->select($sql);

		$table=array();

		foreach ($res as $key) {
			array_push($table, array(
				'<td>
					<input type="checkbox" name="id_cod[]" class="checkboxes" value="'.$key['id_top'].'"/>
				</td>',
				$key['id_top'],
				'<a onclick="show_po('.$key['po_id'].')">'.$key['po_no'].'</a>',
				$key['cur_id'].' '.number_format($key['nominal']),
				$key['create_by'],
				$key['create_date']
			));
		}

		echo json_encode(array('data'=>$table));
	}

	public function get_list_cod_new()
	{
		$sql="SELECT pt.*, pm.po_no, pm.id_po_master, pm.cur_id, pj.id_pjum FROM `po_top` pt
		join po_master pm on pm.id_po_master=pt.po_id
		left join pjum_master pj on pj.po_id=pm.id_po_master
		where type_top='cod' and pm.status_po='approved'";
		$res=$this->general_model->select($sql);

		$table=array();

		foreach ($res as $key) {
			if($key['id_pjum']==''){
				$button='<a class="btn btn-sm btn-success" title="bjum" href="'.site_url().'pjum/input_doc_cod/'.$key['id_po_master'].'/'.$key['id_top'].'/0"><i class="glyphicon glyphicon-play"></i>Input Doc</a>';
			}else{
				$button='<a class="btn btn-sm btn-success" title="bjum" href="'.site_url().'pjum/input_doc_cod/'.$key['id_po_master'].'/'.$key['id_top'].'/'.$key['id_pjum'].'"><i class="glyphicon glyphicon-play"></i>Edit Doc</a>';
			}
			array_push($table, array(
				$key['id_top'],
				'<a onclick="show_po('.$key['po_id'].')">'.$key['po_no'].'</a>',
				$key['cur_id'].' '.number_format($key['nominal']),
				$key['create_by'],
				$key['create_date'],
				$button
			));
		}

		echo json_encode(array('data'=>$table));
	}

	public function get_list_cod_p()
	{
		$sql="SELECT * FROM `po_top` pt join po_master pm on pm.id_po_master=pt.po_id where type_top='cod' and pm.status_po='approved'";
		$res=$this->general_model->select($sql);

		$table=array();

		foreach ($res as $key) {
			array_push($table, array(
				'<td>
					<input type="checkbox" name="id_cod[]" class="checkboxes" value="'.$key['id_top'].'"/>
				</td>',
				$key['id_top'],
				'<a onclick="show_po('.$key['po_id'].')">'.$key['po_no'].'</a>',
				$key['cur_id'].' '.number_format($key['nominal']),
				$key['create_by'],
				$key['create_date']
			));
		}

		echo json_encode(array('data'=>$table));
	}

	public function build_cod(){
		$arr_id_cod=$this->input->post('id_cod');

		if(count($arr_id_cod)>0){
			echo json_encode(array('status'=>true, 'id'=>implode('-', $arr_id_cod)));
		}else{
			echo json_encode(array('status'=>false));
		}
	}

	public function list_credit()
	{
		$this->load->view('credit/list_credit');
	}

	private function cek_pjum($id_top){
		$sql="SELECT pt.*,pm.po_no, pm.cur_id, pj.id_pjum, pj.status_pjum, pj.invoice_value FROM `po_top` pt
		join po_master pm on pm.id_po_master=pt.po_id
		left join pjum_master pj on pj.top_id=pt.id_top
		where type_top!='cod' and pm.status_po='approved' and id_top=$id_top";
		$res=$this->general_model->select($sql);
		$nominal_invoice=0;
		$status=TRUE;

		foreach ($res as $key) {
			$nominal_invoice+=floatval($key['invoice_value']);
			if(($key['status_pjum']!='approved')&&($key['status_pjum']!='')){
				return $key['id_pjum'];
			}
		}

		if(floatval($key['nominal'])<=$nominal_invoice){
			return 'done';
		}else{
			return 'create';
		}
	}

	public function get_list_credit()
	{
		$sql="SELECT * FROM `po_top` pt
		join po_master pm on pm.id_po_master=pt.po_id
		where type_top!='cod' and pm.status_po='approved'";

		$res=$this->general_model->select($sql);
		$table=array();

		foreach ($res as $key) {
			$id_pjum=$this->cek_pjum($key['id_top']);
				if($id_pjum==='create'){
					$button='<a class="btn btn-sm btn-success" title="bjum" href="'.site_url().'pjum/process_credit/'.$key['po_id'].'/'.$key['id_top'].'/0"><i class="glyphicon glyphicon-play"></i>Create TTBP</a>';
				}else if($id_pjum==='done'){
					$button='';
				}
			else{
				$button='<a class="btn btn-sm btn-success" title="bjum" href="'.site_url().'pjum/process_credit/'.$key['po_id'].'/'.$key['id_top'].'/'.$id_pjum.'"><i class="glyphicon glyphicon-play"></i>Edit TTBP</a>';
			}

			array_push($table, array(
				$key['id_top'],
				'<a onclick="show_po('.$key['po_id'].')">'.$key['po_no'].'</a>',
				$key['type_top'],
				$key['cur_id'].' '.number_format($key['nominal']),
				$key['create_by'].'-'.$key['nama'].'-'.$key['jabatan'],
				$key['create_date'],
				$button
			));
		}

		echo json_encode(array('data'=>$table));
	}

	public function get_list_credit_by_id($id)
	{
		$sql="SELECT * FROM `po_top` pt join po_master pm on pm.id_po_master=pt.po_id where type_top!='cod' and pm.status_po='approved' and id_top=$id";
		$res=$this->general_model->select($sql);

		$table=array();

		foreach ($res as $key) {
			array_push($table, array(
				$key['id_top'],
				'<a onclick="show_po('.$key['po_id'].')">'.$key['po_no'].'</a>',
				$key['type_top'],
				$key['cur_id'].' '.number_format($key['nominal']),
				$key['create_by'].'-'.$key['nama'].'-'.$key['jabatan'],
				$key['create_date'],
				// '<a class="btn btn-sm btn-success" title="bjum" href="'.site_url().'pjum/process_credit/'.$key['po_id'].'/'.$key['id_top'].'/"><i class="glyphicon glyphicon-play"></i>Process</a>'
			));
		}

		echo json_encode(array('data'=>$table));
	}

	public function list_pp()
	{
		$this->load->view('pp/list_pp');
	}

	public function get_list_pp()
	{
		$sql="SELECT pd.id_dp, pm.id_po_master, pd.type_pp, pm.po_no, pd.po_id, pd.persentase, pm.cur_id, pd.nominal, pd.create_by, pd.create_date, pj.status_pjum  FROM `po_dp` pd
		left join po_master pm on pm.id_po_master=pd.po_id
		left join pjum_master_pp pj on pd.id_dp=pj.top_id
		where pm.status_po='approved' order by pj.status_pjum asc";
		$res=$this->general_model->select($sql);

		$table=array();

		foreach ($res as $key) {
			if($key['status_pjum']=='sent'){
				$button='<a class="btn btn-sm btn-success" title="bjum" href="'.site_url().'pjum/process_pp/'.$key['id_po_master'].'/'.$key['id_dp'].'/'.$key['type_pp'].'"><i class="glyphicon glyphicon-play"></i>Edit TTBP</a>';
			}else if($key['status_pjum']=='approved'){
				$button="";
			}else{
				$button='<a class="btn btn-sm btn-success" title="bjum" href="'.site_url().'pjum/process_pp/'.$key['id_po_master'].'/'.$key['id_dp'].'/'.$key['type_pp'].'"><i class="glyphicon glyphicon-play"></i>Create TTBP</a>';
			}

			array_push($table, array(
				$key['id_dp'],
				'<a onclick="show_po('.$key['po_id'].')">'.$key['po_no'].'</a>',
				$key['type_pp'],
				$key['persentase'],
				$key['cur_id'].' '.number_format($key['nominal']),
				$key['cur_id'].' '.number_format(floatval($key['nominal'])*floatval($key['persentase'])/100),
				$key['create_by'],
				$key['create_date'],
				$button
			));
		}

		echo json_encode(array('data'=>$table));
	}

	public function get_bum_no()
	{
		$sql="SELECT id_bum FROM `po_bum` ORDER by id_bum DESC LIMIT 1";
		$res=$this->general_model->select_row($sql);

		if(count($res)!=0){
			$last=$res['id_bum'];
			$no='BUM'.date('y').''.sprintf('%06d', intval($last)+1);
		}
		else{
			$no='BUM18000001';
		}

		echo json_encode(array('no'=>$no));

	}

	public function save_po_bum()
	{
		$col=array("bum_no", 'nama', 'jabatan', 'lama_hari', 'description');

		$data=array('po_id'=>$this->input->post('id_po_modal'), 'nominal_bum'=>str_replace(',','',$this->input->post('nominal_bum')));

		for ($i=0; $i < count($col); $i++) {
			$dump=array($col[$i]=>$this->input->post($col[$i]));
			$data=array_merge($data,$dump);
		}

		$data=array_merge($data, array('create_by'=>$_SESSION['nik'], 'create_date'=>date('Y-m-d')));

		$insert=$this->general_model->insert('po_bum', $data);

		// $upate=$this->general_model->update('po_master', array('status_bod'=>'open'), array('id_po_master'=>$this->input->post('id_po_modal')));

		echo json_encode(array('status'=>true, 'id'=>$insert, 'data'=>$data));

	}

	public function delete_bum($id)
	{
		$sql="SELECT * FROM po_bum where id_bum='$id'";
		$res=$this->general_model->select_row($sql);
		$this->general_model->delete($id, 'id_bum', 'po_bum');
		// $upate=$this->general_model->update('po_master', array('status_bod'=>''), array('id_po_master'=>$res['po_id']));
		echo json_encode(array('status'=>true));
	}


	public function get_list_material_po($po_master_id, $id_bum)
	{
		$sql="SELECT * FROM po_detail pd
		join po_master pm on pm.id_po_master=pd.po_master_id
		join po_bum pb on pb.po_id=pm.id_po_master
		WHERE pd.po_master_id = '$po_master_id' ";
		$res=$this->general_model->select($sql);
		// var_dump($res);
		// exit;
		$table=array();
		foreach ($res as $key) {
			if($key['jumlah_bjum']==0){
				$jumlah=$key['jumlah'];
			}else{
				$jumlah=$key['jumlah_bjum'];
			}
			$this->session->set_userdata(array('bum_no'=>$key['bum_no']));
			array_push($table, array(
				$key['po_no'].'<input type="hidden" name="id_po_detail[]" value="'.$key['id_po_detail'].'" class="form-control">',
				$key['bum_no'].'<input type="hidden" name="nominal_bum" value="'.$key['nominal_bum'].'">',
				$key['nama_pasar'],
				$key['merek'],
				$key['qty_po'],
				$key['stn_po'],
				$key['hgs'],
				$key['disc'],
				$key['jumlah'].'<input style="width: 100px;" type="hidden"  class="form-control jumlah" name="'.$key['id_po_detail'].'_jumlah_bjum" value="'.$key['jumlah'].' ">',
				'<input style="width: 100px;" type="text"  class="form-control " name="'.$key['id_po_detail'].'_date_bjum" value="'.date('Y-m-d').' ">',
				'<input style="width: 100px;" type="text"  class="form-control jumlah_bjum" name="'.$key['id_po_detail'].'_jumlah_bjum" value="'.$jumlah.' ">',
				'<input style="width: 100px;" type="text"  class="form-control " name="'.$key['id_po_detail'].'_keterangan_bjum" value="'.$key['keterangan_bjum'].'">',
				'<input style="width: 100px;" type="text"  class="form-control " name="'.$key['id_po_detail'].'_no_perkiraan_bjum" value="'.$key['no_perkiraan_bjum'].'">',
			));
		}


		echo json_encode(array('data'=>$table));



	}
	public function save_po_detail_ex()
	{
		$col=array('date_bjum', 'jumlah_bjum', 'keterangan_bjum', 'no_perkiraan_bjum');
		$datas=array();
		// $id_pr=$this->input->post('id_pr');
		$id_po_detail=$this->input->post('id_po_detail');

		for ($i=0; $i < count($id_po_detail) ; $i++) {
			for ($j=0; $j < count($col) ; $j++) {
				//save to array
				$dump=array(
					$col[$j]=>$this->input->post($id_po_detail[$i]."_".$col[$j])
				);
				$datas=array_merge($datas, $dump);
			}

			$update=$this->general_model->update('po_detail', $datas, array('id_po_detail'=>$id_po_detail[$i]));
		}

		echo json_encode(array('status'=>true));

	}


	// public function validate_bjum()
	// {
	// 	$data['error_string'] = array();
	// 	$data['inputerror'][] = array();
	// 	$data['status'] = TRUE;
	//
	// 	$col=array('bum_no', 'nama', 'bagian', 'jumlah_bum', 'jumlah_bjum', 'selisih', 'invoice_no', 'invoice_date', 'sj_no', 'sj_date', 'fp_no', 'fp_date', 'bpb_no', 'bpb_date');
	//
	// 	for ($i=0; $i < count($col) ; $i++) {
	// 		if($this->input->post($col[$i])==''){
	// 			$data['error_string'][]='empty';
	// 			$data['inputerror'][]=$col[$i];
	// 			$data['status']=FALSE;
	// 		}
	// 	}
	//
	// 	if($data['status']===FALSE){
	// 		echo json_encode($data);
	// 		exit();
	// 	}
	//
	// }

	public function save_bjum()
	{
		$col=array('bum_no', 'nama', 'bagian', 'jumlah_bum', 'jumlah_bjum', 'selisih', 'invoice_no', 'invoice_date', 'sj_no', 'sj_date', 'fp_no', 'fp_date', 'doc_no', 'doc_date');

		$data=array('po_id'=>$this->input->post('id_po'), 'bum_id'=>$this->input->post('id_bum'), 'create_by'=>$_SESSION['nik'], 'create_date'=>date('Y-m-d'));

		for ($i=0; $i < count($col) ; $i++) {
			$dump=array($col[$i]=>$this->input->post($col[$i]));
			$data=array_merge($data, $dump);
		}
		$arr_bpb=$this->input->post('bpb_no');
		if(count($arr_bpb)>0){
			$bpb_final=implode(",", $arr_bpb);
		}else {
			$bpb_final="";
		}
		$nominal=array('jumlah_bjum'=>str_replace(',','',$this->input->post('total')), 'bpb_no'=>$bpb_final, 'jumlah_bum'=>str_replace(',','',$this->input->post('jumlah_bum')));
		$data=array_merge($data, $nominal);

		$id_po=$this->input->post('id_po');

		//cek apakah udah ada atau blm
		$sql="select * from po_bjum where po_id='$id_po'";
		$cek_hasil=$this->general_model->select($sql);

		if(count($cek_hasil)==0){
			$insert=$this->general_model->insert('po_bjum', $data);
		}else{
			$insert=$this->general_model->update('po_bjum', $data, array('id_bjum'=>$cek_hasil[0]['id_bjum']));
		}

		$update=$this->general_model->update('po_bum', array('bjum_id'=>$insert), array('id_bum'=>$this->input->post('id_bum')));

		$files=array('invoice', 'fp', 'sj', 'doc');
		//upload attachment
		$dataa['error_string'] = array();
		$dataa['inputerror'][] = array();
		$dataa['status'] = TRUE;

		for ($i=0; $i < count($files) ; $i++) {
			$up_mes=$this->upload_file($insert, $files[$i]);

			if(($up_mes!=1) && ($up_mes!=null)){
				$dataa['error_string'][] = $up_mes;
				$dataa['inputerror'][] =  $files;
				$dataa['status'] = FALSE;
			}
		}

		if($dataa['status']===FALSE){
			echo json_encode($dataa);
		}
		else {
			echo json_encode(array('status'=>true, 'id_bjum'=>$insert));
		}
	}

	public function update_bjum()
	{
		// $col=array('bum_no', 'nama', 'bagian', 'jumlah_bum', 'jumlah_bjum', 'selisih' );
		$col=array('bum_no', 'nama', 'bagian', 'jumlah_bum', 'jumlah_bjum', 'selisih', 'invoice_no', 'invoice_date', 'sj_no', 'sj_date', 'fp_no', 'fp_date', 'bpb_date', 'doc_no', 'doc_date');

		$data=array('po_id'=>$this->input->post('id_po'), 'bum_id'=>$this->input->post('id_bum'), 'create_by'=>$_SESSION['nik'], 'create_date'=>date('Y-m-d'));

		for ($i=0; $i < count($col) ; $i++) {
			$dump=array($col[$i]=>$this->input->post($col[$i]));
			$data=array_merge($data, $dump);
		}

		$arr_bpb=$this->input->post('bpb_no');
		if(count($arr_bpb)>0){
			$bpb_final=implode(",", $arr_bpb);
		}else {
			$bpb_final="";
		}

		$nominal=array('jumlah_bjum'=>str_replace(',','',$this->input->post('total')), 'bpb_no'=>$bpb_final, 'jumlah_bum'=>str_replace(',','',$this->input->post('jumlah_bum')));
		$data=array_merge($data, $nominal);
		$insert=$this->general_model->update('po_bjum', $data, array('id_bjum'=>$this->input->post('id_bjum')));

		$update=$this->general_model->update('po_bum', array('bjum_id'=>$insert), array('id_bum'=>$this->input->post('id_bum')));

		$files=array('invoice', 'fp', 'sj');
		//upload attachment
		$dataa['error_string'] = array();
		$dataa['inputerror'][] = array();
		$dataa['status'] = TRUE;

		for ($i=0; $i < count($files) ; $i++) {
			$up_mes=$this->upload_file($this->input->post('id_bjum'), $files[$i]);

			if(($up_mes!=1) && ($up_mes!=null)){
				$dataa['error_string'][] = $up_mes;
				$dataa['inputerror'][] =  $files;
				$dataa['status'] = FALSE;
			}
		}

		if($dataa['status']===FALSE){
			echo json_encode($dataa);
		}
		else {
			echo json_encode(array('status'=>true, 'id_bjum'=>$insert));
		}
	}

	public function validate_bjum()
	{
		$data['error_string'] = array();
		$data['inputerror'][] = array();
		$data['status'] = TRUE;

		$col=array( 'invoice_no', 'invoice_date', 'sj_no', 'sj_date', 'fp_no', 'fp_date', 'bpb_no');

		for ($i=0; $i < count($col) ; $i++) {
			if($this->input->post($col[$i])==''){
				$data['error_string'][]='Cannot empty';
				$data['inputerror'][]=$col[$i];
				$data['status']=FALSE;
			}
		}

		if($data['status']===FALSE){
			echo json_encode($data);
			exit();
		}

	}

	public function delete_bjum(){
		$id_bjum=$this->input->post('id');
		$folder=$this->input->post('folder');
		$file=$this->input->post('file');

		$path_file_nya=$_SERVER['DOCUMENT_ROOT'].'/pembelian/uploads/bjum/'.$id_bjum.'/'.$folder.'/'.$file;
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

	public function sent_bjum()
	{
		$this->validate_bjum();
		$update=$this->general_model->update('po_bjum', array('status_bjum'=>'sent'), array('bum_id'=>$this->input->post('id_bum')));
		echo json_encode(array('status'=>true, 'id_bjum'=>$update));
	}

	//upload file on sppr
	public function upload_file($id_bjum, $name)
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

					$uploadPath = 'uploads/bjum/'.$id_bjum.'/'.$name;
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


	public function list_bjum_approval()
	{
		$this->load->view('bum/list_bjum');
	}

	public function get_list_bjum_approval()
	{
			$sql="SELECT * FROM `po_bjum` pb
			join po_master pm on pm.id_po_master=pb.po_id
		 	WHERE `status_bjum` = 'sent'";
			$res=$this->general_model->select($sql);

			$table=array();

			foreach ($res as $key) {

				if($_SESSION['level']=='kabag')
				{
					$button='<a class="btn btn-sm btn-success" title="bjum" href="'.site_url().'bum/view_bjum/'.$key['po_id'].'/'.$key['bum_id'].'/'.sha1($key['status_bjum']).'"><i class="glyphicon glyphicon-play"></i> Approve PJUM</a>';
				}
				else{
					$button="";
				}
				$this->session->set_userdata(array('id_bjum'=>$key['id_bjum']));
				array_push($table, array(
					$key['id_bjum'],
					'<a onclick="show_po('.$key['po_id'].')">'.$key['po_no'].'</a>',
					$key['bum_no'],
					$key['jumlah_bum'],
					$key['jumlah_bjum'],
					$key['selisih'],
					$key['create_by'],
					'<span class="label label-sm label-success">'.$key['status_bjum'].'</span>',
					$button
				));
			}

			echo json_encode(array('data'=>$table));
	}

	public function get_list_bjum_approved()
	{
		$sql="SELECT * FROM `po_bjum` pb
		join po_master pm on pm.id_po_master=pb.po_id
		WHERE `status_bjum` = 'approved'";
		$res=$this->general_model->select($sql);

		$table=array();

		foreach ($res as $key) {
			$this->session->set_userdata(array('id_bjum'=>$key['id_bjum']));
			if($key['ack_pjum']=='open'){
				$stat='<span class="label label-sm label-warning">Waiting ACKk from Keuangan</span>';
			}else{
				$stat='<span class="label label-sm label-success">'.$key['status_bjum'].'</span>';
			}
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
				$key['approve_date']
			));
		}

		echo json_encode(array('data'=>$table));
	}

	public function get_data_bjum($id_bjum){
		$sql="select * from po_bjum where id_bjum=$id_bjum";
		$res=$this->general_model->select_row($sql);
		$data=array(
			$res['invoice_no'],
			$res['invoice_date'],
			$res['sj_no'],
			$res['sj_date'],
			$res['fp_no'],
			$res['fp_date'],
			$res['doc_no'],
			$res['doc_date'],
			explode(',',$res['bpb_no']),
		);
		echo json_encode($data);
	}

	public function edit_bjum($id_po_master, $id_bum)
	{
		$data['id_po']=$id_po_master;
		$data['id_bum']=$id_bum;
		$data['id_bjum']=0;

		//get list bpb_no
		$sql_bpb="SELECT DISTINCT no_bpb from mir_detail where po_id='$id_po_master' and status_bpb='approved'";
		$bpb=$this->general_model->select($sql_bpb);

		if(count($sql_bpb)>0){
			$data['bpb_no']=$bpb;
		}

		$sqlq="SELECT `bum_no` FROM `po_bum` where id_bum=$id_bum";
		$bum_no=$this->general_model->select_row($sqlq);
		$data['bum_no']=$bum_no['bum_no'];

		$sql="select * from po_bjum where bum_id=$id_bum";
		$res=$this->general_model->select_row($sql);
		if(count($res)>0){
		// $data['pjum_data']=$res;
		$data['id_bjum']=$res['id_bjum'];
		$id_bjum=$res['id_bjum'];
		$dir = 'uploads/bjum/'.$id_bjum;

		if(is_dir($dir)){
			$files=scandir($dir);
		}else{
			$files='';
		}
		$data['files']=array();
		for ($i=2; $i < count($files) ; $i++) {
			$dump=scandir('uploads/bjum/'.$id_bjum.'/'.$files[$i]);
			if(count($dump>2)){
				if(isset($dump[2])){
				array_push($data['files'], array($files[$i]=>$dump[2]));
				}
			}
		}
		}
		//
		// var_dump($data['files']);
		// exit;
		// $sql="SELECT * FROM `po_detail` WHERE `po_master_id` = '$id_po_master' ";

		// $result=$this->general_model->select($sql);
		// $data['table']=$result;

		// var_dump($data);
		// exit;

		$this->load->view('bum/edit_bjum', $data);
	}

	public function view_bjum($id_po_master, $id_bum, $status)
		{
			$data['id_po']=$id_po_master;
			$data['id_bum']=$id_bum;
			$data['id_bjum']=0;
			$data['status']=$status;

			//get list bpb_no
			// $sql_bpb="SELECT DISTINCT no_bpb from mir_detail where po_id='$id_po_master'";
			$sql_bpb="SELECT DISTINCT no_bpb from mir_detail where po_id='$id_po_master' and status_bpb='approved'";
			$bpb=$this->general_model->select($sql_bpb);

			if(count($sql_bpb)>0){
				$data['bpb_no']=$bpb;
			}

			$sqlq="SELECT `bum_no` FROM `po_bum` where id_bum=$id_bum";
			$bum_no=$this->general_model->select_row($sqlq);
			$data['bum_no']=$bum_no['bum_no'];

			$sql="select * from po_bjum where bum_id=$id_bum";
			$res=$this->general_model->select_row($sql);
			if(count($res)>0){
			$data['id_bjum']=$res['id_bjum'];
			$id_bjum=$res['id_bjum'];
			$dir = 'uploads/bjum/'.$id_bjum;

			if(is_dir($dir)){
				$files=scandir($dir);
			}else{
				$files='';
			}
			$data['files']=array();
			for ($i=2; $i < count($files) ; $i++) {
				$dump=scandir('uploads/bjum/'.$id_bjum.'/'.$files[$i]);
				if(count($dump)>2){
					array_push($data['files'], array($files[$i]=>$dump[2]));
				}
			}
			}
			//
			// var_dump($data['files']);
			// exit;
			// $sql="SELECT * FROM `po_detail` WHERE `po_master_id` = '$id_po_master' ";

			// $result=$this->general_model->select($sql);
			// $data['table']=$result;

			// var_dump($data);
			// exit;

			$this->load->view('bum/approve_bjum', $data);
		}

		public function create_bjum($id_po_master, $id_bum)
		{
			$data['id_po']=$id_po_master;
			$data['id_bum']=$id_bum;

			//get list bpb_no
			// $sql_bpb="SELECT DISTINCT no_bpb from mir_detail where po_id='$id_po_master'";
			$sql_bpb="SELECT DISTINCT no_bpb from mir_detail where po_id='$id_po_master' and status_bpb='approved'";
			$bpb=$this->general_model->select($sql_bpb);

			if(count($sql_bpb)>0){
				$data['bpb_no']=$bpb;
			}

			$sqlq="SELECT `bum_no` FROM `po_bum` where id_bum=$id_bum";
			$bum_no=$this->general_model->select_row($sqlq);
			$data['bum_no']=$bum_no['bum_no'];

			// $sql="SELECT * FROM `po_detail` WHERE `po_master_id` = '$id_po_master' ";
			//
			// $result=$this->general_model->select($sql);
			// $data['table']=$result;
			$sql="select * from po_bjum where bum_id=$id_bum";
			$res=$this->general_model->select_row($sql);
			if(count($res)>0){

			$id_bjum=$res['id_bjum'];
			$dir = 'uploads/bjum/'.$id_bjum;

			if(is_dir($dir)){
				$files=scandir($dir);
			}else{
				$files='';
			}
			$data['files']=array();
			for ($i=2; $i < count($files) ; $i++) {
				$dump=scandir('uploads/bjum/'.$id_bjum.'/'.$files[$i]);
				if(count($dump>2)){
					array_push($data['files'], array($files[$i]=>$dump[2]));
				}
			}
			}

			$this->load->view('bum/create_bjum', $data);
		}

		public function list_bjum_approved()
		{
			$this->load->view('bum/list_bjum_approved');
		}

		public function process_cod($id_cod, $roll_no){
			$arr_cod=explode('-', $id_cod);
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
			$data['roll_no']=$roll_no;
			$data['total']=$sum;
			$data['table']=$table;
			$data['id_cod']=$id_cod;
			$this->load->view('cod/process_cod', $data);
		}

		public function approve_view_cod($id_cod, $roll_no, $id_roll, $stat){
			$arr_cod=explode('-', $id_cod);
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
			$data['stat']=$stat;
			$data['id_roll']=$id_roll;
			$data['roll_no']=$roll_no;
			$data['total']=$sum;
			$data['table']=$table;
			$data['id_cod']=$id_cod;
			$this->load->view('cod/process_cod', $data);
		}

		public function get_list_cod_by_id($id)
		{
			$sql="SELECT * FROM `po_top` pt
			join po_master pm on pm.id_po_master=pt.po_id
			join db_pembelian.po_supplier ps on ps.supplier_code=pm.code_supplier
			left join pjum_master pj on pj.po_id=pm.id_po_master
			where type_top='cod' and pm.status_po='approved' and id_top=$id";
			$res=$this->general_model->select($sql);

			foreach ($res as $key) {
				$table=array(
					$key['id_top'],
					'<a onclick="show_po('.$key['po_id'].')">'.$key['po_no'].'</a>',
					$key['supplier_name'],
					$key['cur_id'].' '.number_format($key['nominal'], 2, '.',',' ),
					$key['create_by'],
					$key['create_date'],
					'<a class="btn btn-sm btn-success" title="bjum" href="'.site_url().'pjum/input_doc_cod/'.$key['id_po_master'].'/'.$key['id_top'].'/'.$key['id_pjum'].'"><i class="glyphicon glyphicon-play"></i>Cek Kelengkapan Doc</a>'
				);
			}
			return array($table, floatval($key['nominal']));
		}

		public function save_process_cod(){
			$col=array('roll_no', 'roll_date', 'roll_ids');

			$data=array('roll_total'=>str_replace(',','', $this->input->post('roll_total')), 'create_by'=>$_SESSION['nik'], 'create_date'=>date('y-m-d'));
			for ($i=0; $i < 3 ; $i++) {
				$dump=array(
					$col[$i]=>$this->input->post($col[$i])
				);
				$data=array_merge($data, $dump);
			}
			$insert=$this->general_model->insert('roll_cod', $data);
			$id_cod=explode('-', $this->input->post('roll_ids'));
			// var_dump($id_cod);
			for ($i=0; $i < count($id_cod); $i++) {
				$this->general_model->update('po_top', array('status_top'=>'done'), array('id_top'=>$id_cod[$i]));
			}

			echo json_encode(array('status'=>true, 'id'=>$insert));
		}

		public function list_p_cod(){
			$this->load->view('cod/list_r_cod');
		}

		public function get_list_cod_roll()
		{
			$sql="SELECT * FROM `roll_cod` where status_roll!='approved'";
			$res=$this->general_model->select($sql);
			$table=array();
			foreach ($res as $key ) {

				if($key['status_roll']=='open'){
					$stat_icon='<span class="label label-sm label-success">Open</span>';
					// $button='<a class="btn btn-sm btn-warning" title="Cancel" onclick="cancel('.$key['id_bum'].')"><i class="glyphicon glyphicon-stop"></i> Cancel</a>';
					if($_SESSION['level']=='kabag')
					{
						$button1='<a class="btn btn-sm btn-success" title="Cancel" onclick="approve('.$key['id_roll'].')"><i class="glyphicon glyphicon-pencil"></i> Approve</a>';
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

		public function get_list_cod_roll_approved()
		{
			$sql="SELECT * FROM `roll_cod` where status_roll='approved'";
			$res=$this->general_model->select($sql);
			$table=array();
			foreach ($res as $key ) {
				if($key['ack_status']=='approved'){
					$stat_icon='<span class="label label-sm label-success">Approved</span>';
				}else{
					$stat_icon='<span class="label label-sm label-warning">Waitting ACK by Keuangan</span>';
				}

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
					// $button1
				));
			}

			echo json_encode(array('data'=>$table));
		}

		public function approve_cod($id){
			$up=$this->general_model->update('roll_cod', array('status_roll'=>'approved', 'approve_by'=>$_SESSION['nik'], 'approve_date'=>date('Y-m-d')), array('id_roll'=>$id));
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

		public function list_approved_cod(){
			$this->load->view('cod/list_r_cod_approved');
		}

	} //end of Class
