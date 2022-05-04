<html lang="en"><head>
    <meta charset="UTF-8">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="icon" type="image/svg+xml" href="data:image/png;base64,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">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Underpriced NFT Finder | Solana</title>
    <link rel="stylesheet" href="<?php echo base_url('css/main.css') ?>">
    
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css"       rel="stylesheet">
    <script src="https://cdn-tailwindcss.vercel.app/"></script>


    </head>
  <body style="">
    <div id="root">
   <div style="position: fixed; z-index: 9999; inset: 16px; pointer-events: none;"></div>
   <main>

   <?php include('./simple_html_dom.php'); ?>

   <?php include('include/header.php') ?>
      <div class="p-2 flex sm:flex-row flex-col sm:overflow-hidden overflow-y-auto content">
         <?php include('include/sidebar-inside.php') ?>
         <div class="shadow-c sm:overflow-y-scroll bg-white rounded-xl p-2 sm:ml-2 sm:mt-0 mt-2 w-full sm:h-full h-max">
         <?php
            $i=0;
            $nftName = array();
            $imagesLinks=array();
            $nftlink = array();
            $nftPrice = array();
                  $html = file_get_html('https://nextdrop.is/upcoming-nft-drops');
                  foreach($html->find('td') as $element) {
                        if($i%9==4)
                        {
                          // foreach($element->find('a') as $e) {
                            // echo htmlspecialchars($element) . "<br><br><br>";
                            array_push($nftPrice, htmlspecialchars($element -> innertext));
                          // }
                    }
                     $i++;
                  }

                  foreach($html->find('td') as $element) {
                    
                   if($i%9==2)
                        {
                          foreach($element->find('a') as $e) {
                            // echo "https://nextdrop.is" . htmlspecialchars($e -> href) . "<br><br><br>";
                            array_push($nftlink, "https://nextdrop.is" . htmlspecialchars($e -> href));
                          }
                        
                    }
                     $i++;
                  


                   
                  }




                     // echo $element;
                    foreach($html->find('strong') as $element) {
                      if($i>4){
                        if($i%2==0)
                        {
                          // echo htmlspecialchars($element -> innertext) . "<br>";
                          array_push($nftName, $element->innertext);
                        }
                        
                      }
                      $i++;
                    }



                    foreach($html->find('img') as $element) {

                      if($i>1)
                      {     
                        if($element->src == "/static/images/default.png")      {
                          array_push($imagesLinks, $element -> getAttribute('data-src'));
                        }         
                        else{
                          array_push($imagesLinks, $element->src);
                        }
                      }
                     $i++;
                    }


                    array_shift($imagesLinks);
                    array_shift($imagesLinks);
                    // array_shift($imagesLinks);
                    array_shift($nftName);
                    array_shift($nftName);
                    array_shift($nftName);
                    // array_shift($imagesLinks);
                    // array_shift($imagesLinks);
                    // print_r($imagesLinks);

                  // $num = 0;
                  // foreach ($imagesLinks as $n) {

                  //   if($num>1)
                  //   {
                  //     print_r($imagesLinks[$num-1] . "<br>");  
                  //     print_r($nftlink[$num] . "<br>");
                  //     print_r($nftName[$num] . "<br>");
                  //     print_r(htmlspecialchars($nftPrice[$num]) . "<br>");
                  //   }
                  //   $num++;
                  // }

                  $page = ! empty( $_GET['page'] ) ? (int) $_GET['page'] : 1;
                  $total = count( $nftlink); //total items in array    
                  $limit = 18; //per page    
                  $totalPages = ceil( $total/ $limit ); //calculate total pages
                  $page = max($page, 1); //get 1 page when $_GET['page'] <= 0
                  $page = min($page, $totalPages); //get last page when $_GET['page'] > $totalPages
                  $offset = ($page - 1) * $limit;
                  if( $offset < 0 ) $offset = 0;
                  
                  $nftlink= array_slice( $nftlink, $offset, $limit );
                  $imagesLinks=array_slice( $imagesLinks, $offset, $limit );
                  $nftName = array_slice( $nftName, $offset, $limit );
                  $nftPrice = array_slice( $nftPrice, $offset, $limit );       

         ?>


                    <section>
                        <div
                            class="grid grid-cols-2 4k:grid-cols-8 2xl:grid-cols-6 xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 auto-cols-fr -mx-2 svelte-10i0xj7">
                            <?php
              $num = 0;
                  foreach ($nftlink as $n) {
                    if($num>1)
                    {
                      $data=["name"=>$nftName[$num],"image"=>$imagesLinks[$num],"price"=>$nftPrice[$num],"links"=>[$nftlink[$num]]]; 
                     ?>
                            <div class="px-2 mb-4"><a rel="noopener noreferrer nofollow"
                                    href="<?php echo $nftlink[$num] ?>" target="_blank">
                                    <div class="transition-transform mt-2 md:hover:-translate-y-2 h-full shadow hover:shadow-lg rounded-lg overflow-hidden "
                                        data-cy="card-featured-collection">
                                        <div
                                            class="relative flex flex-col min-w-0 break-words bg-transparent w-full h-full">
                                            <div
                                                class="w-full h-full align-middle overflow-hidden relative svelte-f3nlpp">
                                                <img class="w-full h-full align-middle object-cover dark:brightness-80 dark:contrast-103 svelte-f3nlpp"
                                                    alt="Cool Pigz" src="<?php echo $imagesLinks[$num] ?>"
                                                    loading="lazy" decoding="async"> <img
                                                    class="w-full h-full align-middle object-cover placeholder dark:hidden svelte-f3nlpp opacity-0 absolute"
                                                    src="/assets/img/rarity-loading.gif" alt="Cool Pigz"> <img
                                                    class="w-full h-full align-middle object-cover placeholder hidden dark:block svelte-f3nlpp opacity-0 absolute"
                                                    src="/assets/img/rarity-loading-dark.gif" alt="Cool Pigz">
                                                <div
                                                    class="absolute bottom-0 left-0 right-0 h-10 bg-white dark:bg-dark-card background-hack svelte-f3nlpp">
                                                </div>
                                            </div>
                                            <div class="h-20 sm:h-24 shrink-0"></div>
                                            <div class="absolute bottom-0 left-0 right-0">
                                                <blockquote slot="bottom"
                                                    class="flex-1 w-full bg-white dark:bg-dark-card relative p-4 space-1">
                                                    <h4 class="w-full text-left text-sm sm:text-base font-extrabold text-blueGray-dark dark:text-dark-text border-gray-200"
                                                        data-ellipsis-id="1"><?php echo $nftName[$num] ?>
                                                    </h4>
                                                    <div
                                                        class="flow-root text-sm text-blueGray-light dark:text-dark-text antialiased whitespace-nowrap">
                                                        <div class="text-left float-left items-center gap-0.5 bg-blueGray-dark text-orangeWhiteHover rounded-md px-1.5"
                                                            data-cy="coin-ETH">
                                                            <!-- <i class="fab fa-ethereum fa-xs svelte-10eojg6"></i> -->
                                                            <?php echo $nftPrice[$num] ?>
                                                        </div>
                                                        <a href="<?php echo $nftLinks[$num] ?>">
                                                            <button
                                                                class=" float-right bg-green-300 hover:bg-green-400 text-white-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                                                <span style="color: white;">Know More</span>
                                                            </button></a>
                                                    </div>
                                                    <a href="#">
                                    <center style="margin-top: 3px;">
                                    <button onclick='manage_nft(<?php echo json_encode($data) ?>)'' class="w-full float-right bg-green-300 hover:bg-green-400 text-white-800 font-bold py-2 px-4 rounded items-center">
                                        <span class="text-center" style="color: white;">Add to Reminder</span>
                                    </button>  
                                        
                                    </center>
                                                        </a>
                                                </blockquote>
                                            </div>
                                        </div>
                                    </div>
                                </a> </div>
                            <?php 
                    }
                    $num++;
                  }
?>
           
         </div>
         <?php include('include/pagination.php') ?>
      </div>
   </main>
</div>
<script>
    async function manage_nft(data){
      var formdata=new FormData();
      formdata.append('data',JSON.stringify(data));
      const response= await axios.post('<?php echo base_url('home/updatenft') ?>',formdata);
      if(response.status==200){
          alert(response.data)
      }
    }
</script>
</body></html>