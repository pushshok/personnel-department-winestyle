<?php

require_once 'models/select-workers.php';
$id = isset($_GET['id']) ? $_GET['id'] : "0";
$worker = getWorker($id);

?>

<?php if ($id != 0): ?>
    <div class="container">
            <div class="col-md-3 worker">
                <?= $worker['id'] . "<br>"; ?>
                <?= $worker['name'] . "<br>"; ?>
                <?= $worker['last_name'] . "<br>"; ?>
                Должность: <?=getPosition($worker['position_id']) . "<br>"; ?>
            </div>
    </div>
<a href="/">В отдел персонала</a>
<?php else: ?>
Не выбрано ни одного сотрудника<br>
<?php endif; ?>