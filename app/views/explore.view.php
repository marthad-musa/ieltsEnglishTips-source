<?php $this->view('partials/public.header', $data) ?>
<?php $this->view('partials/public.navbar', $data) ?>

<main class="main explore-page">
  <style>
    .explore-page {
      --explore-navy: #10244f;
      --explore-blue: #315bd6;
      --explore-gold: #f5b927;
      --explore-ink: #1d2b45;
      color: var(--explore-ink);
    }

    /* .explore-page .breadcrumbs {
      padding: 18px 0;
      background: #f5f7fc;
    }

    .explore-page .breadcrumbs ol {
      margin: 0;
    } */

    .explore-intro {
      padding: 62px 0 30px;
      text-align: center;
    }

    .explore-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 9px;
      margin-bottom: 15px;
      color: var(--explore-blue);
      font-size: .78rem;
      font-weight: 800;
      letter-spacing: .14em;
      text-transform: uppercase;
    }

    .explore-eyebrow::before,
    .explore-eyebrow::after {
      width: 25px;
      height: 2px;
      background: var(--explore-gold);
      content: "";
    }

    .explore-intro h1 {
      max-width: 760px;
      margin: 0 auto 15px;
      color: var(--explore-navy);
      font-size: clamp(2.15rem, 5vw, 3.75rem);
      font-weight: 800;
      letter-spacing: -.045em;
      line-height: 1.08;
    }

    .explore-intro h1 span {
      color: var(--explore-blue);
    }

    .explore-intro p {
      max-width: 700px;
      margin: 0 auto;
      color: #64718a;
      font-size: 1.08rem;
      line-height: 1.75;
    }

    .explore-showcase {
      padding: 20px 0 72px;
    }

    .explore-showcase > .container {
      max-width: 1120px;
    }

    .explore-carousel {
      overflow: hidden;
      border: 1px solid rgba(16, 36, 79, .08);
      border-radius: 26px;
      background: #fff;
      box-shadow: 0 24px 70px rgba(16, 36, 79, .14);
    }

    .explore-carousel .carousel-item {
      display: none;
      align-items: center;
      justify-content: center;
      height: clamp(480px, 62vw, 700px);
      padding: 20px;
      background: linear-gradient(140deg, #f8f6f0, #fff 52%, #f1f3f8);
    }

    .explore-carousel .carousel-item.active,
    .explore-carousel .carousel-item-next,
    .explore-carousel .carousel-item-prev {
      display: flex;
    }

    .explore-carousel .carousel-item img {
      display: block;
      width: auto;
      max-width: 100%;
      height: 100%;
      object-fit: contain;
      border-radius: 12px;
    }

    .explore-carousel-control {
      top: 50%;
      bottom: auto;
      width: 48px;
      height: 48px;
      border: 1px solid rgba(16, 36, 79, .2);
      border-radius: 50%;
      background: rgba(16, 36, 79, .78);
      opacity: 1;
      transform: translateY(-50%);
    }

    .explore-carousel-control.carousel-control-prev {
      right: auto;
      left: 18px;
    }

    .explore-carousel-control.carousel-control-next {
      right: 18px;
    }

    .explore-carousel-control:hover,
    .explore-carousel-control:focus-visible {
      background: var(--explore-blue);
      transform: translateY(-50%) scale(1.06);
    }

    .explore-carousel-control .carousel-control-prev-icon,
    .explore-carousel-control .carousel-control-next-icon {
      width: 18px;
      height: 18px;
    }

    .explore-carousel-indicators {
      position: static;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 10px;
      margin: 0;
      padding: 20px 24px 23px;
      background: #fff;
    }

    .explore-carousel-indicators [data-bs-target] {
      width: auto;
      height: auto;
      margin: 0;
      padding: 10px 15px;
      border: 1px solid #e6eaf2;
      border-radius: 999px;
      background: #f7f8fb;
      color: #596780;
      font-size: .84rem;
      font-weight: 700;
      text-indent: 0;
      opacity: 1;
      transition: color .2s ease, background .2s ease, border-color .2s ease, transform .2s ease;
    }

    .explore-carousel-indicators [data-bs-target]:hover {
      transform: translateY(-2px);
    }

    .explore-carousel-indicators [data-bs-target].active {
      border-color: var(--explore-navy);
      background: var(--explore-navy);
      color: #fff;
    }

    .explore-note {
      max-width: 820px;
      margin: 24px auto 0;
      color: #64718a;
      font-size: .95rem;
      line-height: 1.7;
      text-align: center;
    }

    @media (max-width: 767.98px) {
      .explore-intro {
        padding: 48px 0 24px;
      }

      .explore-carousel {
        border-radius: 19px;
      }

      .explore-carousel .carousel-item {
        height: 480px;
        padding: 12px;
      }

      .explore-carousel-control {
        width: 40px;
        height: 40px;
      }

      .explore-carousel-control.carousel-control-prev {
        left: 9px;
      }

      .explore-carousel-control.carousel-control-next {
        right: 9px;
      }

      .explore-carousel-indicators {
        gap: 8px;
        padding: 16px;
      }

      .explore-carousel-indicators [data-bs-target] {
        padding: 8px 11px;
        font-size: .77rem;
      }
    }

    @media (prefers-reduced-motion: reduce) {
      .explore-page *,
      .explore-page *::before,
      .explore-page *::after {
        scroll-behavior: auto !important;
        transition-duration: .01ms !important;
      }
    }
  </style>

  <div class="page-title" data-aos="fade">
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="<?=ROOT?>">Home</a></li>
          <li class="">Events</li>
          <li class="current">Explore our success<br></li>
        </ol>
      </div>
    </nav>
  </div>

  <section class="explore-intro" aria-labelledby="explore-heading">
    <div class="container" data-aos="fade-up">
      <span class="explore-eyebrow">Real progress, real encouragement</span>
      <h1 id="explore-heading">Explore our learners’ <span>success stories.</span></h1>
      <p>Every learner has a different starting point. Browse their stories and see how focused practice and supportive guidance can help build confidence for IELTS Speaking.</p>
    </div>
  </section>

  <section class="explore-showcase" aria-label="Learner success story carousel">
    <div class="container">
      <div id="exploreCarousel" class="carousel slide explore-carousel" data-bs-ride="carousel" data-bs-interval="7000" data-bs-pause="hover" data-bs-touch="true" aria-label="IELTS learner success stories">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="<?=ROOT?>/assets/img/explore-ali.jpg" alt="Ali from Sudan shares his IELTS Speaking progress and experience">
          </div>
          <div class="carousel-item">
            <img src="<?=ROOT?>/assets/img/explore-chidi.jpeg" alt="Chidi from Nigeria shares a testimonial about IELTS Speaking">
          </div>
          <div class="carousel-item">
            <img src="<?=ROOT?>/assets/img/explore-khalid.jpg" alt="Khalid from Sudan shares his IELTS Speaking learning experience">
          </div>
          <div class="carousel-item">
            <img src="<?=ROOT?>/assets/img/explore-khalil.jpg" alt="Khalil from Sudan shares his IELTS preparation testimonial">
          </div>
          <div class="carousel-item">
            <img src="<?=ROOT?>/assets/img/explore-mazin.jpeg" alt="Mazin from Canada shares his IELTS Speaking learning experience">
          </div>
          <div class="carousel-item">
            <img src="<?=ROOT?>/assets/img/explore-nawal.jpg" alt="Nawal from Sudan shares her IELTS Speaking learning experience">
          </div>
        </div>

        <button class="carousel-control-prev explore-carousel-control" type="button" data-bs-target="#exploreCarousel" data-bs-slide="prev" aria-label="Show previous success story">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next explore-carousel-control" type="button" data-bs-target="#exploreCarousel" data-bs-slide="next" aria-label="Show next success story">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>

        <div class="carousel-indicators explore-carousel-indicators">
          <button type="button" data-bs-target="#exploreCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Show Ali's story">Ali</button>
          <button type="button" data-bs-target="#exploreCarousel" data-bs-slide-to="1" aria-label="Show Chidi's story">Chidi</button>
          <button type="button" data-bs-target="#exploreCarousel" data-bs-slide-to="2" aria-label="Show Khalid's story">Khalid</button>
          <button type="button" data-bs-target="#exploreCarousel" data-bs-slide-to="3" aria-label="Show Khalil's story">Khalil</button>
          <button type="button" data-bs-target="#exploreCarousel" data-bs-slide-to="4" aria-label="Show Mazin's story">Mazin</button>
          <button type="button" data-bs-target="#exploreCarousel" data-bs-slide-to="5" aria-label="Show Nawal's story">Nawal</button>
        </div>
      </div>

      <p class="explore-note" data-aos="fade-up">These stories reflect individual learner experiences. Results vary depending on each student’s starting level, study time, and preparation.</p>
    </div>
  </section>
</main>

<?php $this->view('partials/public.footer',$data) ?>
