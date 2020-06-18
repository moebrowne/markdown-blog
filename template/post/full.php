<?php include __DIR__."/../includes/head.php"; ?>
    <div class="posts">
        <div class="wrapper">
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
                            <?php list($bannerImageWidth, $bannerImageHeight) = getimagesize($post->getBannerFilePath()); ?>
                            <img itemprop="url" src="<?= $post->getBannerImage(); ?>" width="<?= $bannerImageWidth ?>" height="<?= $bannerImageHeight ?>" loading="lazy">
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
                    <div itemprop="articleBody">
                        <?= $post->getHTML(); ?>
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
                    </footer>
                </div>
            </article>        </div>
    </div>
<?php include __DIR__."/../includes/tags.php"; ?>
<?php include __DIR__."/../includes/foot.php"; ?>