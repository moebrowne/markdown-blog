<div class="pagination">
    <?php if(($pageSet+1) < $pageCount) : ?>
        <a href="<?= $paginationLinkNext; ?>" class="next" rel="next">Next &raquo;</a>
    <?php endif; ?>
    <?php if($pageSet > 0) : ?>
        <a href="<?= $paginationLinkPrev; ?>" class="prev" rel="prev">&laquo; Prev</a>
    <?php endif; ?>
</div>