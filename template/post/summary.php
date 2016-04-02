<article class="post" itemscope="" itemtype="http://schema.org/blogPosting">
    <?php if ($post->getMeta()->images[0] !== null) : ?>
        <img src="<?= $post->getMeta()->images[0]; ?>">
    <?php endif; ?>

    <div class="content">
        <header>
            <time datetime="<?= date('c', $post->getMeta()->date); ?>" itemprop="dateCreated">
                <a href="<?= $post->getURL(); ?>" itemprop="url"><?= date('d-m-y', $post->getMeta()->date); ?></a>
            </time>
            <h1 class="title" itemprop="name">
                <a href="<?= $post->getURL(); ?>" itemprop="url"><?= $post->getMeta()->title; ?></a>
            </h1>
        </header>
        <div>
            <?= $post->getAbstract(); ?>
        </div>
        <footer>
            <div>
                <a href="<?= $post->getURL(); ?>" class="more">Read More</a>
            </div>
        </footer>
    </div>
</article>