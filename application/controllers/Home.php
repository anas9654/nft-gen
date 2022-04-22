<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {



	public function __construct() { 
         parent::__construct(); 
         $this->load->helper(array('form', 'url'));
         $this->load->library('encrypt');
         $this->load->library('form_validation'); 
         $this->load->library('session'); 
         $this->load->helper('cookie');
         if(isset($_COOKIE['user']) && $_COOKIE['user']!=="" && !isset($_SESSION['is_login'])){
            $data=$this->db->where(["id"=>$_COOKIE['user']])->get('tblusers')->result_array();
            $_SESSION['user']=$data[0];
            $_SESSION['is_login']=true; 
         }
         // Please Define SerVer Path
         define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT']);
 }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
    if(!isset($_SESSION['is_login'])){
      $page='login';
      $title="Login";
    }else{
      $page='index';
      $title="Home";
    }
    $this->load->view("frontend/{$page}",["title"=>$title]);  
	}

	public function register(){
	  if(isset($_SESSION['is_login'])){
         return redirect('home');
     }
     $page='register';
	   $this->load->view("frontend/{$page}",["title"=>"Register"]);  
	}
  public function nft_sol(){
	  if(!isset($_SESSION['is_login'])){
         return redirect('home');
     }
     $page='main';
	   $this->load->view("frontend/{$page}",["title"=>"Solana NFTs"]);  
	}

  public function nft_eth(){
    if(!isset($_SESSION['is_login'])){
         return redirect('home');
     }
     $page='maineth';
     $this->load->view("frontend/{$page}",["title"=>"ETH NFTs"]);  
  }

  public function up_eth(){
    if(!isset($_SESSION['is_login'])){
         return redirect('home');
     }
     $page='upeth';
     $this->load->view("frontend/{$page}",["title"=>"Up ETH NFTs"]);  
  }
  public function up_sol(){
    if(!isset($_SESSION['is_login'])){
         return redirect('home');
     }
     $page='upsol';
     $this->load->view("frontend/{$page}",["title"=>"Up SOL NFTs"]);  
  }
  public function crypto(){
    if(!isset($_SESSION['is_login'])){
         return redirect('home');
     }
     $page='crypto';
     $this->load->view("frontend/{$page}",["title"=>"Crypto Alerts"]);  
  }
	
	public function sign_up(){
	    if(isset($_POST['email']) && isset($_POST['password'])){
	      //  $name=$this->input->post('name'); 
	      //  $phone=$this->input->post('phone'); 
	       $mail=$this->input->post('email'); 
	       $pass=$this->input->post('password'); 
	       $confirm_password=$this->input->post('confirm_password'); 
	       if($confirm_password==$pass){
	          if($this->db->where(["emailId"=>$mail])->get('tblusers')->num_rows()>0){
	            $data=["status"=>0,"err"=>"This Email Already Exist!"];  
	          }else{
	              $query=$this->db->insert('tblusers',['emailId'=>$mail,'userPassword'=>md5($confirm_password),'regDate'=>date('Y-m-d'),"isActive"=>1]);
	              if($query){
	                $data=["status"=>1,"err"=>"Your Account Registered Successfully!"];     
	              }else{
	               $data=["status"=>0,"err"=>"Sorry! We Can't Available to handle this request try again later!"];   
	              }
	          } 
	       }else{
	           $data=["status"=>0,"err"=>"Please Enter Both Password Same!"];
	       }
	       
	    }else{
	      $data=["status"=>0,"err"=>"Input Data Missing"];   
	    }
	    echo json_encode($data);
	}
    public function profile(){
     if(!isset($_SESSION['is_login'])){
         return redirect('home');
     }
     $this->load->view("crazyspects/index",["title"=>"Profile Details","page"=>"profile.php"]);   
    }
    
    public function sign_in(){
        if(isset($_POST['email']) and isset($_POST['password'])){
         $phone=$this->input->post('email'); 
         $pass=$this->input->post('password');
         $data=$this->db->where(["emailId"=>$phone,"userPassword"=>md5($pass)])->get('tblusers');
         if($data->num_rows()>0){
            $user=$data->result_array();
            $_SESSION['is_login']=true;
            $_SESSION['user']=$user[0];
            setcookie('user', $user[0]['id'], time() + (86400 * 30), "/");
            $data=["status"=>1,"err"=>"WelCome Back ".$_SESSION['user']['Name']."!"];
            $this->db->where('id',$_SESSION['user']['id'])->update('tblusers',["last_login"=>time()]);
         }else{
            $data=["status"=>0,"err"=>"You entered wrong Details"];  
         }
        }else{
          $data=["status"=>0,"err"=>"Input Data Missing"];  
        }
        echo json_encode($data);
    }

    public function update_profile(){
     if(isset($_POST['name'])){
      $update['Name']=$this->input->post('name'); 
      $update['emailId']=$this->input->post('email'); 
      $update['mobileNumber']=$this->input->post('mobile'); 
      $update['lastUpdationDate']=date('Y-m-d');
      $config['file_name'] = time().'-'.$_FILES["image"]['name'];
      $config['upload_path' ]  = 'uploads/profile/'; 
      $config['allowed_types'] = 'gif|jpg|png'; 
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ( ! $this->upload->do_upload('image')) {
        $data=["status"=>0,"err"=>$this->upload->display_errors()];
      }else{ 
        $update['profile'] = $this->upload->file_name;
      }
      $this->db->where('id',$_SESSION['user']['id'])->update('tblusers',$update);
      $userdata=$this->db->where('id',$_SESSION['user']['id'])->get('tblusers')->result_array();
      $_SESSION['user']=$userdata[0];
      $data=["status"=>1,"err"=>"Profile Updated!"];
    }else{
      $data=["status"=>0,"err"=>"Required Field Missing!"];
    }
    echo json_encode($data);
    }

    public function logout(){
      $this->session->sess_destroy();
      unset($_COOKIE['user']);
      return redirect('home');
    } 
}

      
