<div class="posts">
    <div class="wrapper">
    <?php
    foreach ($posts as $post) {
        echo $post;
    }
    ?>
    <?php include "template/pagination.php"; ?>
    </div>
</div>