<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * this class using for genral propose
 */

class General_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $CI = &get_instance();
        // $this->mssql = $CI->load->database('dbsqlsrv',TRUE);
        $this->db2= $CI->load->database('po', TRUE);
    }

    public function select_db2($sql)
    {
      $result=$this->db2->query($sql);
      return $result->result_array();
    }

    public function insert_db2($table, $data){
      $this->db2->insert($table, $data);
      return $this->db2->insert_id();
    }

    public function test(){
        // $sql="select * from Pengguna";
        // $result=$this->mssql->query($sql);
        // return $result->result_array();
        $this->mssql->update('Pengguna' ,array('password'=>password_hash("engineering",  PASSWORD_DEFAULT)), array('user_id'=>13));
        return $this->db->affected_rows();
    }

    public function insert_ms($table, $data){
      $this->mssql->insert($table, $data);
      return $this->mssql->insert_id();
    }

    public function insert($table, $data){
      $this->db->insert($table, $data);
      return $this->db->insert_id();
    }

    public function update($table, $data, $where){
      $this->db->update($table ,$data, $where);
      return $this->db->affected_rows();
    }

    public function select($sql){
      $result=$this->db->query($sql);
      return $result->result_array();
    }

    public function select_row($sql){
      $result=$this->db->query($sql);
      return $result->row_array();
    }

    public function delete($id,$colom, $table)
    {
      $this->db->where($colom, $id);
      $this->db->delete($table);
    }

    public function update_manual($sql)
    {
      $update=$this->db->query($sql);
      return $update;
    }

  }
