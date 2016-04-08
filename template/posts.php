<?php include "includes/head.html"; ?>
<div class="posts">
    <div class="wrapper">
    <?php
    foreach ($posts as $post) {
        include('post/summary.php');
    }
    ?>
    <?php include "pagination.php"; ?>
    </div>
</div>
<?php include "tags.php"; ?>
<?php include "includes/foot.html"; ?>