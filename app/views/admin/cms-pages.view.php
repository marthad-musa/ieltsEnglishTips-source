<?php
$h = function ($value) {
  return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
};
$this->view('partials/private.header', $data);
?>
<?php $this->view('partials/private.nav', $data); ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Page Builder</h1>
    <nav><ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/dashboard">Dashboard</a></li>
      <li class="breadcrumb-item active">CMS Pages</li>
    </ol></nav>
  </div>

  <?php if (!empty($schema_error)): ?>
    <div class="alert alert-warning" role="alert"><?=$h($schema_error)?></div>
  <?php else: ?>
    <section class="section">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="mb-0">Create and manage published pages and mapped public routes.</p>
        <a class="btn btn-primary" href="<?=ROOT?>/admin/cms-pages/new"><i class="bi bi-plus-lg"></i> New page</a>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-middle">
              <thead><tr><th>Title</th><th>Slug</th><th>Route mapping</th><th>Status</th><th>Updated</th><th>Actions</th></tr></thead>
              <tbody>
                <?php foreach (($pages ?? []) as $cms_page): ?>
                  <tr>
                    <td><?=$h($cms_page->title)?></td>
                    <td><code><?=$h($cms_page->slug)?></code></td>
                    <td><?=$h($cms_page->route_key ?: 'None')?></td>
                    <td><span class="badge <?=($cms_page->status === 'published' ? 'bg-success' : 'bg-secondary')?>"><?=$h(ucfirst($cms_page->status))?></span></td>
                    <td><?=$h($cms_page->updated_at ?? '')?></td>
                    <td class="text-nowrap">
                      <a class="btn btn-sm btn-outline-primary" href="<?=ROOT?>/admin/cms-pages/<?=$h((string)$cms_page->id)?>">Edit</a>
                      <a class="btn btn-sm btn-outline-secondary" target="_blank" rel="noopener" href="<?=ROOT?>/admin/cms-preview/<?=$h((string)$cms_page->id)?>">Preview</a>
                      <?php if ($cms_page->status === 'published'): ?>
                        <form class="d-inline" method="post" action="<?=ROOT?>/admin/cms-pages/unpublish/<?=$h((string)$cms_page->id)?>">
                          <input type="hidden" name="csrf_code" value="<?=$h($csrf_code)?>">
                          <button class="btn btn-sm btn-outline-warning" type="submit">Unpublish</button>
                        </form>
                        <a class="btn btn-sm btn-outline-success" target="_blank" rel="noopener" href="<?=ROOT?>/<?=$h($cms_page->route_key ?: 'page/' . $cms_page->slug)?>">View</a>
                      <?php else: ?>
                        <form class="d-inline" method="post" action="<?=ROOT?>/admin/cms-pages/publish/<?=$h((string)$cms_page->id)?>">
                          <input type="hidden" name="csrf_code" value="<?=$h($csrf_code)?>">
                          <button class="btn btn-sm btn-success" type="submit">Publish</button>
                        </form>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
                <?php if (empty($pages)): ?><tr><td colspan="6" class="text-center text-muted">No CMS pages yet.</td></tr><?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>
</main>

<?php $this->view('partials/private.footer', $data); ?>
