<?php require_once APP_ROOT . '/src/Views/Include/header.php'; ?>

<div class="card mx-auto my-3 maxWidth992">
    <div class="card-header font-weight-bold text-uppercase">
        Update Task
    </div>
    <div class="card-body">
        <div class="row mt-2">
            <div class="col-sm-3">Your Mail</div>
            <div class="col-sm-9"><?= $data['task']['email'] ?></div>
        </div>
        <div class="row pt-4 ">
            <div class="col-sm-3">Your Name</div>
            <div class="col-sm-9"><?= $data['task']['user_name'] ?></div>
        </div>
            <form id="task-update" data-ajax="false" enctype="multipart/form-data">
                <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                <input type="hidden" name="id" value="<?= $data['task']['id']; ?>">
                <div class="form-group row p-2">
                    <label for="body" class="col-sm-3 col-form-label">Text</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="body" id="body" rows="13" required><?= str_replace('&', '&amp;', $data['task']['body']) ?></textarea>
                    </div>
                </div>
            </form>
            <div class="text-right">
                <a class="btn btn-secondary text-light form-button" id="task-update-submit">Update</a>
                <a class="btn btn-danger text-light form-delete-button" id="<?= $data['task']['slug'] ?>">Delete</a>
            </div>
        </div>
    </div>
<?php require_once APP_ROOT . '/src/Views/Include/footer.php'; ?>
