<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('user_model');
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
      $data=substr($data,strlen($remove[$i]),strlen($data));
        break;
      }
    }
    if(substr($data,strlen($data)-1,1)==' '){
      $data=substr($data,0,strlen($data)-1);
    }
    $this->user_model->insert($name, $age, $data);
  }
  public function view($page=NULL){
    if((!isset($page)) or (!is_numeric($page))){
      $page=0;
    }
    $data['query']=$this->user_model->view($page);
    $data['page']=$page;
    $this->load->view('user_view', $data);
  }
}
