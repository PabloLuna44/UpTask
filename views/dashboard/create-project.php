<?php
require_once __DIR__ . '/header-dashboard.php';
?>

<div class="container-sm">

    <?php
    require_once __DIR__ . '/../templates/alerts.php';
    ?>

    <form class="form" method="POST">

        <?php
        require_once __DIR__ . '/form-project.php';
        ?>

        <input type="submit" value="Create Project">

    </form>


    <?php
    require_once __DIR__ . '/footer-dashboard.php';
    ?>