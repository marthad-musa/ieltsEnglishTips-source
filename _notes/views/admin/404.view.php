<?php $this->view('admin/admin-header',$data) ?>

  <div class="pagetitle row">
    <div class="col-md-6">
      <h1 class=""><?=$data['title']?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=ROOT?>//">Home</a></li>
          <li class="breadcrumb-item active"><?=$data['title']?></li>
        </ol>
      </nav>
    </div>
    <div class="col-md-6 w-50">
      <!-- ---- CHECK Page MESSAGES ---- -->
      <div class="<?=!message() ? 'd-none' : ''?> text-center my-4">
        <?php if(message()):?>
          <span class="alert alert-warning">
            <i class="bi bi-envelope-dash"></i>
              <span class=""><?=message('',true)?></span>
          </span>
        <?php endif;?>
      </div>
      <!-- -| ./CHECK Page MESSAGES\. |- -->
    </div>
  </div>
  <!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-10">
        <div class="row">

          <!-- Sales Card -->
          <div class="col-md-10 col-xxl-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">404&comma;&nbsp;Page <span>not found!</span></h5>
              </div>
            </div>
            <!-- End Card -->
          </div>
          <!-- End Sales Card -->
        </div>
        <!-- End ROW -->
      </div>
      <!-- End Left side columns -->

    </div>
  </section>

    <!-- ======= Footer ======= -->
<?php $this->view('admin/admin-footer',$data) ?>
