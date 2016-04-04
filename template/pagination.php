<div class="pagination">
    <?php if(($pageCurrent+1) < $pageCount) : ?>
        <a href="?page=<?= $pageCurrent+1; ?>" class="next">Next &raquo;</a>
    <?php endif; ?>
    <?php if($pageCurrent > 0) : ?>
        <a href="?page=<?= $pageCurrent-1; ?>" class="prev">&laquo; Prev</a>
    <?php endif; ?>
</div>