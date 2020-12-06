<?php
use App\Helper;
use App\UserInfo;

require_once APP_ROOT . '/src/Views/Include/header.php';

$counter = 0;
$page = 1;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

$slug = '';
foreach ($data['tasks'] as $task) {
    if ($counter >= ($page - 1) * 3 && $counter < $page * 3) {
        ?>
        <div class="row">
            <div class="col-12 px-0 border-bottom border-dark pb-2 bg1">
                <small class="text-secondary border-left border-right border-secondary px-2 position-absolute rotate90 topRightOuter">📅 <?= date("Y/m/d H:i", strtotime($task['updated_at'])); ?></small>
                <a href="<?= URL_ROOT . '/task/' . $task['slug']; ?>" class="text-body"><h3
                            class="display-5 text-center mx-5"><?= $task['user_name']; ?></h3></a>
                <div class="media">
                    <div class="media-body">
                        <hr class="mb-1 mt-0 ml-2 mr-2 mr-sm-5">
                        <p class="my-4 ml-2 mr-2 mr-sm-5"><?= $task['email']; ?>...</p>
                        <a href="<?= URL_ROOT . '/task/' . $task['slug']; ?>"
                           class="text-dark border border-dark rounded-pill px-2 pr-0 m-2 linkButton">Read More 〉</a>
                        <h6 class="float-sm-right mt-2 mt-sm-0 mx-2">
                            <p class="my-4 ml-2 mr-2 mr-sm-5 text-success">
                                <?php if( $task['checked'] == "1"){ echo "checked 😊";}else{ echo 'no checked 😞';} ?></p>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    $counter++;
}
?>
<nav aria-label="Page navigation" class="custom-pagination mt-3">
    <ul class="pagination justify-content-center">
        <li class="page-item <?php if ($page == 1) echo 'disabled'; ?>">
            <a class="page-link" href="<?= URL_ROOT . '/task?page=' . ($page - 1) ?>"
               tabindex="-1" <?php if ($page == 1) echo 'aria-disabled="true"'; ?>>Previous</a>
        </li>
        <?php
        for ($i = max(1, $page - 2); $i <= floor(count($data['tasks']) / 3) + 1; $i++) {
            if ($i == $page) echo '<li class="page-item active" aria-current="page"><a class="page-link">' .
                $i . '</a></li>';
            else echo '<li class="page-item"><a class="page-link" href="' . URL_ROOT . '/task?page=' . $i . '">' . $i . '</a></li>';
        }
        ?>
        <li class="page-item <?php if ($page * 3 > count($data['tasks'])) echo 'disabled'; ?>">
            <a class="page-link"
               href="<?= URL_ROOT . '/task?page=' . ($page + 1) ?>" <?php if ($page * 3 > count($data['tasks']))
                echo 'aria-disabled="true"'; ?>>Next</a>
        </li>
    </ul>
</nav>
<?php require_once APP_ROOT . '/src/Views/Include/footer.php'; ?>
