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
            $_SESSION['user']=$user[0];
            $_SESSION['is_login']=true;
            $data=["status"=>1,"err"=>"WelCome Back ".$_SESSION['user']['Name']."!"];
            $this->db->where('id',$_SESSION['user']['id'])->update('tblusers',["last_login"=>time()]);
            $_SESSION['step']=1;
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
      $update['YoutubeAPIKey']=$this->input->post('apikey'); 
      $update['YoutubeAPISecret']=$this->input->post('apisec');
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
      return redirect('home');
    } 
    public function manage_ajax(){
      $data['status']=1;
      // require_once 'C:/ffmpeg/vendor/autoload.php';
      // $ffmpeg = FFMpeg\FFMpeg::create();
      if($data['status']!=0){
      $config['file_name'] = time().'-'.$_FILES["file"]['name'];
      $config['upload_path' ]  = 'uploads/videos/'; 
      $config['allowed_types'] = 'wmv|mp4|avi|mov|3gp'; 
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ( ! $this->upload->do_upload('file')) {
        $data=["status"=>0,"err"=>$this->upload->display_errors()];
      }else{
        $insert['url'] = $this->upload->file_name; 
        $copy_insert['url']=$this->upload->file_name;
        // $video = $ffmpeg->open(SERVER_PATH.'/video_editor_3/uploads/videos/'.$insert['url']);
        $file_name = uniqid().'-Thumbnail.jpg';
        // $thumbnail_path=SERVER_PATH."/video_editor_3/uploads/thumbnails/".$file_name;
        // $video
        // ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(2))
        // ->save($thumbnail_path);
        $res['thumbnail'] = base_url('uploads/thumbnails/'.$file_name);
        $insert['thumbnail']=$file_name;
      }

     }

     if($data['status']!=0){
      $insert['user_id']=$_SESSION['user']['id'];
      $insert['is_delete']=0;
      $this->db->insert('upload_video',$insert);
      $copy_insert['id']=$this->db->insert_id();
      $this->db->insert('copy_video',$copy_insert);
      $data=["status"=>1,"res"=>$res['thumbnail']];
     }
     echo json_encode($data);
    }

    function get_youtube_result(){
    error_reporting(E_ERROR | E_WARNING | E_PARSE); 
    define('MAX_RESULTS',30);
    $str=$this->input->post('str');
    $apikey = $_SESSION['user']['YoutubeAPIKey']; 
    if($apikey!=""){
    $googleApiUrl = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q=' . $str . '&maxResults=' . MAX_RESULTS . '&key=' . $apikey;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);

    curl_close($ch);
    $data = json_decode($response);
    $value = json_decode(json_encode($data), true);
    $html="";
    for ($i = 0; $i < MAX_RESULTS; $i++) {
      $id=$value['items'][$i]['id']['videoId'];
      $title=$value['items'][$i]['snippet']['title'];
      $thumbnail=$value['items'][$i]['snippet']['thumbnails']['medium']['url'];
      $channelTitle=$value['items'][$i]['snippet']['channelTitle'];
      $attr="'".$thumbnail."','".$id."'";
      if($thumbnail==""){
        continue;
      }
      $html.='<tr><td class="txt-oflo">'.$title.'</td>
       <td><img class="img-preview" src="'.$thumbnail.'"></td>
       <td class="txt-oflo">'.$channelTitle.'</td>
       <td><a href="javascript:void(0)" onclick="save_youtube_video('.$attr.')" class="fw-normal">Add</a></td>
       </tr>';
    }
    $data=["status"=>1,"result"=>$html];
  }else{
    $data=["status"=>0,"err"=>"API Key Not Found!"];
  }
  echo json_encode($data);
  }
  public function download_video(){
    $thumbnail=$this->input->post('thumb');
    $video_id=$this->input->post('video_id');
    if($video_id!=""){
$image_url = $thumbnail;
$file=time().'-1234.jpg';
$save_as = SERVER_PATH.'/video_editor_3/uploads/thumbnails/'.$file;
$ch = curl_init($image_url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US)");
$raw_data = curl_exec($ch);
curl_close($ch);
$fp = fopen($save_as, 'x');
fwrite($fp, $raw_data);
fclose($fp);
     $insert['thumbnail']=$file;
     $second = time()."-youtube.mp4";
     $command_exec = escapeshellcmd('python3 '.SERVER_PATH.'/video_editor_3/python/script.py '.$video_id.' '.$second);
     $str_output = shell_exec($command_exec);
     if(!empty($str_output)){
       $insert['url']=$second;
       $copy_insert['url']=$second;
       $insert['user_id']=$_SESSION['user']['id'];
       $insert['is_delete']=0;
       $res['thumbnail'] = base_url('uploads/thumbnails/'.$insert['thumbnail']);
       $this->db->insert('upload_video',$insert);
       $copy_insert['id']=$this->db->insert_id();
       $this->db->insert('copy_video',$copy_insert);
       $data=["status"=>1,"res"=>$res['thumbnail']];
     }else{
      $data=["status"=>0,"err"=>"Something went wrong!"];
     }
    }else{
        $data=["status"=>0,"err"=>"The video is not found, please check YouTube URL."];
    } 
    echo json_encode($data);
  }

  public function update_status_video(){
    $vid=$this->input->post('vid');
    $video=$this->db->where(["video_id"=>$vid,"user_id"=>$_SESSION['user']['id']])->get('select_video')->result_array();
    if(count($video)>0){
       $this->db->where('id',$video[0]['id'])->delete('select_video');
    }else{
      $this->db->insert('select_video',["video_id"=>$vid,"user_id"=>$_SESSION['user']['id']]);
    }
    echo 'true';
    die();
  }

  public function manage_step(){
    $step=$this->input->post('step');
    if($step!=""){
      $_SESSION['step']=$step;
    }
    echo $_SESSION['step'];
  }

  public function manage_sorting(){
   $class=$this->input->post('classs');
   $sorting_num=$this->input->post('num');
   $get_id=explode(" ",$class);
   $this->db->where('id',$get_id[1])->update('select_video',["sorting_num"=>$sorting_num]);
   echo true;
  }

  public function manage_trim_video(){
      require_once 'C:/ffmpeg/vendor/autoload.php';
      $ffmpeg = FFMpeg\FFMpeg::create();
      
    if($_POST['video_duration']>$_POST['start_trim']){
      $video=$this->db->where('id',$this->input->post('video_id'))->get('upload_video')->result_array();
      $videodbl = $ffmpeg->open(SERVER_PATH."/video_editor_3/uploads/videos/".$video[0]['url']);
      $video_new_name=time().$_SESSION['user']['id']."new.mp4";
      $clip = $videodbl->clip(FFMpeg\Coordinate\TimeCode::fromSeconds($this->input->post('start_trim')), FFMpeg\Coordinate\TimeCode::fromSeconds($this->input->post('end_trim')));
      $clip->save(new FFMpeg\Format\Video\X264(), SERVER_PATH."/video_editor_3/uploads/videos/".$video_new_name);
      $insert['trimStart']=$this->input->post('start_trim');
      $insert['trimEnd']=$this->input->post('end_trim');
      $insert['video_id']=$video[0]['id'];
      $insert['user_id']=$_SESSION['user']['id'];
      $this->db->insert('saved_video',$insert);
      $this->db->where(["user_id"=>$_SESSION['user']['id'],"video_id"=>$this->input->post('video_id')])->update('select_video',["is_saved"=>1]);
      $this->db->where("id",$video[0]['id'])->update('upload_video',["url"=>$video_new_name]);
      $data=["status"=>1];
     
    }else{
      $data=["status"=>0,"err"=>"Start trim Time should be less than then video duration"];
    }
    echo json_encode($data);
  }

  function merge_video(){
    $videos=$this->db->where(['user_id'=>$_SESSION['user']['id'],'is_saved'=>1])->order_by('sorting_num','asc')->get('select_video')->result_array();
    if(count($videos)>0){
      foreach($videos as $key=>$vid){
        $video=$this->db->where('id',$vid['video_id'])->get('upload_video')->result_array();
        $_SESSION['recent_video'][]=$vid['video_id'];
        $vide[]=SERVER_PATH."/video_editor_3/uploads/videos/".$video[0]['url'];
        $this->db->where("id",$vid['id'])->delete('select_video');
      }
      file_put_contents(SERVER_PATH.'/video_editor_3/uploads/videolist'.$_SESSION['user']['id'].'.txt', implode("\n", array_map(function ($path) {
       return 'file ' . addslashes($path);
      }, $vide)));
      $video_mergeurl=$_SESSION['user']['id'].time().'merge.mp4';
      $cmd="C:/ffmpeg/bin/ffmpeg -f concat -safe 0 -i ".SERVER_PATH."/video_editor_3/uploads/videolist".$_SESSION['user']['id'].".txt -c copy ".SERVER_PATH."/video_editor_3/uploads/videos/".$video_mergeurl;
      shell_exec($cmd);
      $merge_videos=$this->db->where('user_id',$_SESSION['user']['id'])->get('merge_videos')->result_array();
      if(count($merge_videos)>0){
        $this->db->where('user_id',$_SESSION['user']['id'])->delete('merge_videos');
        $this->db->insert('merge_videos',["user_id"=>$_SESSION['user']['id'],"url"=>$video_mergeurl]);
      }else{
        $this->db->insert('merge_videos',["user_id"=>$_SESSION['user']['id'],"url"=>$video_mergeurl]);
      }
    }
    echo true;
  }

  function manage_render_video(){
    require_once 'C:/ffmpeg/vendor/autoload.php';
    $ffmpeg = FFMpeg\FFMpeg::create();
    $video_path=SERVER_PATH."/video_editor_3/uploads/videos/";
    $new_video=time().$_SESSION['user']['id']."_render.mp4";
    if(isset($_POST['text']) && $_POST['text']!=""){
      $vid=$this->db->where('user_id',$_SESSION['user']['id'])->get('merge_videos')->result_array();
      $text=$this->input->post('text');
      $font_size=$this->input->post('font_size');
      $font_color=str_replace(' ', '', $this->input->post('font_color'));
      $font_position=$this->input->post('position');
      $pos="x=(w-text_w)/2: y=(h-text_h)/2:";
      if($font_position=='center'){
        $pos='x=(w-text_w)/2: y=(h-text_h)/2:';
      }else if($font_position=='top_center'){
        $pos='x=(w-text_w)/2:y=0:';
      }else if($font_position=='bottom_center'){
        $pos='x=(w-text_w)/2:y=h-th:';
      }else if($font_position=='top_left'){
        $pos='x=0:y=0:';
      }else if($font_position=='left_bottom'){
        $pos='x=0:y=h-th:';
      }else if($font_position=='top_right'){
        $pos='x=w-tw:y=0:';
      }else if($font_position=='right_bottom'){
        $pos='x=w-tw:y=h-th:';
      }
      $video = $ffmpeg->open($video_path.$vid[0]['url']);
      $command = "text='$text': fontfile=OpenSans-Regular.ttf: fontcolor=".$font_color.": fontsize=".$font_size.": box=1: boxcolor=black@0.5: boxborderw=5: ".$pos;
     $video->filters()->custom("drawtext=$command");
     $video->save(new FFMpeg\Format\Video\X264(), $video_path.$new_video);
     if(isset($_SESSION['render_id']) && $_SESSION['render_id']!=""){
      $video_old_render=$this->db->where('id',$_SESSION['render_id'])->get('rendered_videos')->result_array();
      unlink(SERVER_PATH."/video_editor_3/uploads/videos/".$video_old_render[0]['url']);
      $this->db->where('id',$_SESSION['render_id'])->update('rendered_videos',["url"=>$new_video]);
      unset($_SESSION['render_id']);
     }else{
     $this->db->insert('rendered_videos',["user_id"=>$_SESSION['user']['id'],"url"=>$new_video,"isDeleted"=>0,"video_id"=>json_encode($_SESSION['recent_video'])]);
     unset($_SESSION['recent_video']);
     }
     $_SESSION['step']=5;
     $this->db->where('user_id',$_SESSION['user']['id'])->delete('merge_videos');
     $data=["status"=>1,"err"=>"Congo!"];
    }else{
      $data=["status"=>0,"err"=>"Text Is required!"];
    }
    echo json_encode($data);
    
  }

  public function delete_video(){
   $id=$this->input->post('video');
   $video=$this->db->where('id',$id)->get('upload_video')->result_array();
   unlink(SERVER_PATH."/video_editor_3/uploads/videos/".$video[0]['url']);
   $this->db->where('id',$id)->update('upload_video',["is_delete"=>1]);
  }

  public function delete_render_video($id){
   $video=$this->db->where('id',$id)->get('rendered_videos')->result_array();
   unlink(SERVER_PATH."/video_editor_3/uploads/videos/".$video[0]['url']);
   $this->db->where('id',$id)->delete('rendered_videos');
   return redirect('home');
  }
    
}

      
