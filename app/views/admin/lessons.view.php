<?php $this->view('partials/private.header',$data) ?>
<?php $this->view('partials/private.nav',$data) ?>

<main class="main" id="main">
  <!-- ---------| Page Title |--------- -->
  <div class="pagetitle">
    <h1 class=""><?=$data['title']?></h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=ROOT?>">Home</a></li>
        <li class="breadcrumb-item active"><?=$data['title']?></li>
      </ol>
    </nav>
  </div>
  <!-- -------| ./Page Title\. |------- -->
  
  <!-- ---- CHECK Page MESSAGES ---- -->
  <div class="row">
    <div class="col-md-6 w-50">
      <div class="<?=!message() ? 'd-none' : ''?> text-center my-4">
        <?php if(message()):?>
          <span class="alert alert-warning">
            <i class="bi bi-envelope-dash"></i>
              <span class=""><?=message('',true)?></span>
          </span>
        <?php endif;?>
      </div>
    </div>
  </div>
  <!-- -| ./CHECK Page MESSAGES\. |- -->

  <!-- ---------| Main Content |--------- -->
  <?php if ($uid->role_id == 3): ?>
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?=ucfirst($uid->role_name)?></h5>
  
          <?php if(!empty($rows)): ?>

          <?php else: ?>
            <div class="alert alert-warning">You are not enrolled in any courses yet.</div>

            <!-- ---------|  |--------- -->
        <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h4 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                Accordion Item #1
              </button>
            </h4>
            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample" style="">
              <div class="accordion-body">
                <strong>This is the first item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h4 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Accordion Item #2
              </button>
            </h4>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h4 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Accordion Item #3
              </button>
            </h4>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
              </div>
            </div>
          </div>
        </div>
            <!-- -------| ./\. |------- -->
  
              <!-- ---------|  |--------- -->
              <!-- <ul class="list-group">
                <?php foreach($rows as $row): ?>
                  <li class="list-group-item">
                    <strong><?=esc($row->title)?></strong>
                    <div class="small text-muted"><?=course_status($row)?></div>
                  </li>
                <?php endforeach; ?>
              </ul> -->

          <?php endif; ?>
  
        </div>
      </div>
    </section>
  <?php elseif ($uid->role_id == 2): ?>
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?=ucfirst($uid->role_name)?></h5>
  
          <?php if(!empty($rows)): ?>
            <ul class="list-group">
              <?php foreach($rows as $row): ?>
                <li class="list-group-item">
                  <strong><?=esc($row->title)?></strong>
                  <div class="small text-muted"><?=course_status($row)?></div>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            <div class="alert alert-warning">You are not enrolled in any courses yet.</div>
          <?php endif; ?>
  
        </div>
      </div>
    </section>
  <?php elseif ($uid->role_id == 1): ?>
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?=ucfirst($uid->role_name)?></h5>
  
          <?php if(!empty($rows)): ?>
            <ul class="list-group">
              <?php foreach($rows as $row): ?>
                <li class="list-group-item">
                  <strong><?=esc($row->title)?></strong>
                  <div class="small text-muted"><?=course_status($row)?></div>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            <div class="alert alert-warning">You are not enrolled in any courses yet.</div>
          <?php endif; ?>
  
        </div>
      </div>
    </section>
  <?php else: ?>
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?=ucfirst($data['title'])?></h5>
  
          <?php if(!empty($rows)): ?>
            <ul class="list-group">
              <?php foreach($rows as $row): ?>
                <li class="list-group-item">
                  <strong><?=esc($row->title)?></strong>
                  <div class="small text-muted"><?=course_status($row)?></div>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            <div class="alert alert-warning">You are not enrolled in any courses yet.</div>
          <?php endif; ?>
  
        </div>
      </div>
    </section>
  <?php endif; ?>
  <!-- -------| ./Main Content\. |------- -->

</main>
