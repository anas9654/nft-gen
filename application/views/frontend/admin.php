<html>
    <head>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url('css/home.css') ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body style="">
   <div id="root">
      <div style="position: fixed; z-index: 9999; inset: 16px; pointer-events: none;"></div>
      <main class="w-screen h-screen">
         <?php include('include/header.php') ?>
         <div class="flex sm:flex-row flex-col">
           <?php include('include/sidebar.php') ?>
            <div class="p-2 yt">
                <a href="javascript:void(0)" onclick="$('#exampleModal').modal('toggle');"><button class="btn btn-primary">Add New</button></a>
               <h3 class="text-center font-bold my-4">Admin Panel</h3>
               <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Email</th>
      <th scope="col">Roll</th>
      <?php if($_SESSION['user']['roll']!='Agency'){ ?>
        <th scope="col">Action</th>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
      <?php if(count($users)>0){
          foreach($users as $key=>$user){
              $index=$key+1;
              echo "<tr>";
              echo "<th>{$index}</th>";
              echo "<td>{$user['emailId']}</td>";
              echo "<td>{$user['roll']}</td>";
              if($_SESSION['user']['roll']!='Agency'){
               echo "<td><a href='".base_url('home/delete_user/'.$user['id'])."'><i class='fas fa-trash-alt'></i></a>
                        <a href='javascript:void(0)' onclick='GetData(".$user['id'].")'><i class='fas fa-pencil-alt'></i></a></td>";
              }
              echo "<tr>";
          }
      } ?>
  </tbody>
</table>
            </div>
         </div>
      </main>
   </div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="register-form" onsubmit="return submit_form()">
        <input type="hidden" id="is_update" name="is_update" value="0">
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="email" id="email" required class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Password</label>
            <input type="password" name="password" id="password" class="form-control"  aria-describedby="emailHelp" placeholder="Enter password">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Roll</label>
            <select class="form-control" name="roll" id="roll">
                <option selected disabled>Select Roll</option>
                <option value="Free">Free</option>
                <option value="Pro">Pro</option>
                <option value="Admin">Admin</option>
                <option value="Agency">Agency</option>
            </select>
        </div>
        <button type="submit" id="submit-button" class="btn btn-primary">Submit</button>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
    async function submit_form(){
        $('#submit-button').html('<i class="fas fa-spinner fa-pulse"></i>');
        var form=jQuery("#register-form")[0];
        var formdata1=new FormData(form);
        const response= await axios.post('<?php echo base_url('home/user_update') ?>',formdata1);
        if(response.status==200){
            window.location.href="";
        }else{
            alert("something went wrong!");
        }
        $('#submit-button').html('Submit');
        return false;
    }
    async function GetData(id){
       const Response= await axios.get('<?php echo base_url('home/get_data/') ?>'+id);
       if(Response.status==200){
          $('#email').val(Response.data.user.emailId);
          $('#roll').val(Response.data.user.roll);
          $('#is_update').val(Response.data.user.id);
          $('#exampleModal').modal('toggle');
       }else{
           alert('something went wrong!');
       }
    }
</script>


</body>
</html>