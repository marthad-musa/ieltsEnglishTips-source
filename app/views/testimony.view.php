<?php $this->view('partials/public.header', $data) ?>
<?php $this->view('partials/public.navbar', $data) ?>
<!-- ----------| ./INCLUDES\. |---------- -->

<!-- ------------- MAIN ------------- -->
<main class="main">

  <div class="page-title" data-aos="fade">
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="<?=ROOT?>">Home</a></li>
          <li class="">Events</li>
          <li class="current">What our students say</li>
        </ol>
      </div>
    </nav>
  </div>
  <!-- -------| ./Page Title\. |------- -->

  <section class="section testimony-section">
    <div class="container" data-aos="fade-up">
      <header class="testimony-heading text-center mx-auto">
        <span class="testimony-eyebrow">Real progress. Real students.</span>
        <h1>What our students say</h1>
        <p>Discover how focused guidance helped IELTS learners build confidence and reach their target bands.</p>
      </header>

      <div id="student-testimonials" class="carousel slide testimony-carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#student-testimonials" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Show Ahmed's testimonial"></button>
          <button type="button" data-bs-target="#student-testimonials" data-bs-slide-to="1" aria-label="Show Balkhes's testimonial"></button>
          <button type="button" data-bs-target="#student-testimonials" data-bs-slide-to="2" aria-label="Show Mohammed's testimonial"></button>
          <button type="button" data-bs-target="#student-testimonials" data-bs-slide-to="3" aria-label="Show Reem's testimonial"></button>
        </div>

        <div class="carousel-inner">
          <div class="carousel-item active">
            <article class="testimony-card">
              <img src="<?=ROOT?>/assets/img/Ahmed.png" class="testimony-image" alt="Ahmed from Sudan shares his IELTS Band 6.5 result and thanks his teacher for the guidance and tips.">
              <div class="testimony-student">
                <span class="testimony-name">Ahmed <span class="testimony-country">· Sudan</span></span>
                <span class="testimony-band">Band 6.5</span>
              </div>
            </article>
          </div>
          <div class="carousel-item">
            <article class="testimony-card">
              <img src="<?=ROOT?>/assets/img/Balgkes.png" class="testimony-image" alt="Balkhes from Sudan shares her IELTS Band 6.5 result and says she felt well prepared and guided.">
              <div class="testimony-student">
                <span class="testimony-name">Balkhes <span class="testimony-country">· Sudan</span></span>
                <span class="testimony-band">Band 6.5</span>
              </div>
            </article>
          </div>
          <div class="carousel-item">
            <article class="testimony-card">
              <img src="<?=ROOT?>/assets/img/Mohamed.png" class="testimony-image" alt="Mohammed from Sudan celebrates his IELTS Band 7.5 result and thanks IELTS English Tips.">
              <div class="testimony-student">
                <span class="testimony-name">Mohammed <span class="testimony-country">· Sudan</span></span>
                <span class="testimony-band">Band 7.5</span>
              </div>
            </article>
          </div>
          <div class="carousel-item">
            <article class="testimony-card">
              <img src="<?=ROOT?>/assets/img/Reem.png" class="testimony-image" alt="Reem from Sudan shares her IELTS Band 7 result and thanks her teacher for the clear lessons and useful tips.">
              <div class="testimony-student">
                <span class="testimony-name">Reem <span class="testimony-country">· Sudan</span></span>
                <span class="testimony-band">Band 7</span>
              </div>
            </article>
          </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#student-testimonials" data-bs-slide="prev" aria-label="Previous testimonial">
          <span class="testimony-arrow" aria-hidden="true"><i class="bi bi-arrow-left"></i></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#student-testimonials" data-bs-slide="next" aria-label="Next testimonial">
          <span class="testimony-arrow" aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
        </button>
      </div>

      <p class="testimony-note text-center mb-0">Use the arrows or dots to explore all four student stories.</p>
    </div>
  </section>

</main>
<!-- ----------| ./MAIN\. |---------- -->

<style>
  .testimony-section {
    overflow: hidden;
    background:
      radial-gradient(ellipse at 12% 12%, rgba(85, 120, 255, 0.1), transparent 34%),
      linear-gradient(180deg, #f8fbff 0%, #fff 100%);
  }

  .testimony-heading {
    max-width: 720px;
    margin-bottom: 38px;
  }

  .testimony-eyebrow {
    display: inline-block;
    margin-bottom: 10px;
    color: #5578ff;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
  }

  .testimony-heading h1 {
    margin-bottom: 12px;
    color: #17336a;
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 700;
  }

  .testimony-heading p {
    margin: 0;
    color: #64748b;
    font-size: 1.05rem;
  }

  .testimony-carousel {
    max-width: 980px;
    margin: 0 auto;
    padding: 18px 70px 58px;
    overflow: hidden;
    border: 1px solid rgba(85, 120, 255, 0.12);
    border-radius: 24px;
    background: rgba(255, 255, 255, 0.92);
    box-shadow: 0 24px 70px rgba(30, 55, 105, 0.12);
  }

  .testimony-card {
    overflow: hidden;
    border-radius: 16px;
    background: #fff;
  }

  .testimony-image {
    display: block;
    width: 88%;
    height: auto;
    max-height: 360px;
    margin: 0 auto;
    object-fit: contain;
  }

  .testimony-student {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding: 18px 22px 4px;
  }

  .testimony-name {
    color: #17336a;
    font-size: 1.1rem;
    font-weight: 700;
  }

  .testimony-country {
    color: #718096;
    font-size: 0.95rem;
    font-weight: 500;
  }

  .testimony-band {
    padding: 7px 13px;
    border-radius: 999px;
    background: #edf2ff;
    color: #3158d4;
    font-size: 0.9rem;
    font-weight: 700;
    white-space: nowrap;
  }

  .testimony-carousel .carousel-indicators {
    bottom: 17px;
    margin-bottom: 0;
  }

  .testimony-carousel .carousel-indicators [data-bs-target] {
    width: 9px;
    height: 9px;
    margin: 0 5px;
    border: 0;
    border-radius: 50%;
    background-color: #9aaedb;
    opacity: 0.65;
  }

  .testimony-carousel .carousel-indicators .active {
    width: 26px;
    border-radius: 10px;
    background-color: #5578ff;
    opacity: 1;
  }

  .testimony-carousel .carousel-control-prev,
  .testimony-carousel .carousel-control-next {
    width: 58px;
    opacity: 1;
  }

  .testimony-arrow {
    display: grid;
    width: 42px;
    height: 42px;
    place-items: center;
    border: 1px solid #e3eaf7;
    border-radius: 50%;
    background: #fff;
    color: #3158d4;
    box-shadow: 0 5px 16px rgba(30, 55, 105, 0.12);
    transition: background-color 0.2s ease, color 0.2s ease, transform 0.2s ease;
  }

  .testimony-carousel .carousel-control-prev:hover .testimony-arrow,
  .testimony-carousel .carousel-control-next:hover .testimony-arrow {
    transform: translateY(-1px);
    background: #5578ff;
    color: #fff;
  }

  .testimony-note {
    margin-top: 20px;
    color: #8793a7;
    font-size: 0.9rem;
  }

  @media (max-width: 575.98px) {
    .testimony-heading {
      margin-bottom: 26px;
    }

    .testimony-carousel {
      padding: 10px 38px 54px;
      border-radius: 18px;
    }

    .testimony-image {
      width: 100%;
      max-height: 260px;
    }

    .testimony-student {
      align-items: flex-start;
      flex-direction: column;
      gap: 8px;
      padding: 14px 12px 2px;
    }

    .testimony-carousel .carousel-control-prev,
    .testimony-carousel .carousel-control-next {
      width: 36px;
    }

    .testimony-arrow {
      width: 32px;
      height: 32px;
      font-size: 0.85rem;
    }
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var carouselElement = document.getElementById('student-testimonials');
    if (!carouselElement || !window.bootstrap || !window.bootstrap.Carousel) {
      return;
    }

    var carousel = window.bootstrap.Carousel.getOrCreateInstance(carouselElement, {
      interval: false,
      wrap: true
    });

    window.setInterval(function() {
      if (!carouselElement.matches(':hover') && !carouselElement.contains(document.activeElement)) {
        carousel.prev();
      }
    }, 6000);
  });
</script>

<!-- ------------- INCLUDES ------------- -->
<?php $this->view('partials/public.footer',$data) ?>