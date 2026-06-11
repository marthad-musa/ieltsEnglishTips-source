<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="main">
  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto">
          <div class="card card-body bg-light mt-5">
            <h2>Add Course</h2>
            <p>Create a new course with category and price</p>
            <form action="<?php echo URLROOT; ?>/manage_courses/add" method="post">
              <div class="form-group mb-3">
                <label for="title">Title: <sup>*</sup></label>
                <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
                <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
              </div>
              
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="category">Category: <sup>*</sup></label>
                  <select name="category" class="form-control form-control-lg <?php echo (!empty($data['category_err'])) ? 'is-invalid' : ''; ?>">
                    <option value="">Select Category</option>
                    <option value="IELTS">IELTS</option>
                    <option value="Headway English">Headway English</option>
                    <option value="ICDL">ICDL</option>
                    <option value="Other">Other</option>
                  </select>
                  <span class="invalid-feedback"><?php echo $data['category_err']; ?></span>
                </div>
                <div class="col-md-6">
                  <label for="price">Price (EGP): <sup>*</sup></label>
                  <input type="number" step="0.01" name="price" class="form-control form-control-lg <?php echo (!empty($data['price_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['price']; ?>">
                  <span class="invalid-feedback"><?php echo $data['price_err']; ?></span>
                </div>
              </div>

              <div class="form-group mb-3">
                <label for="description">Description:</label>
                <textarea name="description" class="form-control form-control-lg" rows="5"><?php echo $data['description']; ?></textarea>
              </div>

              <div class="row">
                <div class="col">
                  <input type="submit" value="Add Course" class="btn btn-primary btn-block">
                </div>
                <div class="col text-end">
                  <a href="<?php echo URLROOT; ?>/manage_courses" class="btn btn-light btn-block">Back</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>
