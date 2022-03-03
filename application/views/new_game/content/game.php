 <div class="top-products-area">
     <div class="container">
         <div class="row g-3">
             <!-- Single Top Product Card -->
             <?php for ($i = 0; $i < count($data); $i++) { ?>
                 <div class="col-6 col-sm-4 col-lg-3">
                     <div class="card single-product-card">
                         <div class="card-body p-3">
                             <!-- Product Thumbnail -->
                             <a href="<?php echo $this->config->item('base_url'); ?>welcome/detail_game/<?php echo $data[$i]['id'];  ?>?access=<?php echo $_GET['access']; ?>" class="product-thumbnail d-block" href="page-shop-details.html">
                                 <img style=" height: 150px;;   width: 150px;" src="<?php echo $data[$i]['picture']; ?>" alt="">
                             </a>
                             <!-- Badge -->
                             <!-- <span class="badge bg-warning">Sale</span></a> -->
                             <!-- Product Title -->
                             <p class="product-title text-center d-block text-truncate"><?php echo $data[$i]['title']; ?></p>
                             <!-- Product Price -->
                             <!-- <p class="sale-price">$9.89<span>$13.42</span></p> -->
                             <!-- <a class="btn btn-outline-info btn-sm" href="#">
                                     <svg class="bi bi-cart me-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                         <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                                     </svg>Add to Cart
                                 </a> -->
                         </div>
                     </div>
                 </div>
             <?php } ?>
         </div>
     </div>
 </div>