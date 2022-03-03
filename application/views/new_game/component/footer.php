  </div>
  <!-- Footer Nav -->
  <div class="footer-nav-area" id="footerNav">
      <div class="container px-0">
          <!-- =================================== -->
          <!-- Paste your Footer Content from here -->
          <!-- =================================== -->
          <!-- Footer Content -->

          <?php if ($this->uri->segment(1) == 'info') { ?>
              <div class="footer-nav position-relative">
                  <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
                      <li class="">
                          <a href="#" onclick="goBack()">
                              <i style="font-size: 25px;" class="bi bi-skip-start-fill"></i>

                              <span>Back</span></a>
                      </li>
                      <li><a href="<?php echo $this->config->item('base_url'); ?>?access=<?php echo $_GET['access']; ?>">
                              <i style="font-size: 25px;" class="bi bi-house-door-fill"></i>
                              <span>Home</span>
                          </a>
                      </li>

                      <li><a href="<?php echo $this->config->item('base_url'); ?>/welcome?access=<?php echo $_GET['access']; ?>">
                              <i style="font-size: 25px;" class="bi bi-skip-end-fill"></i>
                              <span>Next</span>
                          </a>
                      </li>
                  </ul>
              </div>
          <?php } ?>


          <?php if ($this->uri->segment(1) == 'hadiah') { ?>
              <div class="footer-nav position-relative">
                  <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
                      <li class="">
                          <a href="#" onclick="goBack()">
                              <i style="font-size: 25px;" class="bi bi-skip-start-fill"></i>

                              <span>Back</span></a>
                      </li>
                      <li><a href="<?php echo $this->config->item('base_url'); ?>?access=<?php echo $_GET['access']; ?>">
                              <i style="font-size: 25px;" class="bi bi-house-door-fill"></i>
                              <span>Home</span>
                          </a>
                      </li>

                      <li><a href="<?php echo $this->config->item('base_url'); ?>/welcome?access=<?php echo $_GET['access']; ?>">
                              <i style="font-size: 25px;" class="bi bi-skip-end-fill"></i>
                              <span>Next</span>
                          </a>
                      </li>
                  </ul>
              </div>
          <?php } ?>

          <?php if ($this->uri->segment(1) == 'welcome') { ?>
              <div class="footer-nav position-relative">
                  <ul class="h-100 d-flex align-items-center justify-content-between ps-0">

                      <?php if ($offset == 0) { ?>

                          <li class="">
                              <a href="#" onclick="goBack()">
                                  <i style="font-size: 25px;" class="bi bi-skip-start-fill"></i>

                                  <span>Back</span></a>
                          </li>

                      <?php } else {  ?>

                          <li class="">
                              <a href="<?php echo $this->config->item('base_url'); ?>/welcome?access=<?php echo $_GET['access']; ?>&offset=<?php echo $offset - 10; ?>">
                                  <i style="font-size: 25px;" class="bi bi-skip-start-fill"></i>

                                  <span>Back</span></a>
                          </li>
                      <?php } ?>



                      <li><a href="<?php echo $this->config->item('base_url'); ?>?access=<?php echo $_GET['access']; ?>">
                              <i style="font-size: 25px;" class="bi bi-house-door-fill"></i>
                              <span>Home</span>
                          </a>
                      </li>

                      <?php if (count($berikutnya) > 0) { ?>


                          <li><a href="<?php echo $this->config->item('base_url'); ?>/welcome?access=<?php echo $_GET['access']; ?>&offset=<?php echo $offset + 10; ?>" onclick="goForward()">
                                  <i style="font-size: 25px;" class="bi bi-skip-end-fill"></i>
                                  <span>Next</span>
                              </a>
                          </li>

                      <?php } else { ?>
                          <li><a onclick="goForward()">
                                  <i style="font-size: 25px;" class="bi bi-skip-end-fill"></i>
                                  <span>Next</span>
                              </a>
                          </li>
                      <?php } ?>





                  </ul>
              </div>
          <?php } ?>




      </div>
  </div>
  <!-- All JavaScript Files -->
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/slideToggle.min.js"></script>
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/internet-status.js"></script>
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/tiny-slider.js"></script>
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/baguetteBox.min.js"></script>
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/countdown.js"></script>
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/rangeslider.min.js"></script>
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/vanilla-dataTables.min.js"></script>
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/index.js"></script>
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/magic-grid.min.js"></script>
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/dark-rtl.js"></script>
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/active.js"></script>
  <!-- PWA -->
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/pwa.js"></script>

  <script>
      function goForward() {
          window.history.forward();
      }

      function goBack() {
          window.history.back();
      }
  </script>

  <?php if ($this->uri->segment(2) == 'penukaran_hadiah') {   ?>

      <script type="text/javascript">
          $(document).ready(function() {


              $(document).on('click', ':not(form)[data-confirm]', function(e) {
                  if (!confirm($(this).data('confirm'))) {
                      e.stopImmediatePropagation();
                      e.preventDefault();
                  }
              });

              function sorting_data() {
                  alert("wqdqwd");
              }
          });
      </script>
  <?php } ?>

  <script>
      function tukar_hadiah(url, tanya) {
          Swal.fire({
                  text: tanya,
                  confirmButtonColor: '#79216b',
                  showCancelButton: true,
                  confirmButtonText: 'Iya',

              }

          ).then((result) => {


                  if (result.isConfirmed) {
                      window.location.href = url;
                  }
              }

          )
      }
  </script>

  </body>

  </html>