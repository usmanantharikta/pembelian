<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Po extends CI_Controller {

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


	/*
	* ============================================================================================================================================================================================================
	* Page Create PO
	* =================================================================================================================================================================================================================
	*/

	public function create($id_po)
	{
		$data['id_po']=$id_po;
		$data['currency']=$this->get_currency();
		$data['supplier']=$this->get_supplier();
		$data['address']=$this->get_address();
		$this->load->view('po/create', $data);
	}

	public function get_supplier()
	{
		$sql="SELECT supplier_code, supplier_name, contact_name, telp, fax FROM `po_supplier`";
		$res=$this->general_model->select_db2($sql);

		$data=array();

		foreach ($res as $key) {
			array_push( $data, array(
				'value'=>$key['supplier_code'].'%'.$key['supplier_name'].'%'.$key['contact_name'].'%'.$key['telp'].'%'.$key['fax'],
				'text'=>$key['supplier_code'].'-'.$key['supplier_name']
			));
		}

		return $data;
	}



	public function get_address()
	{
		$sql="SELECT * FROM `po_address` ORDER BY `po_address`.`id_address` ASC";
		$res=$this->general_model->select_db2($sql);

		$data=array();

		foreach ($res as $key) {
			array_push( $data, array(
				'value'=>$key['id_address'],
				'text'=>$key['id_address'].'-'.$key['address']
			));
		}

		return $data;
	}

	public function get_currency()
	{
		$sql="SELECT * FROM `po_currency`";
		$res=$this->general_model->select_db2($sql);

		$data=array();

		foreach ($res as $key) {
			array_push( $data, array(
				'value'=>$key['name'],
				'text'=>$key['name']
			));
		}

		return $data;
	}

	public function get_po($id_po)
	{
		$sql="SELECT * FROM `po_master` WHERE id_po_master=$id_po";
		$result=$this->general_model->select_row($sql);
		$id_pr=explode('-', $result['id_pr']);

		$table=array();

		for ($i=0; $i < count($id_pr); $i++) {
			array_push($table, $this->get_pr_detail($id_pr[$i]) );
		}

		echo json_encode(array('data'=>$table));

	}

	private function get_pr_detail($id_pr)
	{
		$sql="SELECT pd.status_po_detail, pd.qty_buy, pmd.no_sppr, pmd.pr_no, pmd.id_pr,
		pmd.material_id as 'id_mat', d.dkp_no, dm.kode_barang, dm.nama_bahan, dm.material_name,
		dm.date_bth , pmd.qty_angka, pmd.qty_tot_buy, pm.status_pr, dm.*, pd.id_po_detail,
		pd.merek, pd.qty_po, pd.stn_po, pd.hgs, pd.disc, pd.jumlah, pd.last_hgs
		FROM pr_material_detail pmd
		join pr_master pm on pm.id_pr_master=pmd.pr_master_id
		join dkp_material dm on dm.id_material=pmd.material_id
		join dkp_master d on d.id_dkp=dm.dkp_id
    join po_detail pd on pd.pr_id=pmd.id_pr
		where pmd.id_pr='$id_pr'";

		$result=$this->general_model->select($sql);
    // var_dump($result);
    // exit;
		foreach ($result as $key) {
      $id_po_detail=$key['id_po_detail'];
			if($key['status_po_detail']=='open')
			{
				$button='<a class="btn btn-sm btn-success" title="Cancel" onclick="edit_po('.$id_po_detail.','.$key['id_pr'].')"><i class="glyphicon glyphicon-pencil"></i> Input </a>';
			}
			else {
				$button='<a class="btn btn-sm btn-warning" title="Cancel" onclick="edit_po('.$id_po_detail.','.$key['id_pr'].')"><i class="glyphicon glyphicon-pencil"></i> Edit </a>';
			}

			$data=array(
					$key['pr_no'].' '.'<input type="hidden" name="id_pr[]" value="'.$key['id_pr'].'" class="form-control">',
					$button,
					$key['dkp_no'],
					$key['nama_bahan'],
					$key['kode_barang'],
					$key['merek'],
					$key['no_sppr'],
					$key['qty_angka'], //qty out
					$key['qty_buy'],
					$key['satuan'], //stn
					$key['qty_po'],
					$key['stn_po'],
					$key['hgs'],
					$key['disc'],
					$key['jumlah'],
					$key['last_hgs'],
				);
		}
		return $data;
	}

	public function create_po($id_po)
	{
		$data['id_po']=$id_po;
		$data['currency']=$this->get_currency();
		$data['supplier']=$this->get_supplier();
		$data['address']=$this->get_address();
		$this->load->view('po/create_experiment', $data);
	}

	public function create_po_other()
	{
		// $data['id_po']=$id_po;
		$data['currency']=$this->get_currency();
		$data['supplier']=$this->get_supplier();
		$data['address']=$this->get_address();
		// $this->load->view('po/create_experiment', $data);
		$this->load->view('po/create_po_other', $data);
	}

	// public function get_po_edit($id_po)
	// {
	// 	$sql="SELECT * FROM `po_master` WHERE id_po_master=$id_po";
	// 	$result=$this->general_model->select_row($sql);
	// 	$id_pr=explode('-', $result['id_pr']);
	//
	// 	$table=array();
	//
	// 	for ($i=0; $i < count($id_pr); $i++) {
	// 		array_push($table, $this->get_pr_detail_edit($id_pr[$i]) );
	// 	}
	//
	// 	echo json_encode(array('data'=>$table));
	//
	// }

	// public function get_po_edit_other($id_po)
	// {
	// 	$sql="SELECT * FROM `po_master` WHERE id_po_master=$id_po";
	// 	$result=$this->general_model->select_row($sql);
	// 	$id_pr=explode('-', $result['id_pr']);
	//
	// 	$table=array();
	//
	// 	for ($i=0; $i < count($id_pr); $i++) {
	// 		array_push($table, $this->get_pr_detail_edit_other($id_pr[$i]) );
	// 	}
	//
	// 	echo json_encode(array('data'=>$table));
	//
	// }

	public function get_po_edit_other($id_pr)
	{
		$sql="select * from po_detail pd
					join po_master pm on pm.id_po_master=pd.po_master_id where id_po_master=$id_pr";

		$result=$this->general_model->select($sql);

		echo json_encode(array('isi'=>$result));
	}

	public function get_po_edit($id_po)
	{
		$sql="SELECT * FROM po_detail pd
					join pr_material_detail pmd on pmd.id_pr=pd.pr_id
					join pr_master pm on pm.id_pr_master=pmd.pr_master_id
					join dkp_material dm on dm.id_material=pmd.material_id
					join dkp_master d on d.id_dkp=dm.dkp_id
					where pd.po_master_id='$id_po'";
		// $sql="SELECT pd.status_po_detail, pd.qty_buy, pmd.no_sppr, pmd.pr_no, pmd.id_pr,
		// pmd.material_id as 'id_mat', d.dkp_no, dm.kode_barang, dm.nama_bahan, dm.material_name,
		// dm.date_bth , pmd.qty_angka, pmd.qty_tot_buy, pm.status_pr, dm.*, pd.id_po_detail,
		// pd.merek, pd.qty_po, pd.stn_po, pd.hgs, pd.disc, pd.jumlah, pd.last_hgs, pd.ppn, pd.pph
		// FROM pr_material_detail pmd
		// join pr_master pm on pm.id_pr_master=pmd.pr_master_id
		// join dkp_material dm on dm.id_material=pmd.material_id
		// join dkp_master d on d.id_dkp=dm.dkp_id
		// join po_detail pd on pd.pr_id=pmd.id_pr
		// where pmd.id_pr='$id_pr'";

		$result=$this->general_model->select($sql);
		// var_dump($result);
		// exit;
		$table=array();
		foreach ($result as $key) {
			$id_po_detail=$key['id_po_detail'];
			if($key['status_po_detail']=='open')
			{
				$button='<a class="btn btn-sm btn-success" title="Cancel" onclick="edit_po('.$id_po_detail.','.$key['id_pr'].')"><i class="glyphicon glyphicon-pencil"></i> Input </a>';
			}
			else {
				$button='<a class="btn btn-sm btn-warning" title="Cancel" onclick="edit_po('.$id_po_detail.','.$key['id_pr'].')"><i class="glyphicon glyphicon-pencil"></i> Edit </a>';
			}
			$nama_pasar="'".$key['nama_bahan']."'";

			$data=array(
					$key['dkp_no'].'<input type="hidden" name="id_po_detail[]" value="'.$key['id_po_detail'].'" class="form-control">'.'<input type="hidden" name="id_pr[]" value="'.$key['id_pr'].'" class="form-control">',
					'<p  style="width: 300px;">'.$key['nama_bahan'].'</p>',
					$key['kode_barang'],
					'<input style="width: 300px;" type="text" class="form-control mereknya" name="'.$key['id_po_detail'].'_nama_pasar" value='.$nama_pasar.'>',
					'<input style="width: 100px;" type="text" class="form-control mereknya" name="'.$key['id_po_detail'].'_merek" value="'.$key['merek'].'">',
					// $key['merek'],
					$key['no_sppr'],
					$key['qty_angka'], //qty out
					'<input style="width: 50px;" type="text"  class="form-control" name="'.$key['id_po_detail'].'_qty_buy" value="'.$key['qty_buy'].'  "><span class="help-block"></span>',
					// $key['qty_buy'],
					$key['satuan'], //stn
					'<input style="width: 50px;" type="text"  class="form-control qty_po" name="'.$key['id_po_detail'].'_qty_po" value="'.$key['qty_po'].'  ">',
					// $key['qty_po'],
					'<input style="width: 100px;" type="text"  class="form-control" name="'.$key['id_po_detail'].'_stn_po" value="'.$key['stn_po'].'  ">',
					// $key['stn_po'],
					'<input style="width: 200px;" type="text"  class="form-control hgs" name="'.$key['id_po_detail'].'_hgs" value="'.$key['hgs'].'"><span class="help-block"></span>',
					// $key['hgs'],
					'<input style="width: 50px;" type="text"  class="form-control disc" name="'.$key['id_po_detail'].'_disc" value="'.$key['disc'].' ">',
					'<input style="width: 200px;" type="text"  class="form-control jumlah" name="'.$key['id_po_detail'].'_jumlah" value="'.$key['jumlah'].' ">',
					'<input style="width: 100px;" type="text"  class="form-control ppn" name="'.$key['id_po_detail'].'_ppn" value="'.$key['ppn'].' ">',
					'<input style="width: 100px;" type="text"  class="form-control pph" name="'.$key['id_po_detail'].'_pph" value="'.$key['pph'].' ">',
					// $key['disc'],
					// $key['disc'],
					// $key['jumlah'],
					// '<input style="width: 50px;" type="text  class="form-control input-small" name="'.$key['id_po_detail'].'_last_hgs[]" value="'.$key['last_hgs'].' ">',
					$key['last_hgs'],
					$key['basic_price_budget']
				);
				array_push($table, $data);
		}

		echo json_encode(array('data'=>$table));
	}

	private function get_max_po($id_pr, $id_po)
	{
		$sql="SELECT qty_angka, qty_tot_buy FROM `pr_material_detail` WHERE `id_pr` = '$id_pr'";
		$res=$this->general_model->select_row($sql);
		// var_dump($res);
		// exit;
		$sqli="SELECT qty_buy FROM `po_detail` WHERE `id_po_detail` = '$id_po'";
		$resu=$this->general_model->select_row($sqli);
		// var_dump($resu);
		// exit;
		$total=floatval($res['qty_angka'])-(floatval($res['qty_tot_buy'])-floatval($resu['qty_buy']));
		return $total;
	}

	public function save_po_detail()
	{
		$col=array('qty_buy','qty_po', 'stn_po', 'hgs', 'disc', 'jumlah');
		$datas=array('merek'=>$this->input->post('merek'));
		$id_pr=$this->input->post('id_pr_detail');

		//validate
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		$max=$this->get_max_po($id_pr, $this->input->post('id_po_detail'));
		if($max < $this->input->post('qty_buy'))
		{
			$data['inputerror'][] = 'qty_buy';
			$data['error_string'][] ="NOt Valid Max ".$max;
			$data['status'] = FALSE;
		}

		if($this->input->post('qty_buy')=='0')
		{
			$data['inputerror'][] = 'qty_buy';
			$data['error_string'][] ="Can't 0";
			$data['status'] = FALSE;
		}

		for ($i=0; $i < count($col) ; $i++) {

			//save to array
			$dump=array(
				$col[$i]=>$this->input->post($col[$i])
			);
			$datas=array_merge($datas, $dump);
		}

		if($data['status'] === FALSE)
		{
				echo json_encode($data);
				exit();
		}

		$tambahan=array('status_po_detail'=>'edit');
		$datas=array_merge($datas, $tambahan);

		$update=$this->general_model->update('po_detail', $datas, array('id_po_detail'=>$this->input->post('id_po_detail')));

		if($update!=0)
		{
			$this->update_qty_tot($id_pr, $this->input->post('id_po_detail')); //pdate qty_tot di table pr_material_detail
		}

		$id_po_modal=$this->input->post('id_po_modal');
		$sql_sum="SELECT sum(jumlah) as 'sum' FROM `po_detail` where po_master_id= $id_po_modal";
		$sum_po=$this->general_model->select_row($sql_sum);

		echo json_encode(array('status'=>true,'total'=>$sum_po['sum']));
	}

	public function save_po_detail_ex()
	{
		$col=array('nama_pasar', 'merek','qty_buy','qty_po', 'stn_po', 'hgs', 'disc', 'jumlah', 'ppn', 'pph');
		$datas=array();
		$id_pr=$this->input->post('id_pr');
		$id_po=$this->input->post('id_po');
		$id_po_detail=$this->input->post('id_po_detail');

		// var_dump($id_pr);
		// var_dump($id_po_detail);
		// exit();
		//validate
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($id_pr!=NULL){
		for ($i=0; $i < count($id_po_detail) ; $i++) {
			$max=$this->get_max_po($id_pr[$i], $id_po_detail[$i]);
			if($max < $this->input->post($id_po_detail[$i].'_qty_buy'))
			{
				$data['inputerror'][] = $id_po_detail[$i].'_qty_buy';
				$data['error_string'][] ="NOt Valid Max ".$max;
				$data['status'] = FALSE;
			}
		}
	}

		if($data['status'] === FALSE)
		{
				echo json_encode($data);
				exit();
		}

		// echo json_encode($data);
		// exit();

		for ($i=0; $i < count($id_po_detail) ; $i++) {
			for ($j=0; $j < count($col) ; $j++) {
				//save to array
				$dump=array(
					$col[$j]=>$this->input->post($id_po_detail[$i]."_".$col[$j])
				);
				$datas=array_merge($datas, $dump);
			}

			if(floatval($this->input->post($id_po_detail[$i]."_hgs")) > floatval($this->get_last_hgs($this->input->post($id_po_detail[$i]."_nama_pasar"), $this->input->post($id_po_detail[$i]."_hgs")))){

			}

			$tambahan=array('status_po_detail'=>'edit', 'last_hgs'=>$this->get_last_hgs($this->input->post($id_po_detail[$i]."_nama_pasar"), $this->input->post($id_po_detail[$i]."_hgs")));
			$datas=array_merge($datas, $tambahan);

			$update=$this->general_model->update('po_detail', $datas, array('id_po_detail'=>$id_po_detail[$i]));

			if($this->cek_po_detail($id_po_detail[$i])){
				$datas=array_merge($datas, array('po_master_id'=>$id_po));
				$this->general_model->insert('po_detail', $datas);
			}

			if($update!=0 && $id_pr!=NULL)
			{
				$this->update_qty_tot($id_pr[$i], $id_po_detail[$i]); //pdate qty_tot di table pr_material_detail
			}
		}

		echo json_encode(array('status'=>true));

	}

	public function cek_po_detail($id){
		$status=false;

		$sql="select * from po_detail where id_po_detail='$id'";

		$res=$this->general_model->select($sql);

		if(count($res)==0){
			$status=true;
		}

		return $status;
	}

	public function get_last_hgs($name, $hgs)
	{
		$sql="select pd.jumlah/pd.qty_po as 'last_hgs' from po_detail pd
				join po_master pm on pm.id_po_master=pd.po_master_id where nama_pasar like '%$name%' and pm.date_create >= DATE(NOW() - INTERVAL 3 MONTH)
				order by pd.jumlah/pd.qty_po ASC limit 1";
		$res=$this->general_model->select_row($sql);

		// var_dump($sql);
		// exit;

		if(count($res)>0){
			return $res['last_hgs'];
		}
		else{
			return $hgs;
		}
	}

	//eof save detail po

	public function update_qty_tot($id_pr, $id_po_detail)
	{
		$colom='qty_tot_buy';
		$qty="SELECT sum(qty_buy) as 'qty_req' FROM `po_detail` WHERE `pr_id` = '$id_pr'";
		$res=$this->general_model->select_row($qty);
		// var_dump($res);
		// exit;
		$qty_req=floatval($res['qty_req']);
		// foreach ($res as $key) {
		// 	$qty_req+=floatval($key['qty_po'])
		// }

		$sql="UPDATE pr_material_detail set $colom=$qty_req where id_pr=$id_pr";
		$update_qty=$this->db->query($sql);
	}

	public function get_po_by_id($id_po_detail)
	{
		$sql="SELECT merek, stn_po, qty_buy, qty_po, hgs, disc, jumlah FROM `po_detail` WHERE id_po_detail='$id_po_detail'";
		$res=$this->general_model->select_row($sql);
		$data=array();
		foreach ($res as $key => $value) {
			array_push($data, $value);
			// echo $value;
		}

		echo json_encode(array('input'=>$data));

	}

	public function save_po_master_ex()
	{
		// $this->save_po_detail_ex();

		$id_import=null;

		$id_po=$this->input->post('id_po');
		$id_import=$this->input->post('import');

		$colom_master=array('code_supplier', 'date_po', 'id_alamat', 'cur_id', 'date_sent', 'reference', 'include_price', 'etd', 'eta', 'requ', 'remarks_po');
		$colom_import=array('reference', 'include_price', 'etd', 'eta', 'requ', 'remarks_po');
		$this->validate_po();
		$nom=array('ppn', 'pph', 'total', 'total_bt');

		// if($import==1){
		// 		$data_import=array();
		//
		// 		for ($i=0; $i < count($colom_import); $i++) {
		// 			$dump=array($colom_import[$i]=>$this->input->post($colom_import[$i]));
		// 			$data_import=array_merge($data_import, $dump);
		// 		}
		//
		// 		//insert to db
		// 		$id_import=$this->general_model->insert('po_import', $data_import);
		// }


		$data_master=array();

		for ($i=0; $i < count($colom_master); $i++) {
			$dump=array($colom_master[$i]=>$this->input->post($colom_master[$i]));
			$data_master=array_merge($data_master, $dump);
		}

		for ($i=0; $i < count($nom); $i++) {
			$dump=array($nom[$i]=>str_replace(',','',$this->input->post($nom[$i])));
			$data_master=array_merge($data_master, $dump);
		}

		$tambahan=array('import_id'=>$id_import);
		$data_master=array_merge($data_master, $tambahan);

		if($this->input->post('po_no')!=null){
			$tambahan1=array('po_no'=>$this->input->post('po_no'));
			$data_master=array_merge($data_master, $tambahan1);
		}

		$id_master=$this->general_model->update('po_master', $data_master, array('id_po_master'=>$id_po));
		echo json_encode(array('status'=>true, 'id_import'=>$id_import, 'master_id'=>$id_master ));
	}


	public function sent_po()
	{
		$this->validate_po();
		$id_po=$this->input->post('id_po');

		$status_total=$this->cek_over($id_po);
		// echo $status_total;
		// exit;

		if($status_total=='ob'){
			$id_master=$this->general_model->update('po_master', array('status_po'=>'sent', 'status_ob'=>'open'), array('id_po_master'=>$id_po));
		}
		elseif ($status_total=='op') {
			$id_master=$this->general_model->update('po_master', array('status_po'=>'sent', 'status_bod'=>'open'), array('id_po_master'=>$id_po));
		}
		elseif ($status_total=='ob_op') {
			$id_master=$this->general_model->update('po_master', array('status_po'=>'sent', 'status_bod'=>'open', 'status_ob'=>'open'), array('id_po_master'=>$id_po));
		}
		else{
			$id_master=$this->general_model->update('po_master', array('status_po'=>'sent', 'status_bod'=>'', 'status_ob'=>''), array('id_po_master'=>$id_po));
		}
		echo json_encode(array('status'=>true, 'master_id'=>$id_master));
	}

	public function cek_over($id_po)
	{
		$sql="SELECT * FROM `po_detail` pd
		left join pr_material_detail pm on pm.id_pr=pd.pr_id
		left join dkp_material dm on dm.id_material=pm.material_id
		WHERE `po_master_id` = '$id_po'";
		$result=$this->general_model->select($sql);

		//get parameter max
		$sql="SELECT * FROM `po_parameter`";
		$res=$this->general_model->select_db2($sql);

		$sum=0;
		$status=TRUE; //status bod
		$status_ob=TRUE;
		$status_kenaikan=TRUE;

		foreach ($result as $key) {

			//jika lebih dari parameter
			if((floatval($key['jumlah'])/floatval($key['qty_po']))>floatval($res[0]['item_max'])){
				$status=FALSE;
			}

			//jika ada kenaikan harga
			if((floatval($key['jumlah'])/floatval($key['qty_po']))>floatval($key['last_hgs'])){
				$status_kenaikan=FALSE;
			}

			//jika lebih dari budget
			if($key['basic_price_budget']!=0 || $key['basic_price_budget']!=NULL){
				if(floatval($key['hgs'])>floatval($key['basic_price_budget'])){
					// $status=FALSE;
					$status_ob=FALSE;
				}
			}

			$sum+=floatval($key['jumlah']);
		}

		//jika lebih dari paramter
		if($sum>floatval($res[0]['total_max'])){
			$status=FALSE;
		}

		if($status_ob==FALSE && $status==TRUE){
			return "ob";
		}
		elseif ($status_ob==FALSE && $status==FALSE) {
			return "ob_op";
		}
		elseif ($status_ob==TRUE && $status==FALSE) {
			return "op";
		}else{
			return "no"; // tidak over budget dan over paramater
		}
	}

	public function get_sum($id_po)
	{
		$sql="SELECT * FROM `po_detail` pd
		left join pr_material_detail pm on pm.id_pr=pd.pr_id
		left join dkp_material dm on dm.id_material=pm.material_id
		WHERE `po_master_id` = '$id_po'";
		$result=$this->general_model->select($sql);

		//get parameter max
		$sql="SELECT * FROM `po_parameter`";
		$res=$this->general_model->select_db2($sql);

		$sum=0;
		$status=TRUE;

		foreach ($result as $key) {

			//jika lebih dari parameter
			if((floatval($key['jumlah'])/floatval($key['qty_po']))>floatval($res[0]['item_max'])){
				$status=FALSE;
			}

			//jika ada kenaikan harga
			if((floatval($key['jumlah'])/floatval($key['qty_po']))>floatval($key['last_hgs'])){
				$status=FALSE;
			}

			//jika lebih dari budget
			if($key['basic_price_budget']!=0 || $key['basic_price_budget']!=NULL){
				if(floatval($key['hgs'])>floatval($key['basic_price_budget'])){
					$status=FALSE;
				}
			}

			$sum+=floatval($key['jumlah']);
		}

		//jika lebih dari paramter
		if($sum>floatval($res[0]['total_max'])){
			$status=FALSE;
		}

		return $status; //return status
	}

	public function cek_total_po($po_id_master){ //return true if need approve bod
		$sql="SELECT * FROM `po_detail` WHERE `po_master_id` = $po_id_master";

		$res=$this->general_model->select($sql);

		$sql="SELECT * FROM `po_parameter`";
		$result=$this->general_model->select_db2($sql);

		$total=0;
		$status_po=FALSE;

		foreach ($res as $key) {
			if(floatval($key['jumlah'])/floatval($key['qty_po'])>floatval($result[0]['item_max'])){
				$status_po=TRUE;
			}
			$total=$total+(floatval($key['jumlah']));
		}

		if($total>floatval($result[0]['total_max'])){
			$status_po=TRUE;
		}
		return $status_po;
	}

	public function save_po_master()
	{
		$id_import=null;

		$id_po=$this->input->post('id_po');
		$import=$this->input->post('import');

		$colom_master=array('code_supplier', 'po_no', 'date_po', 'id_alamat', 'cur_id', 'date_sent', 'ppn', 'total');
		$colom_import=array('reference', 'include_price', 'etd', 'eta', 'teop', 'requ', 'remarks_po');

		$this->validate_po();

		if($import==1){
				$data_import=array();

				for ($i=0; $i < count($colom_import); $i++) {
					$dump=array($colom_import[$i]=>$this->input->post($colom_import[$i]));
					$data_import=array_merge($data_import, $dump);
				}

				//insert to db
				$id_import=$this->general_model->insert('po_import', $data_import);
		}

		$data_master=array();

		for ($i=0; $i < count($colom_master); $i++) {
			$dump=array($colom_master[$i]=>$this->input->post($colom_master[$i]));
			$data_master=array_merge($data_master, $dump);
		}

		$tambahan=array('status_po'=>'sent', 'import_id'=>$id_import);
		$data_master=array_merge($data_master, $tambahan);

		$id_master=$this->general_model->update('po_master', $data_master, array('id_po_master'=>$id_po));

		echo json_encode(array('status'=>true, 'id_import'=>$id_import, 'master_id'=>$id_master));
	}

	private function validate_po()
	{
		$colom_master=array( 'code_supplier', 'date_po', 'id_alamat', 'cur_id', 'date_sent', 'ppn', 'total');

		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		for ($i=0; $i < count($colom_master); $i++) {
			if($this->input->post($colom_master[$i])=='')
			{
				$data['inputerror'][] = $colom_master[$i];
				$data['error_string'][] ="Not Valid !!!!";
				$data['status'] = FALSE;
			}
		}

		if($this->input->post('po_no')!=null){
			if($this->cek_po_no_edit($this->input->post('po_no'), $this->input->post('id_po')))
			{
				$data['inputerror'][] = 'po_no';
				$data['error_string'][] ="Already use !!!";
				$data['status'] = FALSE;
			}
			if($this->input->post('po_no')==''){
				$data['inputerror'][] = 'po_no';
				$data['error_string'][] ="Cannot Empty !!!";
				$data['status'] = FALSE;
			}
		}

			if($data['status'] === FALSE)
			{
					echo json_encode($data);
					exit();
			}
	}

	private function validate_po_other()
	{
		$colom_master=array( 'code_supplier', 'po_no', 'date_po', 'id_alamat', 'cur_id', 'date_sent', 'ppn', 'total');

		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		for ($i=0; $i < count($colom_master); $i++) {
			if($this->input->post($colom_master[$i])=='')
			{
				$data['inputerror'][] = $colom_master[$i];
				$data['error_string'][] ="Not Valid !!!!";
				$data['status'] = FALSE;
			}
		}

		if($this->cek_po_no_edit_other($this->input->post('po_no'), $this->input->post('id_po')))
		{
			$data['inputerror'][] = 'po_no';
			$data['error_string'][] ="Already use !!!";
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
				echo json_encode($data);
				exit();
		}
	}

	private function validate_edit_po()
	{
		$colom_master=array('code_supplier', 'po_no', 'date_po', 'id_alamat', 'cur_id', 'date_sent', 'ppn', 'total');

		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		$data['isi']=array();

		for ($i=0; $i < count($colom_master); $i++) {
			if($this->input->post($colom_master[$i])=='')
			{
				$data['inputerror'][] = $colom_master[$i];
				$data['error_string'][] ="Not Valid !!!!";
				$data['status'] = FALSE;
			}
		}

		if($this->cek_po_no_edit($this->input->post('po_no'), $this->input->post('id_po')))
		{
			$data['inputerror'][] = 'po_no';
			$data['error_string'][] ="Already use !!!";
			$data['isi'][]=$this->input->post('po_no');
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
				echo json_encode($data);
				exit();
		}
	}

	public function cek_po_no_edit($po_no, $id_po){
		$sql="SELECT * FROM `po_master` WHERE `po_no` LIKE '$po_no'";
		$res=$this->general_model->select($sql);
		$sql1="SELECT * FROM `po_master` WHERE `id_po_master` LIKE '$id_po'";
		$res1=$this->general_model->select($sql1);
		// echo count($res);
		if(count($res)>0){
			if($res[0]['po_no']==$res1[0]['po_no']){
				// echo 'false';

				return FALSE;
			}
			else{
				// echo 'true';

				return TRUE;
			}
		}else {
			// echo 'false';

			return FALSE;
		}
	}

	public function cek_po_no_edit_other($po_no, $id_po){
		$sql="SELECT * FROM `po_master` WHERE `po_no` LIKE '$po_no'";
		$res=$this->general_model->select($sql);
		$sql1="SELECT * FROM `po_master` WHERE `id_po_master` LIKE '$id_po'";
		$res1=$this->general_model->select($sql1);
		// echo count($res);
		if(count($res)>0){ //jika ada di db
			if(count($res1)>0){ //jika ada di db untuk id
					if($res[0]['po_no']==$res1[0]['po_no']){ //jika sama dengan sebelumnya
						return FALSE;
					}
					else{ //jika ngak sama dengan sebelumnya
						return TRUE;
					}
			}else{ //jika tidak ada
				return TRUE;
			}
		}else { // tidak ada di db
			return FALSE;
		}
	}

	private function cek_po_no($po_no, $id_po){
		$sql="SELECT * FROM `po_master` WHERE `po_no` LIKE '$po_no'";
		$res=$this->general_model->select($sql);
		// echo count($res)
		if(count($res)>0){
			$sql_="SELECT * FROM `po_master` WHERE `po_no` LIKE '$po_no' and 'id_po_masterI'=$id_po";
			$result=$this->general_model->select($sql_);

			if(count($result)>0){
				return FALSE;
			}
			else {
				return TRUE;
			}

		}else {
			return FALSE;
		}
	}

	/*
	*
	* =========================================================================================
	* list po approval
	*============================================================================================
	*
	*/

	public function list_po_approval()
	{
		$this->load->view('po/list_po_approval');
	}

	// public function get_sum($id_po)
	// {
	//   $sql="SELECT * FROM `po_detail` WHERE `po_master_id` = '$id_po'";
	//   $result=$this->general_model->select($sql);
	//
	// 	$sql="SELECT * FROM `po_parameter`";
	// 	$res=$this->general_model->select_db2($sql);
	//
	//   $sum=0;
	//   $status=TRUE;
	//
	//   foreach ($result as $key) {
	//     if((floatval($key['jumlah'])/floatval($key['qty_po']))>floatval($res[0]['item_max'])){
	//       $status=FALSE;
	//     }
	//     $sum+=floatval($key['jumlah']);
	//   }
	//
	//   if($sum>floatval($res[0]['total_max'])){
	//     $status=FALSE;
	//   }
	//
	//   return $status;
	// }

	// po approval approval po
	public function get_po_approval()
	{
	  $sql="SELECT * FROM db_demo_pms.po_master pm
		join db_pembelian.po_supplier ps on ps.supplier_code=pm.code_supplier
		where pm.status_po='sent' or pm.status_po='cancel' ";

	  $result=$this->general_model->select($sql);

	  $table=array();

	  foreach ($result as $key ) {
			// if($_SESSION['level']=='bod'){
			// 	if(!$this->get_sum($key['id_po_master']) && $key['status_po']=='sent'){
			// 		$stat_icon='<span class="label label-sm label-success">Sent</span>';
			// 		$button1='<a class="btn btn-sm btn-success" title="Cancel" onclick="approve_bod('.$key['id_po_master'].')"><i class="glyphicon glyphicon-pencil"></i> Approve</a>';
			// 		$button='';
			// 	}else{
			// 		$button='';
			// 		$button1='';
			// 		$stat_icon='<span class="label label-sm label-success">'.$key['status_po'].'</span>';
			// 	}
			// }else{

	    if($key['status_po']=='sent'){
	      $stat_icon='<span class="label label-sm label-success">Sent</span>';
	      $button='<a class="btn btn-sm btn-warning" title="Cancel" onclick="cancel('.$key['id_po_master'].')"><i class="glyphicon glyphicon-stop"></i> Cancel</a>';
				if($key['id_pr']==!NULL){
					$button_edit='<a class="btn btn-sm btn-warning" title="Cancel" href="'.site_url().'po/edit_po/'.$key['id_po_master'].'/'.$key['status_po'].'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';
				}else {
					$button_edit='<a class="btn btn-sm btn-warning" title="Cancel" href="'.site_url().'po/edit_po_other/'.$key['id_po_master'].'/'.$key['status_po'].'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';
				}
	      if($_SESSION['level']=='kabag')
	      {
					$button1='<a class="btn btn-sm btn-success" title="Cancel" onclick="approve('.$key['id_po_master'].')"><i class="glyphicon glyphicon-pencil"></i> Approve</a>';

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

		// }

	    array_push($table, array(
	      '<a class="'.$this->get_class($key['id_po_master']).'" onclick="show_po('.$key['id_po_master'].')">'.$key['po_no'].'</a>',
	      $key['date_po'],
	      $key['date_sent'],
	      $key['supplier_name'],
	      $this->get_alamat($key['id_alamat']),
	      $stat_icon,
	      $key['ppn'],
	      $key['cur_id'].' '.number_format($key['total'],2,",","."),
	      $button.' '.$button_edit.' '.$button1
	    ));
	  }

		// $table=array_merge($table, $this->get_po_other_approval());
	  echo json_encode(array('data'=>$table));
	}

	// po approval approval po
	public function get_po_other_approval()
	{
	  $sql="SELECT * FROM po_master_other pm
		join db_pembelian.po_supplier ps on ps.supplier_code=pm.code_supplier
		where pm.status_po='sent' or pm.status_po='cancel' ";

	  $result=$this->general_model->select($sql);

	  $table=array();

	  foreach ($result as $key ) {
	    if($key['status_po']=='sent'){
	      $stat_icon='<span class="label label-sm label-success">Sent</span>';
	      $button='<a class="btn btn-sm btn-warning" title="Cancel" onclick="cancel('.$key['id_po_master'].')"><i class="glyphicon glyphicon-stop"></i> Cancel</a>
	      <a class="btn btn-sm btn-warning" title="Cancel" href="'.site_url().'po/edit_po_other/'.$key['id_po_master'].'/'.$key['status_po'].'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';
	      if($_SESSION['level']=='kabag')
	      {
					$button1='<a class="btn btn-sm btn-success" title="Cancel" onclick="approve('.$key['id_po_master'].')"><i class="glyphicon glyphicon-pencil"></i> Approve</a>';

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

		// }

	    array_push($table, array(
	      '<a class="'.$this->get_class($key['id_po_master']).'" onclick="show_po_other('.$key['id_po_master'].')">'.$key['po_no'].'</a>',
	      $key['date_po'],
	      $key['date_sent'],
	      $key['supplier_name'],
	      $this->get_alamat($key['id_alamat']),
	      $stat_icon,
	      $key['ppn'],
	      $key['cur_id'].' '.number_format($key['total'],2,",","."),
	      $button.' '.$button1
	    ));
	  }
		return $table;
	}

	public function get_class($id_po)
	{
		$sql_table="SELECT dm.basic_price_budget, pmd.qty_angka, pmd.qty_tot_buy, dm.nama_bahan, stn_po, hgs, last_hgs, disc FROM po_detail pd
			join po_master pm on pm.id_po_master=pd.po_master_id
			join pr_material_detail pmd on pmd.id_pr=pd.pr_id
			join dkp_material dm on dm.id_material=pmd.material_id
			where pd.po_master_id= $id_po";
		$res_tab=$this->general_model->select($sql_table);

		foreach ($res_tab as $key) {
			// if(floatval($key['hgs'])>floatval($key['basic_price_budget'])){
			// 	$class="over_po";
			// 	return $class;
			// 	exit;
			// }

			if(floatval($key['last_hgs'])<floatval($key['hgs'])){
				$class="expensive_po";
				return $class;
				exit;
			}
		}

		return '';
	}

	public function get_po_approval_bod()
	{
		$sql="SELECT * FROM `po_master` where status_po='approved' and status_bod!='approved'";

		$result=$this->general_model->select($sql);

		$table=array();

		foreach ($result as $key) {
				if(!$this->get_sum($key['id_po_master'])){
					array_push($table, array(
						'<a onclick="show_po('.$key['id_po_master'].')">'.$key['po_no'].'</a>',
						$key['date_po'],
						$key['date_sent'],
						$key['code_supplier'],
						$this->get_alamat($key['id_alamat']),
						'<span class="label label-sm label-success">'.$key['status_bod'].'</span>',
						$key['ppn'],
						$key['cur_id'].' '.number_format($key['total'],2,",","."),
						'<a class="btn btn-sm btn-success" title="Cancel" onclick="approve_bod('.$key['id_po_master'].')"><i class="glyphicon glyphicon-pencil"></i> Approve</a>'
					));
				}
		}

		echo json_encode(array('data'=>$table));
	}

	public function cancel_po($id)
	{
		$update=$this->general_model->update('po_master', array('status_po'=>'cancel', 'approve_by'=>$_SESSION['nik'], 'approve_date'=>date('Y-m-d')), array('id_po_master'=>$id));

		// $sql="SELECT * from pr_material_detail` where pr_no like '$id'";
		$sql="SELECT * FROM `po_detail` WHERE po_master_id='$id'";
		$result=$this->general_model->select($sql);
		// var_dump($result);
		// exit;
		$id_updated=array();

		foreach ($result as $key) {
			$id_up=$this->update_qty($key['pr_id'], floatval($key['qty_buy']), 'qty_tot_buy');
			array_push($id_updated, $id_up);
		}
		echo json_encode(array('status'=>true, 'id'=>$update, 'id_updated'=>$id_updated));
	}

	private function update_qty($id_pr, $qty_req, $colom)
	{
		$sql="UPDATE pr_material_detail set $colom=$colom-$qty_req where id_pr=$id_pr";
		$update=$this->db->query($sql);
		return $update;
	}

	public function approve_po($id)
	{
		$update=$this->general_model->update('po_master', array('status_po'=>'approved', 'approve_by'=>$_SESSION['nik'], 'approve_date'=>date('Y-m-d')), array('id_po_master'=>$id));
		echo json_encode(array('status'=>true, 'id'=>$update));
	}

	public function approve_po_bod($id)
	{
		$sql="select * from po_master where id_po_master=$id";
		$result=$this->general_model->select_row($sql);
		if($result['status_ob']==='open' && $result['status_bod']==='open'){
			$update=$this->general_model->update('po_master', array('status_bod'=>'approved', 'status_ob'=>'approved', 'approve_bod'=>$_SESSION['nik'], 'date_bod'=>date('Y-m-d'), 'approve_ob'=>$_SESSION['nik'], 'date_ob'=>date('Y-m-d')), array('id_po_master'=>$id));
		}
		elseif ($result['status_ob']==='open'&&$result['status_bod']==='') {
			$update=$this->general_model->update('po_master', array('status_ob'=>'approved', 'approve_ob'=>$_SESSION['nik'], 'date_ob'=>date('Y-m-d')), array('id_po_master'=>$id));
		}else{
			$update=$this->general_model->update('po_master', array('status_bod'=>'approved', 'approve_bod'=>$_SESSION['nik'], 'date_bod'=>date('Y-m-d')), array('id_po_master'=>$id));
		}
		echo json_encode(array('status'=>true, 'id'=>$update));
	}

	/*
	*
	* =========================================================================================
	* list po approved
	*============================================================================================
	*
	*/

	//list approved
	public function list_po_approved()
	{
		$this->load->view('po/list_po_approved');
	}

	public function open_print($id)
	{
		$update=$this->general_model->update('po_master', array('print_status'=>'open', 'status_po'=>'draf', 'status_ob'=>'', 'status_bod'=>'open'), array('id_po_master'=>$id));
		echo json_encode(array('status'=>true, 'id'=>$update));
	}

	public function get_po_approved()
	{
		$sql="SELECT * FROM db_demo_pms.po_master pm
		join db_pembelian.po_supplier ps on ps.supplier_code=pm.code_supplier
		where pm.status_po='approved'";

		$result=$this->general_model->select($sql);

		$table=array();
		$status='';
		$button='';
		// var_dump($result);
		// exit;
		foreach ($result as $key ) {
			if($key['print_status']=='open'){
				if(($key['status_bod']=='approved' || $key['status_bod']=='')&&($key['status_ob']=='approved' || $key['status_ob']=='')){
					$button='<a class="btn btn-sm btn-success" title="print" href="'.base_url().'po/print_po/'.$key['id_po_master'].'"><i class="glyphicon glyphicon-print"></i> Print</a>';
					$status='<span class="label label-sm label-success">Approved</span>';
				}
				elseif ($key['status_bod']=='open' && $key['status_ob']=='open') {
					if($_SESSION['level']=='kabag'){
						$status='<span class="label label-sm label-success">Over Budget & Over Price / Reprint, Waiting approve by GM&BOD</span>';
						$button='<a class="btn btn-sm btn-warning" title="Cancel" onclick="open_print('.$key['id_po_master'].')"><i class="glyphicon glyphicon-pencil"></i> UnApprove</a>';
					}else{
						$button='';
						$status='<span class="label label-sm label-success">Over Budget & Over Price / Reprint, Waiting approve by GM&BOD</span>';
					}
				}elseif ($key['status_bod']=='' && $key['status_ob']=='open') {
					if($_SESSION['level']=='kabag'){
						$status='<span class="label label-sm label-success">Over Budget Waiting approve by GM/BOD</span>';
						$button='<a class="btn btn-sm btn-warning" title="Cancel" onclick="open_print('.$key['id_po_master'].')"><i class="glyphicon glyphicon-pencil"></i> UnApprove</a>';
					}else{
						$button='';
						$status='<span class="label label-sm label-success">Over Budget Waiting approve by GM/BOD</span>';
					}
				}
				elseif ($key['status_bod']=='open' && $key['status_ob']=='') {
					if($_SESSION['level']=='kabag'){
						$status='<span class="label label-sm label-success">Over Price Waiting approve by BOD</span>';
						$button='<a class="btn btn-sm btn-warning" title="Cancel" onclick="open_print('.$key['id_po_master'].')"><i class="glyphicon glyphicon-pencil"></i> UnApprove</a>';
					}else{
						$button='';
						$status='<span class="label label-sm label-success">Over Price Waiting approve by BOD</span>';
					}
				}
			}
			else{
				if($_SESSION['level']=='kabag'){
					$button='<a class="btn btn-sm btn-warning" title="Cancel" onclick="open_print('.$key['id_po_master'].')"><i class="glyphicon glyphicon-pencil"></i> UnApprove</a>';
					$status='<span class="label label-sm label-success"> Revisi '.(intval($key['print_count'])-1).'</span>';
				}
				else{
					$button='';
					$status='<span class="label label-sm label-success"> Revisi '.(intval($key['print_count'])-1).'</span>';
				}
			}

			array_push($table, array(
				'<a onclick="show_po('.$key['id_po_master'].')">'.$key['po_no'].'</a>',
				$key['date_po'],
				$key['date_sent'],
				$key['supplier_name'],
				$this->get_alamat($key['id_alamat']),
				$status,
				$key['ppn'],
				$key['cur_id'].' '.number_format($key['total'],2,",","."),
				$key['approve_by'],
				$key['approve_date'],
				$key['comment'],
				$button,

			));
		}

		echo json_encode(array('data'=>$table));
	}

	public function get_alamat($id){
		$sql="SELECT * FROM `po_address` WHERE id_address='$id'";
		$res=$this->general_model->select_db2($sql);
		return $res[0]['address'];
	}

	/*
	*
	* =========================================================================================
	* list po draf
	*============================================================================================
	*
	*/

	public function list_po_draf()
	{
		$this->load->view('po/list_po_draf');
	}

	public function get_po_draf()
	{
		$sql="SELECT * FROM `po_master` where status_po='draf' ";

		$result=$this->general_model->select($sql);

		$table=array();

		foreach ($result as $key ) {

			// if($key['print_count']==0){
				$button='<a class="btn btn-sm btn-warning" title="edit" href="'.site_url().'po/edit_po/'.$key['id_po_master'].'/'.$key['status_po'].'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';
			// }
			// else{
			// 	$button='';
			// }

			if($key['id_alamat']=='0'){
				$address_='';
			}else{
				$address_=$this->get_alamat($key['id_alamat']);
			}

			array_push($table, array(
				$key['id_po_master'],
				'<a onclick="show_pr('.$key['id_po_master'].')">'.$key['po_no'].'</a>',
				$key['date_po'],
				$key['date_sent'],
				$key['code_supplier'],
				$address_,
				'<span class="label label-sm label-success">'.$key['status_po'].'</span>',
				$key['ppn'],
				$key['cur_id'].' '.number_format($key['total'],2,",","."),
				$button
			));
		}

		echo json_encode(array('data'=>$table));
	}

	/*
	*
	* =========================================================================================
	* edit po
	*============================================================================================
	*
	*/

	public function edit($id_po){
		$data['id_po']=$id_po;
		$data['currency']=$this->get_currency();
		$data['supplier']=$this->get_supplier();
		$data['address']=$this->get_address();
		$this->load->view('po/edit_po', $data);
	}

	public function edit_po($id_po, $status)
	{
		$data['id_po']=$id_po;
		$data['status']=$status;
		$data['currency']=$this->get_currency();
		$data['supplier']=$this->get_supplier();
		$data['address']=$this->get_address();
		$this->load->view('po/edit_po_new', $data);
	}

	public function edit_po_other($id_po, $status)
	{
		$data['id_po']=$id_po;
		$data['status']=$status;
		$data['currency']=$this->get_currency();
		$data['supplier']=$this->get_supplier();
		$data['address']=$this->get_address();
		$this->load->view('po/edit_po_other', $data);
	}

	public function get_detail_master($id_po_master)
	{
		$sql="SELECT * FROM po_master WHERE id_po_master = $id_po_master";
		$r=$this->general_model->select_row($sql);
		// var_dump($r);
		$sql_supp="SELECT supplier_code, supplier_name, contact_name, telp, fax FROM `po_supplier` where supplier_code='".$r['code_supplier']."'";
		$supplier=$this->general_model->select_db2($sql_supp);

		$general_info=array($r['po_no'], $r['date_po'], $r['ppn'], $r['total'], $r['date_sent'], $r['import_id'], $r['etd'], $r['eta'], $r['remarks_po'], $r['include_price'], $r['reference'], $r['requ']);
		$select=array($r['code_supplier'], $r['id_alamat'], $r['cur_id']);
		// $data_import=array($r['reference'], $r['include_price'], $r['etd'], $r['eta'], $r['teop'], $r['requ'], $r['remarks_po']);
		$data_import=$r['import_id'];

		//get list files
		$dir='/backupdisk/pms/uploads/po/'.$id_po_master;
		if(is_dir($dir)){
			$files=scandir($dir);
		}else{
			$files=array();
		}
		$list_file=array();

		if(count($files)>2){
			for ($i=2; $i < count($files) ; $i++) {
				array_push($list_file, array(
					$files[$i],
					'/backupdisk/pms/uploads/po/'.$id_po_master.'/'.$files[$i]
				));
			}
		}

		echo json_encode(array('gi'=>$general_info, 'sd'=>$select, 'di'=>$data_import, 'supp'=>$supplier, 'top'=>$this->get_top($id_po_master), 'files'=>$list_file));
	}

	public function view_po($id_po_master)
{
	$sql_table="SELECT nama_pasar, sum(qty_buy) as 'tot_qty_buy',dm.satuan, sum(qty_po) as 'tot_qty_po', pm.cur_id,  stn_po, hgs, last_hgs, disc, sum(jumlah) as 'jumlah' FROM po_detail pd
		left join po_master pm on pm.id_po_master=pd.po_master_id
		left join pr_material_detail pmd on pmd.id_pr=pd.pr_id
		left join dkp_material dm on dm.id_material=pmd.material_id
		where pd.po_master_id= $id_po_master
		GROUP by dm.nama_bahan";
	$res_tab=$this->general_model->select($sql_table);

	$table=array();
	$no=1;
	$tot_harga=0;
	foreach ($res_tab as $key) {

		if(floatval($key['hgs']) > floatval($key['last_hgs'])){
			$class="expensive_po";
		}else{
			$class="";
		}
		array_push($table, array(
			$no.'<input type="hidden" class="'.$class.'">',
			$key['nama_pasar'],
			$key['tot_qty_buy'],
			$key['satuan'],
			$key['tot_qty_po'],
			$key['stn_po'],
			$key['cur_id'].' '.number_format($key['hgs'],2,",","."),
			$key['cur_id'].' '.number_format($key['last_hgs'],2,",","."),
			$key['disc'],
			$key['cur_id'].' '.number_format($key['jumlah'],2,",",".")
		));
		$no+=1;
		$tot_harga+=floatval($key['jumlah']);
	}

	$sql_master="SELECT * FROM po_master pm left join po_import pi on pi.id_import=pm.import_id where id_po_master=$id_po_master";

	$res_master=$this->general_model->select_row($sql_master);

	$data_supp=$this->get_supplier_by_id($res_master['code_supplier']);

	$data_alamat=$this->get_alamat($res_master['id_alamat']);

	//get top
	$top=array();
	//cek cod type
	$sql_cod="SELECT * FROM `po_top` WHERE `po_id` = '$id_po_master'";
	$cod=$this->general_model->select($sql_cod);
	if(count($cod)>0){
		if($cod[0]['type_top']=='cod'){
			array_push($top, 'COD');
		}else {
			$type='Credit';
			array_push($top, $type);
		}
	}
	//cek pp
	$sql_pp="SELECT * FROM `po_dp` WHERE `po_id` = '$id_po_master'";
	$pp=$this->general_model->select($sql_pp);
	if(count($pp)>0){
		array_push($top, 'Progress Payment');
	}
	//cek BUM
	$sql_bum="SELECT * FROM `po_bum` WHERE `po_id` = '$id_po_master'";
	$bum=$this->general_model->select($sql_bum);
	if(count($bum)>0){
		array_push($top, 'CIA-BUM');
	}

	$top_implode=implode('&', $top);

	//get list files
	$dir='/backupdisk/pms/uploads/po/'.$id_po_master;
	if(is_dir($dir)){
		$files=scandir($dir);
	}else{
		$files=array();
	}
	$list_file=array();

	if(count($files)>2){
		for ($i=2; $i < count($files) ; $i++) {
			array_push($list_file, array(
				$files[$i],
				'/backupdisk/pms/uploads/po/'.$id_po_master.'/'.$files[$i]
			));
		}
	}

	echo json_encode(array('tot_harga'=>$tot_harga, 'table'=>$table, 'master'=>$res_master, 'supplier'=>$data_supp, 'alamat'=>$data_alamat, 'top'=>$top_implode, 'list_file'=>$list_file));

}

public function view_po_other($id_po_master)
{
$sql_table="SELECT pd.nama_barang, sum(qty_buy) as 'tot_qty_buy',dm.satuan, sum(qty_po) as 'tot_qty_po', pm.cur_id,  stn_po, hgs, last_hgs, disc, sum(jumlah) as 'jumlah' FROM po_detail_other pd
	join po_master_other pm on pm.id_po_master=pd.po_master_id
	left join pr_material_detail pmd on pmd.id_pr=pd.pr_id
	left join dkp_material dm on dm.id_material=pmd.material_id
	where pd.po_master_id= $id_po_master
	GROUP by dm.nama_bahan";
$res_tab=$this->general_model->select($sql_table);

$table=array();
$no=1;
$tot_harga=0;
foreach ($res_tab as $key) {

	if(floatval($key['hgs']) > floatval($key['last_hgs'])){
		$class="expensive_po";
	}else{
		$class="";
	}
	array_push($table, array(
		$no.'<input type="hidden" class="'.$class.'">',
		$key['nama_barang'],
		$key['tot_qty_buy'],
		$key['satuan'],
		$key['tot_qty_po'],
		$key['stn_po'],
		$key['cur_id'].' '.number_format($key['hgs'],2,",","."),
		$key['cur_id'].' '.number_format($key['last_hgs'],2,",","."),
		$key['disc'],
		$key['cur_id'].' '.number_format($key['jumlah'],2,",",".")
	));
	$no+=1;
	$tot_harga+=floatval($key['jumlah']);
}

$sql_master="SELECT * FROM po_master_other pm left join po_import pi on pi.id_import=pm.import_id where id_po_master=$id_po_master";

$res_master=$this->general_model->select_row($sql_master);

$data_supp=$this->get_supplier_by_id($res_master['code_supplier']);

$data_alamat=$this->get_alamat($res_master['id_alamat']);

echo json_encode(array('tot_harga'=>$tot_harga, 'table'=>$table, 'master'=>$res_master, 'supplier'=>$data_supp, 'alamat'=>$data_alamat));

}

public function view_po_print($id_po_master)
{
	$sql_table="SELECT dm.nama_bahan, sum(qty_buy) as 'tot_qty_buy',dm.satuan, sum(qty_po) as 'tot_qty_po', stn_po, hgs, disc, sum(jumlah) as 'jumlah' FROM po_detail pd
		join po_master pm on pm.id_po_master=pd.po_master_id
		join pr_material_detail pmd on pmd.id_pr=pd.pr_id
		join dkp_material dm on dm.id_material=pmd.material_id
		where pd.po_master_id= $id_po_master
		GROUP by dm.nama_bahan";
	$res_tab=$this->general_model->select($sql_table);

	$table=array();
	$no=1;
	$tot_harga=0;
	foreach ($res_tab as $key) {
		array_push($table, array(
			$no,
			$key['nama_bahan'],
			$key['tot_qty_buy'],
			$key['satuan'],
			$key['tot_qty_po'],
			$key['stn_po'],
			$key['hgs'],
			$key['disc'],
			$key['jumlah']
		));
		$no+=1;
		$tot_harga+=floatval($key['jumlah']);
	}

	//get data master PO
	$sql_master="SELECT * FROM po_master pm left join po_import pi on pi.id_import=pm.import_id where id_po_master=$id_po_master";
	$res_master=$this->general_model->select_row($sql_master);
	//get suplier data
	$data_supp=$this->get_supplier_by_id($res_master['code_supplier']);
	//get alamat
	$data_alamat=$this->get_alamat($res_master['id_alamat']);
	//get top
	$top=array();
	//cek cod type
	$sql_cod="SELECT * FROM `po_top` WHERE `po_id` = '$id_po_master'";
	$cod=$this->general_model->select($sql_cod);
	if(count($cod)>0){
		if($cod[0]['type_top']=='cod'){
			array_push($top, 'COD');
		}else {
			$type='Credit --> '.$cod[0]['type_top'];
			array_push($top, $type);
		}
	}
	//cek pp
	$sql_pp="SELECT * FROM `po_dp` WHERE `po_id` = '$id_po_master'";
	$pp=$this->general_model->select($sql_pp);
	if(count($pp)>0){
		array_push($top, 'Progress Payment');
	}
	//cek BUM
	$sql_bum="SELECT * FROM `po_bum` WHERE `po_id` = '$id_po_master'";
	$bum=$this->general_model->select($sql);
	if(count($bum)>0){
		array_push($top, 'CIA-BUM');
	}

	$top_implode=implode('&', $top);
	echo json_encode(array('tot_harga'=>$tot_harga, 'table'=>$table, 'master'=>$res_master, 'supplier'=>$data_supp, 'alamat'=>$data_alamat, 'top'=>$top_implode));

}

public function get_supplier_by_id($supplier_code)
{
	$sql="SELECT supplier_code, supplier_name, contact_name, telp, fax FROM `po_supplier` where supplier_code='$supplier_code'";
	$res=$this->general_model->select_db2($sql);

	return $res[0];
}

public function print_po($id_po_master)
{
	$data['id_po_master']=$id_po_master;
	$sql="SELECT * FROM `po_master` WHERE `id_po_master` = $id_po_master";
	$res=$this->general_model->select_row($sql);
	if($res['print_status']=='open'){
	$this->load->view('po/print_po', $data);
	$qu="UPDATE po_master set print_count=print_count+1, print_status='close'  where id_po_master=$id_po_master";
	$this->db->query($qu);
	// $this->general_model->update('po_master', array('print_count'=>1), array('id_po_master'=>$id_po_master));
	}
	else{
		echo "You Cannot print this Page !!!!!!!!";
	}
}


	public function get_top($id_po_master){
		// $sql="SELECT pd.detail as 'detail_dp', pd.nominal as 'nominal_dp', pt.detail as 'detail_termin', pt.nominal as 'nominal_termin', pp.detail as 'detail_pelunasan', pp.nominal as 'nominal_pelunasan' FROM po_dp pd
		// 			left join po_termin pt on pt.po_master_id=pd.po_master_id
		// 			left join po_pelunasan pp on pp.po_master_id=pd.po_master_id
		//  			WHERE pd.po_master_id = $id_po_master";
		// $res=$this->general_model->select($sql);
		$sql_dp="SELECT * FROM `po_dp` WHERE po_id=$id_po_master";
		$res=$this->general_model->select($sql_dp);

		$sql_t="SELECT * FROM `po_top` WHERE po_id=$id_po_master";
		$res_t=$this->general_model->select($sql_t);

		$sql_p="SELECT * FROM `po_bum` WHERE po_id=$id_po_master";
		$res_p=$this->general_model->select($sql_p);

		$data=array();
		//pp
		if(count($res)>0){
			foreach ($res as $key ) {
				array_push($data, array(
					$key['id_dp'],
					$key['type_pp'],
					$key['description'],
					$key['nominal_dp'],
					$key['time']
				));
			}
		}

		//COD
		if(count($res_t)>0){
			foreach ($res_t as $key ) {
				array_push($data, array(
					$key['id_top'],
					strtoupper($key['type_top']),
					$key['description'],
					number_format($key['nominal']),
					$key['time']
				));
			}
		}

		//BUM
		if(count($res_p)>0){
			foreach ($res_p as $key ) {
				array_push($data, array(
					$key['id_bum'],
					'CIA-BUM',
					$key['description'],
					$key['nominal_bum'],
					$key['lama_hari']
				));
			}
		}

		return $data;
	}

	public function get_top_table($id_po_master){
		// $sql="SELECT pm.*, pd.id_dp,  pd.detail as 'detail_dp', pd.nominal as 'nominal_dp', pt.id_termin,  pt.detail as 'detail_termin', pt.nominal as 'nominal_termin', pp.id_pelunasan,  pp.detail as 'detail_pelunasan', pp.nominal as 'nominal_pelunasan' FROM po_dp pd
		// 			join po_termin pt on pt.po_master_id=pd.po_master_id
		// 			join po_pelunasan pp on pp.po_master_id=pd.po_master_id
		// 			join po_master pm on pm.id_po_master=pd.po_master_id
		// 			WHERE pd.po_master_id = $id_po_master";
		// $res=$this->general_model->select_row($sql);
		// // var_dump($res);
		// $data=null;
		// if(count($res)>0){
		// 	$button_dp='<a class="btn btn-sm btn-success" title="DP" onclick="process_dp('.$res['id_dp'].')"><i class="glyphicon glyphicon-pencil"></i> DP </a>';
		// 	$button_termin='<a class="btn btn-sm btn-success" title="Cancel" onclick="edit_po('.$res['id_termin'].','.$id_po_master.')"><i class="glyphicon glyphicon-pencil"></i> Termin </a>';
		// 	$button_pelunasan='<a class="btn btn-sm btn-success" title="Cancel" onclick="edit_po('.$res['id_pelunasan'].','.$id_po_master.')"><i class="glyphicon glyphicon-pencil"></i> Pelunasan</a>';
		// 	$data=array(
		// 		array('<a onclick="show_po('.$res['id_po_master'].')">'.$res['po_no'].'</a>', $res['detail_dp'], $res['nominal_termin'], $res['total_bt'], floatval($res['nominal_dp'])/100*floatval($res['total_bt']),floatval($res['nominal_dp'])/100*floatval($res['total_bt'])*10/100, '','',  $button_dp),
		// 		array('<a onclick="show_po('.$res['id_po_master'].')">'.$res['po_no'].'</a>', $res['detail_termin'], $res['nominal_termin'],$res['total_bt'], floatval($res['nominal_termin'])/100*floatval($res['total_bt']), floatval($res['nominal_termin'])/100*floatval($res['total_bt'])*10/100, '','', $button_termin),
		// 		array('<a onclick="show_po('.$res['id_po_master'].')">'.$res['po_no'].'</a>', $res['detail_pelunasan'], $res['nominal_pelunasan'], $res['total_bt'], floatval($res['nominal_pelunasan'])/100*floatval($res['total_bt']), floatval($res['nominal_pelunasan'])/100*floatval($res['total_bt'])*10/100, '','', $button_pelunasan),
		// 	);
		// }

		$sql_dp="SELECT * FROM po_dp pd join po_master pm on pm.id_po_master=pd.po_master_id WHERE pd.po_master_id=$id_po_master";
		$res=$this->general_model->select($sql_dp);

		$sql_t="SELECT * FROM po_termin pt join po_master pm on pm.id_po_master=pt.po_master_id WHERE pt.po_master_id=$id_po_master";
		$res_t=$this->general_model->select($sql_t);

		$sql_p="SELECT * FROM po_pelunasan pp join po_master pm on pm.id_po_master=pp.po_master_id WHERE pp.po_master_id=$id_po_master";
		$res_p=$this->general_model->select($sql_p);

		$data=array();

		if(count($res)>0){
			foreach ($res as $key ) {
				if(floatval($key['nominal'])/100*$key['total_bt']-floatval($key['dp_ongoing']) > 0){
					$button_dp='<a class="btn btn-sm btn-success" title="DP" onclick="process_dp('.$key['id_dp'].')"><i class="glyphicon glyphicon-pencil"></i> DP </a>';
				}else{
					$button_dp='';
				}

				array_push($data, array(
					'<a onclick="show_po('.$key['id_po_master'].')">'.$key['po_no'].'</a>',
					'DP : '.$key['detail'],
					$key['nominal'],
					$key['total_bt'],
					floatval($key['nominal'])/100*$key['total_bt'],
					floatval($key['nominal'])/100*floatval($key['total_bt'])*10/100,
					$key['time'],
					$key['dp_ongoing'],
					$key['ppn_ongoing'],
					$button_dp
				));
			}
		}

		if(count($res_t)>0){
			foreach ($res_t as $key ) {
				if(floatval($key['nominal'])/100*$key['total_bt']-floatval($key['ongoing']) > 0){
					$button_dp='<a class="btn btn-sm btn-success" title="Termin" onclick="process_termin('.$key['id_termin'].')"><i class="glyphicon glyphicon-pencil"></i> TERMIN </a>';
				}else{
					$button_dp='';
				}
				array_push($data, array(
					'<a onclick="show_po('.$key['id_po_master'].')">'.$key['po_no'].'</a>',
					'Termin : '.$key['detail'],
					$key['nominal'],
					$key['total_bt'],
					floatval($key['nominal'])/100*$key['total_bt'],
					floatval($key['nominal'])/100*floatval($key['total_bt'])*10/100,
					$key['time'],
					$key['ongoing'],
					$key['ppn_ongoing'],
					$button_dp
				));
			}
		}
}

public function save_po_cod()
{
	$col=array('time', 'description');

	$data=array('po_id'=>$this->input->post('id_po_modal'), 'nominal'=>str_replace(',','',$this->input->post('nominal_cod')));

	for ($i=0; $i < count($col); $i++) {
		$dump=array($col[$i]=>$this->input->post($col[$i]));
		$data=array_merge($data,$dump);
	}

	$data=array_merge($data, array('type_top'=>'cod', 'create_by'=>$_SESSION['nik'], 'create_date'=>date('Y-m-d')));

	$insert=$this->general_model->insert('po_top', $data);

	echo json_encode(array('status'=>true, 'id'=>$insert, 'data'=>$data));

}

public function save_po_credit()
{
	$col=array('time', 'nama', 'jabatan','type_top', 'description');

	$data=array('po_id'=>$this->input->post('id_po_modal'), 'nominal'=>str_replace(',','',$this->input->post('nominal_credit')));

	for ($i=0; $i < count($col); $i++) {
		$dump=array($col[$i]=>$this->input->post($col[$i]));
		$data=array_merge($data,$dump);
	}

	$data=array_merge($data, array('create_by'=>$_SESSION['nik'], 'create_date'=>date('Y-m-d')));

	$insert=$this->general_model->insert('po_top', $data);

	echo json_encode(array('status'=>true, 'id'=>$insert, 'data'=>$data));

}

public function delete_top($id)
{
	$this->general_model->delete($id, 'id_top', 'po_top');
	echo json_encode(array('status'=>true));
}

public function save_po_progress()
{
	$col=array('time','type_pp', 'bpb_ack', 'description', 'persentase');

	$data=array('po_id'=>$this->input->post('id_po_modal'), 'nominal'=>str_replace(',','',$this->input->post('nominal')), 'nominal_dp'=>str_replace(',','',$this->input->post('nominal_dp')));

	for ($i=0; $i < count($col); $i++) {
		$dump=array($col[$i]=>$this->input->post($col[$i]));
		$data=array_merge($data,$dump);
	}

	$data=array_merge($data, array('create_by'=>$_SESSION['nik'], 'create_date'=>date('Y-m-d')));

	$insert=$this->general_model->insert('po_dp', $data);

	echo json_encode(array('status'=>true, 'id'=>$insert, 'data'=>$data));

}

public function delete_dp($id)
{
	$this->general_model->delete($id, 'id_dp', 'po_dp');
	echo json_encode(array('status'=>true));
}

public function delete_po_other($id)
{
	$this->general_model->delete($id, 'id_po_detail', 'po_detail');
	echo json_encode(array('status'=>true));
}

public function save_supplier()
{
	$col=array('supplier_code', 'supplier_name', 'contact_name', 'telp', 'fax', 'note');

	$data=array();
	$isi=array();
	for ($i=0; $i <count($col) ; $i++) {
		$dump=array($col[$i]=>$this->input->post($col[$i]));
		$data=array_merge($data, $dump);
		array_push($isi,$this->input->post($col[$i]) );
	}

	$insert=$this->general_model->insert_db2('po_supplier', $data);

	echo json_encode(array('status'=>true, 'data'=>$data, 'isi'=>$isi, 'id'=>$insert));
}

public function save_po_other()
{
	$id_import='no';

	$import=$this->input->post('import');

	$colom_master=array('code_supplier', 'po_no', 'date_po', 'id_alamat', 'cur_id', 'date_sent');
	$colom_import=array('reference', 'include_price', 'etd', 'eta', 'teop', 'requ', 'remarks_po');
	$this->validate_po_other();
	$nom=array('ppn', 'pph', 'total', 'total_bt');

	if($import==1){
			$data_import=array();

			for ($i=0; $i < count($colom_import); $i++) {
				$dump=array($colom_import[$i]=>$this->input->post($colom_import[$i]));
				$data_import=array_merge($data_import, $dump);
			}

			//insert to db
			$id_import=$this->general_model->insert('po_import', $data_import);
	}

	$data_master=array();

	//info master
	for ($i=0; $i < count($colom_master); $i++) {
		$dump=array($colom_master[$i]=>$this->input->post($colom_master[$i]));
		$data_master=array_merge($data_master, $dump);
	}

	//currency
	for ($i=0; $i < count($nom); $i++) {
		$dump=array($nom[$i]=>str_replace(',','',$this->input->post($nom[$i])));
		$data_master=array_merge($data_master, $dump);
	}

	$tambahan=array('import_id'=>$id_import, 'create_by'=>$_SESSION['nik'], 'status_po'=>'sent', 'date_create'=>date('Y-m-d'));
	$data_master=array_merge($data_master, $tambahan);

	//save to po master other
	$id_master=$this->general_model->insert('po_master', $data_master);

	$col=array( 'nama_pasar', 'merek','qty_po', 'stn_po', 'hgs', 'disc', 'jumlah', 'ppn', 'pph');
	$datas=array();
	$id_po_detail=$this->input->post('num_row');

	for ($i=0; $i < count($id_po_detail) ; $i++) {
		for ($j=0; $j < count($col) ; $j++) {
			//save to array
			$dump=array(
				$col[$j]=>$this->input->post($id_po_detail[$i]."_".$col[$j])
			);
			$datas=array_merge($datas, $dump);
		}

		$tambahan=array('po_master_id'=>$id_master, 'status_po_detail'=>'edit', 'last_hgs'=>$this->get_last_hgs($this->input->post($id_po_detail[$i]."_nama_pasar"), $this->input->post($id_po_detail[$i]."_hgs")));
		$datas=array_merge($datas, $tambahan);

		$update=$this->general_model->insert('po_detail', $datas);

	}

	$bum=$this->input->post('type_top'); //bum_id
	$top=$this->input->post('type_top_po_top'); //cod Credit
	$pp=$this->input->post('type_top_po_dp');

	if(count($bum)>0){
		for ($i=0; $i < count($bum) ; $i++) {
			$this->general_model->update('po_bum', array('po_id'=>$id_master), array('id_bum'=>$bum[$i]));
		}
	}

	if(count($pp)>0){
		for ($i=0; $i < count($pp) ; $i++) {
			$this->general_model->update('po_bum', array('po_id'=>$id_master), array('id_bum'=>$pp[$i]));
		}
	}

	if(count($top)>0){
		for ($i=0; $i < count($top) ; $i++) {
			$this->general_model->update('po_top', array('po_id'=>$id_master), array('id_top'=>$top[$i]));
		}
	}


	echo json_encode(array('status'=>true, 'id_import'=>$id_import, 'master_id'=>$id_master ));
}

//upload file on sppr
public function upload_file()
{
	$id_po=$this->input->post('id_po');
	$filesCount = count($_FILES['userfile']['name']);
	for($i = 0; $i < $filesCount; $i++){
			$_FILES['userFile']['name'] = $_FILES['userfile']['name'][$i];
			$_FILES['userFile']['type'] = $_FILES['userfile']['type'][$i];
			$_FILES['userFile']['tmp_name'] = $_FILES['userfile']['tmp_name'][$i];
			$_FILES['userFile']['error'] = $_FILES['userfile']['error'][$i];
			$_FILES['userFile']['size'] = $_FILES['userfile']['size'][$i];

			$uploadPath = '/backupdisk/pms/uploads/po/'.$id_po;
			if (!is_dir($uploadPath)) {
					 mkdir($uploadPath, 0777, TRUE);
			 }
			 $config['upload_path'] = $uploadPath;
			 $config['allowed_types'] = '*';
			 $this->load->library('upload', $config);
			 $this->upload->initialize($config);
			 if ( ! $this->upload->do_upload('userFile'))
			 {
				 echo json_encode('upload failed');
			 }else{
				 echo json_encode('upload succes');
			 }
		 }
} //eof

public function delete_file(){
	if(unlink($this->input->post('link'))){
		echo json_encode(array('status'=>true));
	}else{
		echo json_encode(array('status'=>false));

	}
}

public function download()
{
	$file=$this->input->get('data');

	$new_file=explode('/', $file);
	$file_name=$new_file[count($new_file)-1];
		// Does the file exist?
	if(!is_file($file)){
	    header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
	    header("Status: 404 Not Found");
	    echo 'File not found!';
	    die;
	}

	// Is it readable?
	if(!is_readable($file)){
	    header("{$_SERVER['SERVER_PROTOCOL']} 403 Forbidden");
	    header("Status: 403 Forbidden");
	    echo 'File not accessible!';
	    die;
	}

	// We are good to go!
	header('Content-Description: File Transfer');
	header('Content-Type: application/zip');
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
	header("Content-Type: application/force-download");
	header("Content-Type: application/download");
	// header("Content-Disposition: attachment;filename={$filename}");
	header("Content-Disposition: attachment;filename={$file_name}");
	header("Content-Transfer-Encoding: binary ");
	header('Content-Length: ' . filesize($file));
	while(ob_get_level()) ob_end_clean();
	flush();
	readfile($file);
	die;
}

public function get_po_no($id){
	$prefix='A'.date('y').$id;
	$sql="SELECT * FROM `po_master` WHERE `po_no` LIKE '%$prefix%' order by po_no desc limit 1";
	$res=$this->general_model->select_row($sql);
	if(count($res>0)){
		$curr_no=$res['po_no'];
		$curr_no_new=substr($curr_no, 4, 3);
		$curr_no_new=intval($curr_no_new);
		$po_no_index=$curr_no_new+1;
		$po_no=$prefix.sprintf('%03d', $po_no_index);
		echo json_encode(array('no'=>$po_no));
	}else{
		echo json_encode(array('no'=>$prefix.'001'));
	}
}

} //end of classs
