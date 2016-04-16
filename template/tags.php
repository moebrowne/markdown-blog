<?php include "includes/head.php"; ?>
<div class="posts">
    <div class="wrapper">
    <?php
    foreach ($posts as $post) {
        include('post/summary.php');
    }
    ?>
    </div>
</div>
<?php include "includes/tags.php"; ?>
<?php include "includes/foot.php"; ?>