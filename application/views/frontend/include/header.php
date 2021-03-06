<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<style>
    a div img.h-full{
        height: 350px !important;
    }
</style>
<nav class="px-2 pt-2" style="height: 65px;">
<div class="flex h-full justify-between p-2 rounded-xl bg-white items-center shadow-c">
    <a href="/"><img src="<?php echo base_url('assets/logo.png') ?>" style="height: 45px; margin: 0.25rem;"></a>
    <div class="flex items-center">
        <button class="nav-btn mr-2" onclick="history.back()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
            <path fill="currentColor" d="M19 11H7.83l4.88-4.88c.39-.39.39-1.03 0-1.42a.996.996 0 0 0-1.41 0l-6.59 6.59a.996.996 0 0 0 0 1.41l6.59 6.59a.996.996 0 1 0 1.41-1.41L7.83 13H19c.55 0 1-.45 1-1s-.45-1-1-1z"></path>
            </svg>
        </button>
        <div class="dropdown relative">
            <button class="nav-btn mr-2">
            <a href="<?php echo base_url('home/logout') ?>">
                <i class="fas fa-sign-out-alt"></i>
            </a>
            </button>
        </div>
    </div>
</div>
</nav>