<?php require_once APP_ROOT . '/src/Views/Include/AdminInclude/header.php'; ?>

    <div class="card mx-auto my-3 maxWidth992">
        <div class="card-header font-weight-bold text-uppercase">
            Update Task
        </div>
        <div class="card-body">
            <div class="row mt-2">
                <div class="col-sm-3">User Mail</div>
                <div class="col-sm-9"><?= $data['task']['email'] ?></div>
            </div>
            <div class="row pt-4">
                <div class="col-sm-3">User Name</div>
                <div class="col-sm-9"><?= $data['task']['user_name'] ?></div>
            </div>
            <form id="task-update" class="pt-4" data-ajax="false" enctype="multipart/form-data">
                <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                <input type="hidden" name="id" value="<?= $data['task']['id']; ?>">
                <div class="form-group row">
                    <label for="body" class="col-sm-3 col-form-label">Text</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="body" id="body" rows="13" required><?= str_replace('&', '&amp;', $data['task']['body']) ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="checked" class="col-sm-3 form-check-label">Checked</label>
                    <div class="col-sm-9">
                        <input type="hidden" name="checked" value="0" />
                        <input type="checkbox" name="checked" <?php if( $data['task']['checked'] == "1") echo "checked='checked'"; ?> value="1" />
                    </div>
                </div>
            </form>
            <div class="text-right">
                <a class="btn btn-secondary text-light update-button" id="task-update-submit">Update</a>
            </div>
        </div>
    </div>
<?php require_once APP_ROOT . '/src/Views/Include/AdminInclude/footer.php'; ?>
