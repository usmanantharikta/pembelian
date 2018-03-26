<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pr extends CI_Controller {

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

  public function list_pr()
  {
		$sql="SELECT pmd.no_sppr, pmd.pr_no, pmd.id_pr, pmd.material_id as 'id_mat', d.dkp_no, dm.kode_barang, dm.nama_bahan, dm.material_name, dm.date_bth , pmd.qty_angka, pm.status_pr, dm.* FROM pr_material_detail pmd
		join pr_master pm on pm.id_pr_master=pmd.pr_master_id
		join dkp_material dm on dm.id_material=pmd.material_id
		join dkp_master d on d.id_dkp=dm.dkp_id
		where pm.status_pr='approved' and pmd.qty_angka-pmd.qty_tot_buy!=0";

		$result=$this->general_model->select($sql);
		$table=array();

		foreach ($result as $key ) {
			array_push($table, array(
				'<input type="checkbox" name="id_pr[]" class="checkboxes" value="'.$key['id_pr'].'"/>',
				$key['pr_no'],
				$key['dkp_no'],
				$key['kode_barang'],
				$key['nama_bahan'].'<input type="hidden" name="nama_bahan[] value="'.$key['nama_bahan'].'"',
				$key['material_name'],
				$key['date_bth'],
				$key['qty_angka']
			));
		}
		$data['table']=$table;
    $this->load->view('pr/list_pr', $data);
  }

  public function get_list_ots_pr()
  {
    // $sql="SELECT pmd.no_sppr, pmd.pr_no, pmd.id_pr, pmd.material_id as 'id_mat', d.dkp_no, dm.kode_barang, dm.nama_bahan, dm.material_name, dm.date_bth , pmd.qty_angka, pm.status_pr, dm.* FROM pr_material_detail pmd
    // join pr_master pm on pm.id_pr_master=pmd.pr_master_id
    // join dkp_material dm on dm.id_material=pmd.pr_master_id
    // join dkp_master d on d.id_dkp=dm.dkp_id
		// where pm.status_pr='approved'";
		$sql="SELECT pmd.no_sppr, pmd.pr_no, pmd.id_pr, pmd.material_id as 'id_mat', d.dkp_no, dm.kode_barang, dm.nama_bahan, dm.material_name, dm.date_bth , pmd.qty_angka, pm.status_pr, dm.* FROM pr_material_detail pmd
		join pr_master pm on pm.id_pr_master=pmd.pr_master_id
		join dkp_material dm on dm.id_material=pmd.material_id
		join dkp_master d on d.id_dkp=dm.dkp_id
		where pm.status_pr='approved' and pmd.qty_angka-pmd.qty_tot_buy!=0";

    $result=$this->general_model->select($sql);
    $table=array();

    foreach ($result as $key ) {
      array_push($table, array(
        '<td>
          <input type="checkbox" name="id_pr[]" class="checkboxes" value="'.$key['id_pr'].'"/>
        </td>',
        $key['pr_no'],
        $key['dkp_no'],
        $key['kode_barang'],
        $key['nama_bahan'].'<input type="hidden" name="nama_bahan[]" value="'.$key['nama_bahan'].'">',
        $key['material_name'],
        $key['date_bth'],
        $key['qty_angka']
      ));
    }

    echo json_encode(array('data'=>$table));
  }

	public function build_po()
	{
		$nama_bahan=$this->input->post('nama_bahan');
		$data['nama_bahan']=array();
		$data['id_po']=array();
		$data['status']=TRUE;
		$id_pr_selected_arr=$this->input->post('id_pr');
		$id_pr_selected_st=implode("-",$id_pr_selected_arr);

		for ($i=0; $i < count($id_pr_selected_arr) ; $i++) {
			$cek=$this->cek_draf_po($id_pr_selected_arr[$i]);
			if($cek['status']){
				$data['nama_bahan'][]=$nama_bahan[$i];
				$data['status']=FALSE;
				$data['id_po'][]=$cek['id_po'];
			}
		}

		if($data['status']===FALSE){
			echo json_encode($data);
			exit();
		}

		$data=array(
			'date_create'=>date('Y-m-d'),
			'create_by'=>$_SESSION['nik'],
			'id_pr'=>$id_pr_selected_st
		);
		$insert=$this->general_model->insert('po_master', $data);

		if($insert!=0){

			for ($i=0; $i < count($id_pr_selected_arr) ; $i++) {
				$data=array(
					'po_master_id'=>$insert,
					'pr_id'=>$id_pr_selected_arr[$i],
				);
				$save=$this->general_model->insert('po_detail', $data);
			}
		}
		echo json_encode(array('status'=>true, 'id'=>$id_pr_selected_st, 'id_po'=>$insert));
	}

	private function cek_draf_po($id_pr){
		$data['id_po']='';
		$data['status']=FALSE;
		$sql="SELECT * FROM `po_detail` WHERE `pr_id` = '$id_pr'";
		$result=$this->general_model->select($sql);

		foreach ($result as $key) {
			if($key['status_po_detail']=='open'){
				$data['status']=TRUE;
				$data['id_po']=$key['po_master_id'];
				return $data;
			}
		}

		return $data; //tidak ada yang open
	}

	/*
	* ============================================================================================================================================================================================================
	* Page Create PO
	* =================================================================================================================================================================================================================
	*/

	public function create($id_po)
	{
		$sql="SELECT * FROM `po_master` WHERE id_po_master=$id_po and status_po='draf'";
		$result=$this->general_model->select_row($sql);
		$id_pr=explode('-', $result['id_pr']);

		$table=array();

		for ($i=0; $i < count($id_pr); $i++) {
			array_push($table, $this->get_pr_detail($id_pr[$i]) );
		}

		$this->load->view('pr/create', $data);
	}

	private function get_pr_detail($id_pr)
	{
		$sql="SELECT pmd.no_sppr, pmd.pr_no, pmd.id_pr, pmd.material_id as 'id_mat', d.dkp_no, dm.kode_barang, dm.nama_bahan, dm.material_name, dm.date_bth , pmd.qty_angka, pm.status_pr, dm.*
		FROM pr_material_detail pmd
		join pr_master pm on pm.id_pr_master=pmd.pr_master_id
		join dkp_material dm on dm.id_material=pmd.material_id
		join dkp_master d on d.id_dkp=dm.dkp_id
		where pmd.id_pr='$id_pr'";

		$result=$this->general_model->select_row($sql);
		foreach ($result as $key) {
			$data=array(
					$key['pr_no'].'<input type="hidden" name="id_pr[]" value="'.$key['id_pr'].'" class="form-control">',
					$key['dkp_no'],
					$key['kode_barang'],
					$key['nama_bahan'],
					'<input type="text" name="merk[]" class="form-control">',
					$key['no_sppr'],
					$key['qty_angka'], //qty out
					'<input type="text" name="qty_buy[]" class="form-control">', //qty buy
					$key['satuan'], //stn
					'<input type="text" name="qty_po[]" class="form-control">', //qty po
					'<input type="text" name="stn_po[]" class="form-control">', //stn
					'<input type="text" name="hgs[]" class="form-control">', //qty po
					'<input type="text" id="disc_'.$key['id_pr'].'" name="disc[]" class="form-control">', //qty po
					'<input type="text" id="sum_'.$key['id_pr'].'"name="sum[]" class="form-control">', //qty po
					'<input type="text" id="sum_'.$key['id_pr'].'"name="last_hgs[]" class="form-control">', //qty po
				);
		}
		return $data;
	}

}
