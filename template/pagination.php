<div class="pagination">
    <?php if(($pageCurrent+1) < $pageCount) : ?>
        <a href="?<?= http_build_query([ 'page'  => $pageCurrent+1 ] + $_GET) ?>" class="next">Next &raquo;</a>
    <?php endif; ?>
    <?php if($pageCurrent > 0) : ?>
        <a href="?<?= http_build_query([ 'page'  => $pageCurrent-1 ] + $_GET) ?>" class="prev">&laquo; Prev</a>
    <?php endif; ?>
</div>