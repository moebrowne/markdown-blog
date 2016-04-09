<div class="pagination">
    <?php if(($pageSet+1) < $pageCount) : ?>
        <a href="/page/<?= $pageSet+1; ?>.html" class="next">Next &raquo;</a>
    <?php endif; ?>
    <?php if($pageSet > 0) : ?>
        <a href="/page/<?= $pageSet-1; ?>.html" class="prev">&laquo; Prev</a>
    <?php endif; ?>
</div>