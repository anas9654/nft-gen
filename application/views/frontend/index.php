<html>
    <head>
    <link rel="stylesheet" href="<?php echo base_url('css/home.css') ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    </head>
    <body style="">
   <div id="root">
      <div style="position: fixed; z-index: 9999; inset: 16px; pointer-events: none;"></div>
      <main class="w-screen h-screen">
         <?php include('include/header.php') ?>
         <div class="flex sm:flex-row flex-col">
           <?php include('include/sidebar.php') ?>
            <div class="p-2 yt">
               <h1 class="text-center font-bold my-4">Welcome to <span class="text-primary">NFT Finder</span></h1>
               <iframe src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
               <div class="mt-6 flex sm:flex-row flex-col items-center">
                  <a href="https://www.youtube.com/channel/UCEI27zjwnNBZaITCLeZuvVg" class="btn-yt items-center flex mr-2">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 16 16">
                        <path fill="currentColor" d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104l.022.26l.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105l-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006l-.087-.004l-.171-.007l-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103l.003-.052l.008-.104l.022-.26l.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007l.172-.006l.086-.003l.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"></path>
                     </svg>
                     <span class="ml-2">Subscribe to my Youtube Channel</span>
                  </a>
                  <a href="https://www.facebook.com/groups/459650811944100" class="btn-fb items-center flex mr-2">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                        <path d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z" fill="currentColor"></path>
                     </svg>
                     <span class="ml-2">Join My Private Buyer-Only Facebook Group</span>
                  </a>
               </div>
            </div>
         </div>
      </main>
   </div>
</body>
</html>