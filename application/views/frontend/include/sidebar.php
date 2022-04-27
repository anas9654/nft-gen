<?php
$current_page=$this->router->fetch_method();
?>
<div class="side-bar">
    <a class="<?php echo $current_page=='index'?'active':'' ?>" href="<?php echo base_url('home') ?>">
        Home
    </a>
    <a href="<?php echo base_url('home/nft_sol') ?>">NFTs and Crypto</a>
    <a href="<?php echo base_url() ?>">Training</a>
    <?php if($_SESSION['user']['is_admin']==1 || $_SESSION['user']['roll']=='Agency'){ ?> 
     <a class="<?php echo $current_page=='admin'?'active':'' ?>" href="<?php echo base_url('home/admin') ?>">
       <?php echo $_SESSION['user']['is_admin']==1?'Admin':'Agency' ?>
     </a>
    <?php } ?>
</div>