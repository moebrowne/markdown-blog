<aside class="tags">
    <?php foreach ($tags as $name => $posts) : ?>
        <a class="tag" data-count="<?= count($posts); ?>" href="/tags/<?= str_replace(' ', '-', $name); ?>">
            <?= $name; ?>
        </a>
    <?php endforeach; ?>
</aside>