<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gm extends CI_Controller {

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

  public function list_po_approval_gm()
  {
  	$this->load->view('gm/list_po_approval_gm');
  }

  public function list_po_approved_gm()
  {
  	$this->load->view('gm/list_po_approved_bod');
  }

  public function get_po_approval_bod()
  {
    $sql="SELECT * FROM db_demo_pms.po_master pm
          JOIN db_pembelian.po_supplier ps on ps.supplier_code=pm.code_supplier
          where pm.status_po='approved' and pm.status_ob='open'";

    $result=$this->general_model->select($sql);

    $table=array();

    foreach ($result as $key) {
        // if(!$this->get_sum($key['id_po_master'])){ //jika jumlahnya tidak lebih dari parameter max
          array_push($table, array(
            '<a class="'.$this->get_class($key['id_po_master']).'" onclick="show_po('.$key['id_po_master'].')">'.$key['po_no'].'</a>',
            $key['date_po'],
            $key['date_sent'],
            $key['supplier_name'],
            // $this->get_alamat($key['id_alamat']),
            '<span class="label label-sm label-success">Waiting approval</span>',
            $key['cur_id'].' '.number_format($key['total_bt'],2,",","."),
            $key['cur_id'].' '.number_format($key['ppn'],2,",","."),
            $key['cur_id'].' '.number_format(floatval($key['total_bt'])*floatval($key['pph'])/100,2,",","."),
            $key['cur_id'].' '.number_format($key['total'],2,",","."),
						$key['comment'],
						'<a class="btn btn-sm btn-success" title="Cancel" onclick="approve_bod('.$key['id_po_master'].')"><i class="glyphicon glyphicon-pencil"></i> Approve</a>
						<a class="btn btn-sm btn-warning" title="addComent" onclick="add_comment('.$key['id_po_master'].')"><i class="glyphicon glyphicon-plus"></i> Add Comment</a>'
          ));
        // }
    }

    echo json_encode(array('data'=>$table));
  }

	public function get_po_approved_bod()
	{
		$sql="SELECT * FROM db_demo_pms.po_master pm
					JOIN db_pembelian.po_supplier ps on ps.supplier_code=pm.code_supplier
					where pm.status_po='approved' and pm.status_ob='approved'";

		$result=$this->general_model->select($sql);

		$table=array();

		foreach ($result as $key) {
				// if(!$this->get_sum($key['id_po_master'])){
					array_push($table, array(
						'<a class="'.$this->get_class($key['id_po_master']).'" onclick="show_po('.$key['id_po_master'].')">'.$key['po_no'].'</a>',
						$key['date_po'],
						$key['date_sent'],
						$key['supplier_name'],
						// $this->get_alamat($key['id_alamat']),
						'<span class="label label-sm label-success">'.$key['status_ob'].'</span>',
						$key['cur_id'].' '.number_format($key['total_bt'],2,",","."),
						$key['cur_id'].' '.number_format($key['ppn'],2,",","."),
						$key['cur_id'].' '.number_format(floatval($key['total_bt'])*floatval($key['pph'])/100,2,",","."),
						$key['cur_id'].' '.number_format($key['total'],2,",","."),
						// $key['comment'],
						// '<a class="btn btn-sm btn-success" title="Cancel" onclick="approve_bod('.$key['id_po_master'].')"><i class="glyphicon glyphicon-pencil"></i> Approve</a>
						// <a class="btn btn-sm btn-warning" title="addComent" onclick="add_comment('.$key['id_po_master'].')"><i class="glyphicon glyphicon-plus"></i> Add Comment</a>'
					));
				// }
		}

		echo json_encode(array('data'=>$table));
	}

  public function get_sum($id_po)
  {
    $sql="SELECT * FROM `po_detail` pd
		join pr_material_detail pm on pm.id_pr=pd.pr_id
		join dkp_material dm on dm.id_material=pm.material_id
		WHERE `po_master_id` = '$id_po'";
    $result=$this->general_model->select($sql);

		//get parameter max
		$sql="SELECT * FROM `po_parameter`";
		$res=$this->general_model->select_db2($sql);

    $sum=0;
    $status=TRUE;

    foreach ($result as $key) {

			//jika lebih dari parameter
      // if((floatval($key['jumlah'])/floatval($key['qty_po']))>floatval($res[0]['item_max'])){
      //   $status=FALSE;
      // }

			//jika ada kenaikan harga
			// if((floatval($key['jumlah'])/floatval($key['qty_po']))>floatval($key['last_hgs'])){
			// 	$status=FALSE;
			// }

			//jika lebih dari budget
			if(floatval($key['hgs'])>floatval($key['basic_price_budget'])){
				$status=FALSE;
			}

      // $sum+=floatval($key['jumlah']);
    }

		//jika lebih dari paramter
    // if($sum>floatval($res[0]['total_max'])){
    //   $status=FALSE;
    // }

    return $status; //return status
  }

  public function get_class($id_po)
  {
    $sql_table="SELECT dm.basic_price_budget, pmd.qty_angka, pmd.qty_tot_buy, dm.nama_bahan, sum(qty_buy) as 'tot_qty_buy',dm.satuan, sum(qty_po) as 'tot_qty_po', stn_po, hgs, last_hgs, disc, sum(jumlah) as 'jumlah' FROM po_detail pd
      join po_master pm on pm.id_po_master=pd.po_master_id
      join pr_material_detail pmd on pmd.id_pr=pd.pr_id
      join dkp_material dm on dm.id_material=pmd.material_id
      where pd.po_master_id= $id_po
      GROUP by dm.nama_bahan";
    $res_tab=$this->general_model->select($sql_table);
//cek over budget
    foreach ($res_tab as $key) {
      if(floatval($key['hgs'])>floatval($key['basic_price_budget'])){
        $class="over_po";
        return $class;
        exit;
      }

			// if(floatval($key['last_hgs'])<floatval($key['hgs'])){
			// 	$class="expensive_po";
			// 	return $class;
			// 	exit;
			// }
    }
//ada kenaikan harga
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

  public function view_po($id_po_master)
{
  $sql_table="SELECT pd.last_hgs, pm.cur_id, pd.ppn, pd.pph, dm.basic_price_budget, pmd.qty_angka, pmd.qty_tot_buy, dm.nama_bahan, sum(qty_buy) as 'tot_qty_buy',dm.satuan, sum(qty_po) as 'tot_qty_po', stn_po, hgs, disc, sum(jumlah) as 'jumlah' FROM po_detail pd
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
    if(floatval($key['hgs'])+(floatval($key['hgs'])*floatval($key['disc'])/100)>floatval($key['basic_price_budget'])){
      $class="over";
    }
    else{
      $class="";
    }
    array_push($table, array(
      $no,
      $key['nama_bahan'],
      $key['qty_angka'],
      floatval($key['qty_angka'])-floatval($key['qty_tot_buy']),
      $key['tot_qty_buy'],
      $key['satuan'],
      $key['tot_qty_po'],
      $key['stn_po'],
    	number_format($key['basic_price_budget'],2,",","."),
      $key['cur_id'].' '.number_format($key['hgs'],2,",",".").'<input type="hidden" class='.$class.'>',
			$key['cur_id'].' '.number_format($key['last_hgs'],2,",","."),
      $key['disc'],
			$key['cur_id'].' '.number_format($key['jumlah'],2,",","."),
			$key['cur_id'].' '.number_format($key['ppn'],2,",","."),
			$key['pph'],
			// number_format($key['pph'],2,",","."),
    ));
    $no+=1;
    $tot_harga+=floatval($key['jumlah']);
  }

  $sql_master="SELECT * FROM po_master pm left join po_import pi on pi.id_import=pm.import_id where id_po_master=$id_po_master";

  $res_master=$this->general_model->select_row($sql_master);

  $data_supp=$this->get_supplier_by_id($res_master['code_supplier']);

  $data_alamat=$this->get_alamat($res_master['id_alamat']);

  echo json_encode(array('tot_harga'=>$tot_harga, 'table'=>$table, 'master'=>$res_master, 'supplier'=>$data_supp, 'alamat'=>$data_alamat));

}

public function get_supplier_by_id($supplier_code)
{
	$sql="SELECT supplier_code, supplier_name, contact_name, telp, fax FROM `po_supplier` where supplier_code='$supplier_code'";
	$res=$this->general_model->select_db2($sql);

	return $res[0];
}

public function get_alamat($id){
  $sql="SELECT * FROM `po_address` WHERE id_address='$id'";
  $res=$this->general_model->select_db2($sql);
  return $res[0]['address'];
}

//save comment on po approval

public function save_comment()
{
	$update=$this->general_model->update('po_master', array('comment'=>$this->input->post('comment')), array('id_po_master'=>$this->input->post('id_po')));

	echo json_encode(array('status'=>true, 'res'=>$update));
}

//Parameter
public function parameter()
{
	$sql="SELECT * FROM `po_parameter`";
	$res=$this->general_model->select_db2($sql);
	$data['param']=$res;

	$this->load->view('bod/parameter', $data);
}

public function save_param()
{
	$sql='update db_pembelian.po_parameter set item_max="'.$this->input->post('item').'",total_max="'.$this->input->post('total').'" where id_parameter=1';
	// echo $sql;
	$this->db->query($sql);

	echo json_encode(array('status'=>true));
}

public function approve_po_gm($id)
{
	$update=$this->general_model->update('po_master', array('status_ob'=>'approved', 'approve_ob'=>$_SESSION['nik'], 'date_ob	'=>date('Y-m-d')), array('id_po_master'=>$id));
	echo json_encode(array('status'=>true, 'id'=>$update));
}


}
