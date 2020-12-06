<?php require_once APP_ROOT . '/src/Views/Include/header.php'; ?>

<?php
$slug = '';
foreach ($data['tasks'] as $task) {
        ?>
    <div class="col-4 border pb-2 bg3 home" >
        <a href="<?= URL_ROOT . '/task/' . $task['slug']; ?>" class="text-body"><h2
                    class=" text-center mx-2 my-3"><?= $task['user_name']; ?></h2></a>
        <div class="media">
            <div class="media-body">
                <hr class="mb-1 mt-0">
                <p class="mb-2"><?= $task['email']; ?>... <small
                            class="text-secondary border-left border-right border-secondary px-2">📅 <?= date("Y/m/d H:i", strtotime($task['updated_at'])); ?></small>
                </p>
                <a href="<?= URL_ROOT . '/task/' . $task['slug']; ?>"
                   class="text-dark border border-dark rounded-pill px-2 pr-0 mt-2 linkButton">Read More 〉</a>
                <h6 class="float-sm-right mt-1">
                    <p class="my-4 ml-2 mr-2 mr-sm-5 text-success">
                        <?php if( $task['checked'] == "1"){ echo "checked 😊";}else{ echo 'no checked 😞';} ?></p></h6>
            </div>
        </div>
    </div>
    <?php
}
?>
<?php require_once APP_ROOT . '/src/Views/Include/footer.php'; ?>
