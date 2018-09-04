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
//      $this->db->get('user');
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


    //=============================
    public function get_last_ten_entries()
    {
      $query = $this->db->get('entries', 10);
      return $query->result();
    }
    public function insert_entry(){
      $this->title    = $_POST['title']; // please read the below note
      $this->content  = $_POST['content'];
      $this->date     = time();
      $this->db->insert('entries', $this);
    }
    public function update_entry()
    {
            $this->title    = $_POST['title'];
            $this->content  = $_POST['content'];
            $this->date     = time();
            $this->db->update('entries', $this, array('id' => $_POST['id']));
    }
  }
?>
