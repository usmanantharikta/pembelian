<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_attach(){
      $sql="SELECT * FROM sppr_attachement";
      $query=$this->db->query($sql);
      return $query->result_array();
    }

    public function get_nonhyg(){
      $sql="SELECT * FROM sppr_nonhygienic";
      $query=$this->db->query($sql);
      return $query->result_array();
    }

    public function get_fin(){
      $sql="SELECT * FROM sppr_finishing";
      $query=$this->db->query($sql);
      return $query->result_array();
    }

  }
