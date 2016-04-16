<div class="pagination">
    <?php if(($pageSet+1) < $pageCount) : ?>
        <a href="<?= $paginationLinkNext; ?>" class="next">Next &raquo;</a>
    <?php endif; ?>
    <?php if($pageSet > 0) : ?>
        <a href="<?= $paginationLinkPrev; ?>" class="prev">&laquo; Prev</a>
    <?php endif; ?>
</div>