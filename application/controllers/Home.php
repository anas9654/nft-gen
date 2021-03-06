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
     if($_SESSION['user']['roll']=='Free' && $_GET['page']>5){
          echo "<h1>You are not Pro User</h1>";
          echo "<script>history.back();</script>";
          exit();
     }
     $page='main';
	   $this->load->view("frontend/{$page}",["title"=>"Solana NFTs"]);  
	}

  public function nft_eth(){
    if(!isset($_SESSION['is_login'])){
         return redirect('home');
     }
     if($_SESSION['user']['roll']=='Free' && $_GET['page']>5){
      echo "<h1>You are not Pro User</h1>";
      echo "<script>history.back();</script>";
      exit();
 }
     $page='maineth';
     $this->load->view("frontend/{$page}",["title"=>"ETH NFTs"]);  
  }

  public function up_eth(){
    if(!isset($_SESSION['is_login'])){
         return redirect('home');
     }
     if($_SESSION['user']['roll']=='Free' && $_GET['page']>5){
      echo "<h1>You are not Pro User</h1>";
      echo "<script>history.back();</script>";
      exit();
 }
     $page='upeth';
     $this->load->view("frontend/{$page}",["title"=>"Up ETH NFTs"]);  
  }
  public function up_sol(){
    if(!isset($_SESSION['is_login'])){
         return redirect('home');
     }
     if($_SESSION['user']['roll']=='Free' && $_GET['page']>5){
      echo "<h1>You are not Pro User</h1>";
      echo "<script>history.back();</script>";
      exit();
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

  public function soldeal(){
    if(!isset($_SESSION['is_login'])){
         return redirect('home');
     }
     if($_SESSION['user']['roll']=='Free' && $_GET['page']>5){
      echo "<h1>You are not Pro User</h1>";
      echo "<script>history.back();</script>";
      exit();
 }
     $page='soldeal';
     $this->load->view("frontend/{$page}",["title"=>"Sol Deal"]);  
  }
  public function ethdeal(){
    if(!isset($_SESSION['is_login'])){
         return redirect('home');
     }
     if($_SESSION['user']['roll']=='Free' && $_GET['page']>5){
      echo "<h1>You are not Pro User</h1>";
      echo "<script>history.back();</script>";
      exit();
 }
     $page='ethdeal';
     $this->load->view("frontend/{$page}",["title"=>"ETH Deal"]);  
  }

  public function training(){
    if(!isset($_SESSION['is_login'])){
         return redirect('home');
     }
     $page='training';
     $this->load->view("frontend/{$page}",["title"=>"training"]);  
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
     $data =$this->db->where('id',$_SESSION['user']['id'])->get('tblusers')->result_array();
     $page='profile';
     $this->load->view("frontend/{$page}",["title"=>"Profile","user"=>$data[0]]);  
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
            $data=["status"=>1,"err"=>"Welcome Back ".$_SESSION['user']['Name']];
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
     if(isset($_POST['email'])){
      $update['emailId']=$this->input->post('email'); 
      if($this->input->post('password')!=""){
        $update['userPassword'] =md5($this->input->post('password'));
      }
      $perform =$this->db->where('id',$_SESSION['user']['id'])->update('tblusers',$update);
      $data=["status"=>1,"err"=>"Profile Updated!"];
    }else{
      $data=["status"=>0,"err"=>"Required Field Missing!"];
    }
    echo json_encode($data);
    }

    public function logout(){
      $this->session->sess_destroy();
      unset($_COOKIE['user']);
      setcookie('user', null, -1, '/'); 
      return redirect('home');
    } 
    public function admin(){
      if($_SESSION['is_login']!=true && ($_SESSION['user']['is_admin']!=1 || $_SESSION['user']['roll']!="Agency")){
        return redirect('home');
      }
      $page='admin';
      $users=$this->db->where('is_admin',0)->where('id!='.$_SESSION['user']['id'])->get('tblusers')->result_array();
      $this->load->view("frontend/{$page}",["title"=>"Admin Panel","users"=>$users]); 
    }
    public function delete_user($id){
      if($_SESSION['is_login']!=true && $_SESSION['user']['is_admin']!=1){
        return redirect('home');
      }
      $this->db->where('id',$id)->delete('tblusers');
      return redirect('home/admin');
    }
    public function get_data($id){
      if($id!==""){
        $users=$this->db->where('id',$id)->get('tblusers')->result_array();
        if($users){
          echo json_encode(['user'=>$users[0]]);
        }else{
          $this->response->setStatusCode(404, 'Nope. Not here.'); 
        }
      }else{
        $this->response->setStatusCode(404, 'Nope. Not here.');
      }
    }
    public function user_update(){
      if($_SESSION['is_login']!=true && $_SESSION['user']['is_admin']!=1){
        $this->response->setStatusCode(403, 'Nope. Not here.'); 
        exit();
      }
      if(isset($_POST['email'])&& $_POST['email']!=""){
        $insert['emailId']=$_POST['email'];
        if(isset($_POST['password']) && $_POST['password']!=""){
          $insert['userPassword']=md5($_POST['password']);
        } 
        $insert['roll']=$_POST['roll'];
        if($_POST['roll']=='Admin'){
          $insert['is_admin']=1;
        }else{
          $insert['is_admin']=0;
        }
        if(isset($_POST['is_update']) && $_POST['is_update']!=0){
          $this->db->where('id',$_POST['is_update'])->update('tblusers',$insert);
        }else{
          $this->db->insert('tblusers',$insert);
        }
        echo json_encode(["status"=>1]);
        exit();
      }else{
        $this->response->setStatusCode(422, 'Nope. Not here.');
        exit();
      }
    }
    public function reminders(){
      if(!isset($_SESSION['is_login'])){
        return redirect('home');
      }
      $page='reminders';
      $nfts=$this->db->where('user_id',$_SESSION['user']['id'])->get('save_nft')->result_array();
      $this->load->view("frontend/{$page}",["title"=>"Reminders","nfts"=>$nfts]);  
    }
    public function updatenft(){
      if($_SESSION['is_login']!=true && $_SESSION['user']['is_admin']!=1){
        echo "You Are not authorized!";
        exit();
      }
      if(isset($_POST['data'])){
        $data=(array) json_decode($_POST['data']);
        $checkLink=$this->db->where(['link!=""'])->where('link="'.$data['links'][0].'"')->get('save_nft');
        if($checkLink->num_rows()>0){
          echo "This NFT already saved!";
          exit();
        }
        $insert['link']=$data['links'][0];
        $insert['data']=json_encode($data);
        $insert['user_id']=$_SESSION['user']['id'];
        $this->db->insert('save_nft',$insert);
        echo "Saved!";
        exit();
      }
      echo "Something went wrong!";
    }
}

      
