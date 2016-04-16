<article itemid="<?= $post->getURI(); ?>" class="post" itemprop='blogPost' itemscope itemtype="http://schema.org/BlogPosting">
    <meta itemprop="wordcount" content="<?= $post->getWordCount(); ?>">
    <meta itemprop="datePublished" content="<?= date('c', $post->getMeta()->date); ?>">
    <meta itemprop="dateModified" content="<?= date('c', $post->getMeta()->date); ?>">
    <div itemprop="author" itemscope itemtype="http://schema.org/Person">
        <meta itemprop="name" content="MoeBrowne">
    </div>
    <meta itemprop="mainEntityOfPage" content="<?= $post->getURI(); ?>">
    <?php if ($post->hasBannerImage()) : ?>
        <a href="<?= $post->getURI(); ?>" itemprop="url">
            <div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
                <img itemprop="url" src="<?= $post->getBannerImage(); ?>">
                <meta itemprop="representativeOfPage" content="true">
                <meta itemprop="contentSize" content="<?= round(filesize($post->getBannerFilePath())/1024, 1); ?>KB">
                <meta itemprop="width" content="<?= $post->getBannerWidth(); ?>px">
                <meta itemprop="height" content="<?= $post->getBannerHeight(); ?>px">
            </div>
        </a>
    <?php endif; ?>

    <div class="content">
        <header>
            <time datetime="<?= date('c', $post->getMeta()->date); ?>" itemprop="dateCreated">
                <a href="<?= $post->getURI(); ?>" itemprop="url">
                    <?= date('d-m-y', $post->getMeta()->date); ?>
                </a>
            </time>
            <h1 class="title" itemprop="headline">
                <a href="<?= $post->getURI(); ?>" itemprop="url">
                    <?= $post->getMeta()->title; ?>
                </a>
            </h1>
        </header>
        <div itemprop="<?= $post->hasMoreToRead() ? 'description':'articleBody'; ?>">
            <?= $post->getAbstract(); ?>
        </div>
        <footer>
            <div class="tags">
                <?php foreach ($post->getMeta()->tags as $tagName) : ?>
                    <a href="/tags/<?= str_replace(' ', '-', $tagName); ?>" class="tag">
                        <?= $tagName; ?>
                    </a>
                <?php endforeach; ?>
                <meta itemprop="keywords" content="<?= implode(',', $post->getMeta()->tags); ?>"/>
            </div>
            <?php if ($post->hasMoreToRead()) : ?>
            <div>
                <a href="<?= $post->getURI(); ?>" class="more">Read More</a>
            </div>
            <?php endif; ?>
        </footer>
    </div>
</article>