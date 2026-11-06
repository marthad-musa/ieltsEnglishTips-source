<?php $this->view('partials/public.header', $data) ?>
<?php $this->view('partials/public.navbar', $data) ?>

<main class="main community-page">
  <style>
    .community-page {
      --community-navy: #10244f;
      --community-blue: #315bd6;
      --community-gold: #f5b927;
      --community-ink: #1d2b45;
      color: var(--community-ink);
    }

    /* .community-page .breadcrumbs {
      padding: 18px 0;
      background: #f5f7fc;
    }

    .community-page .breadcrumbs ol {
      margin: 0;
    } */

    .community-intro {
      padding: 68px 0 34px;
      text-align: center;
    }

    .community-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 9px;
      margin-bottom: 15px;
      color: var(--community-blue);
      font-size: .78rem;
      font-weight: 800;
      letter-spacing: .14em;
      text-transform: uppercase;
    }

    .community-eyebrow::before,
    .community-eyebrow::after {
      width: 25px;
      height: 2px;
      background: var(--community-gold);
      content: "";
    }

    .community-intro h1 {
      max-width: 760px;
      margin: 0 auto 15px;
      color: var(--community-navy);
      font-size: clamp(2.15rem, 5vw, 3.75rem);
      font-weight: 800;
      letter-spacing: -.045em;
      line-height: 1.08;
    }

    .community-intro h1 span {
      color: var(--community-blue);
    }

    .community-intro > .container > p {
      max-width: 680px;
      margin: 0 auto;
      color: #64718a;
      font-size: 1.08rem;
      line-height: 1.75;
    }

    .community-showcase {
      padding: 22px 0 72px;
    }

    .community-showcase .container {
      max-width: 1120px;
    }

    .community-carousel {
      overflow: hidden;
      border: 1px solid rgba(16, 36, 79, .08);
      border-radius: 26px;
      background: #fff;
      box-shadow: 0 24px 70px rgba(16, 36, 79, .14);
    }

    .community-carousel .carousel-item {
      display: none;
      align-items: center;
      justify-content: center;
      height: clamp(440px, 58vw, 680px);
      padding: 20px;
      background: linear-gradient(140deg, #f8f6f0, #fff 52%, #f1f3f8);
    }

    .community-carousel .carousel-item.active,
    .community-carousel .carousel-item-next,
    .community-carousel .carousel-item-prev {
      display: flex;
    }

    .community-carousel .carousel-item img {
      display: block;
      width: auto;
      max-width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .community-carousel-control {
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

    .community-carousel-control.carousel-control-prev {
      right: auto;
      left: 18px;
    }

    .community-carousel-control.carousel-control-next {
      right: 18px;
    }

    .community-carousel-control:hover,
    .community-carousel-control:focus-visible {
      background: var(--community-blue);
    }

    .community-carousel-control:hover,
    .community-carousel-control:focus-visible {
      transform: translateY(-50%) scale(1.06);
    }

    .community-carousel-control .carousel-control-prev-icon,
    .community-carousel-control .carousel-control-next-icon {
      width: 18px;
      height: 18px;
    }

    .community-carousel-indicators {
      position: static;
      display: flex;
      justify-content: flex-start;
      gap: 10px;
      margin: 0;
      padding: 20px 24px 23px;
      background: #fff;
    }

    .community-carousel-indicators [data-bs-target] {
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

    .community-carousel-indicators [data-bs-target]:hover {
      transform: translateY(-2px);
    }

    .community-carousel-indicators [data-bs-target].active {
      border-color: var(--community-navy);
      background: var(--community-navy);
      color: #fff;
    }

    .community-pillars {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 18px;
      margin-top: 24px;
    }

    .community-pillar {
      display: flex;
      align-items: flex-start;
      gap: 14px;
      min-height: 120px;
      padding: 22px;
      border: 1px solid #edf0f6;
      border-radius: 18px;
      background: #fff;
      box-shadow: 0 10px 32px rgba(16, 36, 79, .05);
    }

    .community-pillar-icon {
      display: grid;
      flex: 0 0 42px;
      width: 42px;
      height: 42px;
      place-items: center;
      border-radius: 13px;
      background: #edf2ff;
      color: var(--community-blue);
      font-size: 1.1rem;
    }

    .community-pillar h3 {
      margin: 2px 0 6px;
      color: var(--community-navy);
      font-size: 1rem;
      font-weight: 800;
    }

    .community-pillar p {
      margin: 0;
      color: #6b778e;
      font-size: .91rem;
      line-height: 1.55;
    }

    .community-cta {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 24px;
      margin-top: 38px;
      padding: 28px clamp(22px, 4vw, 42px);
      border-radius: 20px;
      background: linear-gradient(115deg, var(--community-navy), #2449a6);
      color: #fff;
    }

    .community-cta h2 {
      margin: 0 0 6px;
      color: #fff;
      font-size: clamp(1.2rem, 2.5vw, 1.65rem);
      font-weight: 800;
    }

    .community-cta p {
      margin: 0;
      color: rgba(255, 255, 255, .78);
    }

    .community-cta .btn {
      flex: 0 0 auto;
      padding: 12px 20px;
      border: 0;
      border-radius: 999px;
      background: var(--community-gold);
      color: var(--community-navy);
      font-weight: 800;
    }

    .community-cta .btn:hover,
    .community-cta .btn:focus-visible {
      background: #ffd05a;
      color: var(--community-navy);
    }

    @media (max-width: 767.98px) {
      .community-intro {
        padding: 50px 0 24px;
      }

      .community-carousel {
        border-radius: 19px;
      }

      .community-carousel .carousel-item {
        height: 440px;
        padding: 12px;
      }

      .community-carousel-control {
        width: 40px;
        height: 40px;
      }

      .community-carousel-control.carousel-control-prev {
        left: 9px;
      }

      .community-carousel-control.carousel-control-next {
        right: 9px;
      }

      .community-carousel-indicators {
        flex-wrap: wrap;
        gap: 8px;
        padding: 16px;
      }

      .community-carousel-indicators [data-bs-target] {
        padding: 8px 11px;
        font-size: .77rem;
      }

      .community-pillars {
        grid-template-columns: 1fr;
        gap: 12px;
      }

      .community-pillar {
        min-height: auto;
      }

      .community-cta {
        align-items: flex-start;
        flex-direction: column;
      }
    }

    @media (prefers-reduced-motion: reduce) {
      .community-page *,
      .community-page *::before,
      .community-page *::after {
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
          <li class="current">Grow with our Community<br></li>
        </ol>
      </div>
    </nav>
  </div>

  <section class="community-intro" aria-labelledby="community-heading">
    <div class="container" data-aos="fade-up">
      <span class="community-eyebrow">Learn together, grow together</span>
      <h1 id="community-heading">Your IELTS journey is better <span>together.</span></h1>
      <p>Explore practical lessons, familiar examples, and shared encouragement that help you build confidence in English and move closer to your IELTS goals.</p>
    </div>
  </section>

  <section class="community-showcase" aria-label="Community learning highlights">
    <div class="container">
      <div id="communityCarousel" class="carousel slide community-carousel" data-bs-ride="carousel" data-bs-interval="7000" data-bs-pause="hover" data-bs-touch="true" aria-label="Community learning highlights carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="<?=ROOT?>/assets/img/community-yasir.jpg" alt="Yasir, a learner from France">
          </div>
          <div class="carousel-item">
            <img src="<?=ROOT?>/assets/img/community-ayat.jpg" alt="Ayat, a University of Khartoum graduate from Sudan">
          </div>
          <div class="carousel-item">
            <img src="<?=ROOT?>/assets/img/community-mazin.jpg" alt="Mazin, a learner from Canada">
          </div>
          <div class="carousel-item">
            <img src="<?=ROOT?>/assets/img/community-mobarak.jpg" alt="Mobarak, a University graduate from Sudan">
          </div>
          <div class="carousel-item">
            <img src="<?=ROOT?>/assets/img/community-omar.jpg" alt="Omar, a learner from Sudan">
          </div>
          <div class="carousel-item">
            <img src="<?=ROOT?>/assets/img/community-turkey.jpg" alt="A learner from Turkey">
          </div>
          <div class="carousel-item">
            <img src="<?=ROOT?>/assets/img/community-yan.jpg" alt="Yan, a learner from China">
          </div>
        </div>

        <button class="carousel-control-prev community-carousel-control" type="button" data-bs-target="#communityCarousel" data-bs-slide="prev" aria-label="Show previous community highlight">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next community-carousel-control" type="button" data-bs-target="#communityCarousel" data-bs-slide="next" aria-label="Show next community highlight">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>

        <div class="carousel-indicators community-carousel-indicators">
          <button type="button" data-bs-target="#communityCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Show Yasir's story">Yasir</button>
          <button type="button" data-bs-target="#communityCarousel" data-bs-slide-to="1" aria-label="Show Ayat's story">Ayat</button>
          <button type="button" data-bs-target="#communityCarousel" data-bs-slide-to="2" aria-label="Show Mazin's story">Mazin</button>
          <button type="button" data-bs-target="#communityCarousel" data-bs-slide-to="3" aria-label="Show Mobarak's story">Mobarak</button>
          <button type="button" data-bs-target="#communityCarousel" data-bs-slide-to="4" aria-label="Show Omar's story">Omar</button>
          <button type="button" data-bs-target="#communityCarousel" data-bs-slide-to="5" aria-label="Show the learner from Turkey">Turkey</button>
          <button type="button" data-bs-target="#communityCarousel" data-bs-slide-to="6" aria-label="Show Yan's story">Yan</button>
        </div>
      </div>

      <div class="community-pillars" data-aos="fade-up">
        <article class="community-pillar">
          <span class="community-pillar-icon" aria-hidden="true"><i class="bi bi-chat-dots"></i></span>
          <div>
            <h3>Practice with confidence</h3>
            <p>Build fluency and develop answers with clear, useful examples.</p>
          </div>
        </article>
        <article class="community-pillar">
          <span class="community-pillar-icon" aria-hidden="true"><i class="bi bi-lightbulb"></i></span>
          <div>
            <h3>Learn practical strategies</h3>
            <p>Focus on techniques you can apply across IELTS question types.</p>
          </div>
        </article>
        <article class="community-pillar">
          <span class="community-pillar-icon" aria-hidden="true"><i class="bi bi-people"></i></span>
          <div>
            <h3>Keep moving forward</h3>
            <p>Stay motivated with guidance that supports your learning journey.</p>
          </div>
        </article>
      </div>

      <div class="community-cta" data-aos="fade-up">
        <div>
          <h2>Ready to take your next step?</h2>
          <p>Explore lessons and resources designed to support your IELTS preparation.</p>
        </div>
        <a class="btn" href="<?=ROOT?>/courses">Explore courses <span aria-hidden="true">&rarr;</span></a>
      </div>
    </div>
  </section>
</main>

<?php $this->view('partials/public.footer',$data) ?>
