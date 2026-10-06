<?php $this->view('partials/public.header', $data) ?>
<?php $this->view('partials/public.navbar', $data) ?>
<!-- ----------| ./INCLUDES\. |---------- -->

<!-- ------------- MAIN ------------- -->
<main class="main">

  <!-- ---------| Page Title |--------- -->
  <div class="page-title" data-aos="fade">
    <!-- ---------| Hero Section |--------- -->
    <section id="hero" class="hero section dark-background">

      <img src="<?=ROOT?>/assets/img/hero-11.png" alt="" data-aos="fade-in" class="opacity-50">

      <div class="container text-start">
        <h2 data-aos="fade-up" data-aos-delay="100">Courses</h2>
        <p data-aos="fade-up" data-aos-delay="200">Explore our comprehensive courses<br>designed to help you optain your future goals.</p>
      </div>
    </section>
    <!-- -------| ./Hero Section\. |------- -->

    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="<?=ROOT?>">Home</a></li>
          <li class="current">Courses<br></li>
        </ol>
      </div>
    </nav>
  </div>
  <!-- -------| ./Page Title\. |------- -->

  <!-- ---------| Courses Section |--------- -->
  <section id="courses" class="courses section">

    <div class="container">

      <div class="row">

        <?php if (!empty($rows)): ?>
          <?php foreach ($rows as $row): ?>
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
              <div class="course-item">
                <?php if (!empty($row->course_image) && file_exists($row->course_image)): ?>
                  <img src="<?=esc(get_image($row->course_image))?>" class="img-fluid" alt="<?=esc($row->title)?>">
                <?php endif; ?>
                <div class="course-content">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <?php if (!empty($row->category_row->category)): ?>
                      <p class="category"><a href="<?=ROOT?>/course_details/<?=esc($row->slug)?>" class="text-white"><?=esc($row->category_row->category)?></a></p>
                    <?php endif; ?>
                    <?php if (isset($row->price_row->price) && is_numeric($row->price_row->price)): ?>
                      <p class="price">
                        <?php if ((float)$row->price_row->price === 0.0): ?>
                          Free
                        <?php else: ?>
                          <?=esc($row->currency_row->symbol ?? '')?><?=esc($row->price_row->price)?>
                          <?php if (!empty($row->currency_row->currency)): ?>
                            <sup><?=esc($row->currency_row->currency)?></sup>
                          <?php endif; ?>
                        <?php endif; ?>
                      </p>
                    <?php endif; ?>
                  </div>
    
                  <h3><a href="<?=ROOT?>/course_details/<?=esc($row->slug)?>"><?=esc($row->title)?></a></h3>
                  <?php if (!empty($row->subtitle)): ?>
                    <p class="description"><?=esc($row->subtitle)?></p>
                  <?php endif; ?>
                  <p class="description"><?=esc($row->description)?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="col-12">
            <p class="text-center">No courses are available right now.</p>
          </div>
        <?php endif; ?>

      </div>

    </div>

  </section>
  <!-- -------| ./Courses Section\. |------- -->

</main>
<!-- ----------| ./MAIN\. |---------- -->

<!-- ------------- INCLUDES ------------- -->
<?php $this->view('partials/public.footer',$data) ?>