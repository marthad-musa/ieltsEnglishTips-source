<form method="post">
  <div class="col-md-8 mx-auto">
    <?php csrf() ?>

    <h2 class="my-4 h5 fw-bold">Course Messages</h2>

    <!-- ---- Course Welcome Message ---- -->
    <div class="input-group mb-2">
      <span class="input-group-text">Welcome Message&colon;</span>
      <textarea name="welcome_message" class="form-control <?=!empty($errors['welcome_message']) ? 'border-danger' : '';?>" aria-label="Welcome Message:" placeholder="Add a welcome message"><?=esc($row->welcome_message)?></textarea>
      <!-- ---- Welcome Message Error ---- -->
      <small class="error error-welcome_message w-100 text-danger fontClarity"></small>
      <!-- -| ./Welcome Message Error\. |- -->
    </div>
    <!-- -| ./Course Welcome Message\. |- -->

    <!-- ---- Course Congratulations Message ---- -->
    <div class="input-group mb-2">
      <span class="input-group-text">Congratulations Message&colon;</span>
      <textarea name="congratulations_message" class="form-control <?=!empty($errors['congratulations_message']) ? 'border-danger' : '';?>" aria-label="Congratulations Message:" placeholder="Add a congratulations message"><?=esc($row->congratulations_message)?></textarea>
      <!-- ---- Congratulations Message Error ---- -->
      <small class="error error-congratulations_message w-100 text-danger fontClarity"></small>
      <!-- -| ./Congratulations Message Error\. |- -->
    </div>
    <!-- -| ./Course Congratulations Message\. |- -->
  </div>
</form>