<?php require_once APP_ROOT . '/src/Views/Include/header.php'; ?>
    <div class="row">
        <div class="col-12 bg-light px-0">
            <h3 class="display-5 text-center mx-4"><?= $data['task']['user_name']; ?></h3>
            <small class="text-secondary border-left border-right border-secondary mx-2 px-2">
                📅 <?= date("Y/m/d H:i", strtotime($data['task']['updated_at'])); ?></small>
            <h6 class="float-right mt-2 mx-2">
                <p class="my-4 ml-2 mr-2 mr-sm-5 text-success">
                    <?php if( $data['task']['checked'] == "1"){ echo "checked 😊";}else{ echo 'no checked 😞';} ?></p>
                <span class="badge badge-secondary mr-2"><?= $data['task']['email']; ?></span>
            </h6>
              <h6 class="mt-2 mx-2"><?= $data['task']['body'];?></h6>
        </div>
    </div>
<?php require_once APP_ROOT . '/src/Views/Include/footer.php'; ?>
