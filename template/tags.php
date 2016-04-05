<aside class="tags">
    <?php foreach ($tags as $name => $count) : ?>
        <a class="tag" data-count="<?= $count; ?>" href="/tags/<?= $name; ?>"><?= $name; ?></a>
    <?php endforeach; ?>
</aside>