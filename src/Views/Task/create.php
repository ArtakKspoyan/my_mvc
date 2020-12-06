<?php require_once APP_ROOT . '/src/Views/Include/header.php'; ?>

    <div class="card mx-auto my-3 maxWidth992">
        <div class="card-header font-weight-bold text-uppercase">
            Create Task
        </div>
        <div class="card-body">
            <form id="task-create" data-ajax="false" enctype="multipart/form-data">
                <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Your Mail</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="user_name" class="col-sm-3 col-form-label">Your Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="user_name" id="user_name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="body" class="col-sm-3 col-form-label">Text</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="body" id="body" rows="13" required></textarea>
                    </div>
                </div>
            </form>
            <div class="text-right">
                <a class="btn btn-secondary text-light form-button" id="task-create-submit">Create</a>
            </div>
        </div>
    </div>
<?php require_once APP_ROOT . '/src/Views/Include/footer.php'; ?>
