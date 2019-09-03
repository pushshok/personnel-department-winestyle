<?php
require_once "connect.php";
require_once 'models/select-workers.php';
$workers = getWorkers();
?>

<?php foreach ($workers as $worker): ?>

    <div class="row">
        <div class="col-md-2">
            <?= $worker['id'] . "<br>"; ?>
            <?= $worker['name'] . "<br>"; ?>
            <?= $worker['last_name'] . "<br>"; ?>
            <?= ucfirst(getPosition($worker['position_id'])) . "<br>"; ?>
        </div>
    </div>
<?php endforeach; ?>
