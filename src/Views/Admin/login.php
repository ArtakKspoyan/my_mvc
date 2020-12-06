<?php require_once APP_ROOT . '/src/Views/Include/AdminInclude/header.php'; ?>

<div class="card mx-auto my-3 maxWidth576">
    <div class="card-header font-weight-bold text-uppercase">
        Login
    </div>
    <div class="card-body">
        <form id="login" data-ajax="false">

            <div class="form-group row">
                <label for="log" class="col-sm-4 col-form-label">Login</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="login" id="log">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-4 col-form-label">Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
            </div>
        </form>
        <div class="text-right">
            <a class="btn btn-secondary text-light admin-button" id="admin-submit">Login</a>
        </div>
    </div>
</div>
<?php require_once APP_ROOT . '/src/Views/Include/AdminInclude/footer.php'; ?>
