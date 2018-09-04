<?php
  class User_model extends CI_Model {

    public $id;
    public $name;
    public $date;
    public function __construct() {
    parent::__construct();
    $this->load->database();
    }
    public function index(){
    }
    public function insert($name, $age, $city){
      $this->db->set('name',$name);
      $this->db->set('age',$age);
      $this->db->set('city',$city);
      $this->db->insert('user');
    }
    public function view($page){
      return $this->db->get('user', 5, $page*5);
    }
  }
?>
