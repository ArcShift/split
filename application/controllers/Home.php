<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->database();
    $this->load->view('header');
  }
	public function index()
	{
    $this->load->helper('form');
		$this->load->view('input');
    if(isset($_POST['OK'])){
      echo 'ok';
    }
    echo $this->input->post('data');
	}
  public function submit(){
//    $this->load->database();
    $data= $this->input->post('data');
    for($i=0;$i<strlen($data);$i++){
      if(is_numeric(substr($data,$i,1))){
        $name=substr($data,0,$i);
        if(substr($name,strlen($name)-1,1)==' '){
          $name=substr($name,0,strlen($name)-1);
          $name=strtoupper($name);
        }
        $data=substr($data,$i,strlen($data));
        break;
      }
    }
    for($i=0;$i<strlen($data);$i++){
      if(!is_numeric(substr($data,$i,1))){
        $age=substr($data,0,$i);
        $data=substr($data,$i,strlen($data));
        $data=strtoupper($data);
        break;
      }
    }
    $remove=array(' TAHUN', ' THN', ' TH', 'TAHUN','THN','TH');
    for($i=0;$i<count($remove);$i++){

      if(0==strcmp($remove[$i],substr($data,0,strlen($remove[$i])))){
//        echo 'found'.$remove[$i];
      $data=substr($data,strlen($remove[$i]),strlen($data));
        break;
      }
    }
    if(substr($data,strlen($data)-1,1)==' '){
      $data=substr($data,0,strlen($data)-1);
    }
    $sql="INSERT INTO user (name, age, city) VALUES ('".$name."', '".$age."','".$data."')";;
    $this->db->query($sql);
    $this->load->view('input');
  }
  public function view($page=NULL){
    if((!isset($page)) or (!is_numeric($page))){
      $page=0;
    }
    $query = $this->db->query('SELECT*FROM user LIMIT 5 OFFSET '.$page*5 );
//    echo 'Total Results: ' . $query->num_rows();
    $data['query']=$query;
    $data['page']=$page;
    $this->load->view('dataview', $data);
  }
}
