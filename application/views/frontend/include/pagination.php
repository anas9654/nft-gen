<center>
                    <nav aria-label="Page navigation example" style="margin:10px">
                        <ul class="inline-flex -space-x-px">
                            <?php if($page>1){ ?>
                            <li>
                                <a href="?page=<?php echo $page-1 ?>"
                                    class="py-2 px-3 ml-0 leading-tight text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                            </li>
                            <?php } ?>
                            <?php for($i=1;$i<=$totalPages;$i++){
                            if($i>$page+19){
                              continue;
                            }
                            if($_SESSION['user']['roll']=="Free"){
                               if($i>5){
                                   continue;
                               }
                            } ?>
                            <li>
                                <a href="?page=<?php echo $i ?>" 
                                    class="py-2 px-3 leading-tight <?php echo $page==$i?"text-blue-600 bg-blue-50":'text-gray-500 bg-white' ?> border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><?php echo $i ?></a>
                            </li>
                            <?php } ?>
                            <?php if($page<$totalPages){ 
                                if($_SESSION['user']['roll']=='Free' && $page>4){
                                    // echo "<script>history.back();</script>";
                                }else{ ?>
                                    <li>
                                     <a href="?page=<?php echo $page+1 ?>"
                                         class="py-2 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                                    </li>
                                 <?php } ?>
                            <?php } ?>
                        </ul>
                    </nav>
                    </center>