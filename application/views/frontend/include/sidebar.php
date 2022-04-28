<?php
$current_page=$this->router->fetch_method();
?>
<div class="side-bar">
    <a class="<?php echo $current_page=='index'?'active':'' ?>" href="<?php echo base_url('home') ?>">
        Home
    </a>
    <a href="<?php echo base_url('home/nft_sol') ?>">NFTs and Crypto</a>

    <a href="<?php echo base_url('home/training') ?>">Training</a>
    <?php if($_SESSION['user']['is_admin']==1){ ?> 
     <a class="<?php echo $current_page=='admin'?'active':'' ?>" href="<?php echo base_url('home/admin') ?>">Admin</a>

    <?php } ?>
</div>