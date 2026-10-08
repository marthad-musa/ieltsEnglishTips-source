<?php $this->view('partials/public.header', $data); ?>
<?php $this->view('partials/public.navbar', $data); ?>

<main class="main cms-page">
  <?php if (!empty($is_preview)): ?>
    <div class="alert alert-info text-center m-0" role="status">Draft preview - this page is not public.</div>
  <?php endif; ?>

  <?php $this->view('partials/cms-blocks', $data); ?>
</main>

<?php $this->view('partials/public.footer', $data); ?>
