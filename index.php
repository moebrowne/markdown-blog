<?php

use markdownBlog\Post;

require 'vendor/autoload.php';
require 'ParsedownExtension.php';
require 'Post.php';

$postPaths = glob('posts/*', GLOB_ONLYDIR);
$tags = [];
$postArray = [];
$HTMLPage = [];
$assets = [];

foreach ($postPaths as $postPath) {

    $postName = str_replace('posts/', '', $postPath);

    $post = new Post($postName);

    $postArray[$post->getMeta()->date] = $post;
}

// Sort posts by date order
krsort($postArray, SORT_NUMERIC);

// Extract all the tags from the posts
foreach ($postArray as $post) {
    // Add this post to the tag array
    foreach ($post->getMeta()->tags as $tag) {
        $tags[$tag][] = $post;
    }
}

// Sort tags by name
ksort($tags, SORT_NATURAL);

$pageLength = 5;
$pageCount = ceil(count($postArray)/$pageLength);

// Generate each of the page sets
for ($pageSet = 0; $pageSet < $pageCount; $pageSet++) {

    // Get the posts for this page
    $posts = array_slice($postArray, $pageSet*$pageLength, $pageLength);
    $pageURI = ($pageSet === 0) ? '/index':'/page/' . $pageSet;

    // Determine the links to the previous and next pages
    $paginationLinkPrev = ($pageSet-1 === 0) ?  '/index.html':'/page/' . ($pageSet-1) . '.html';
    $paginationLinkNext = '/page/' . ($pageSet+1) . '.html';

    ob_start();
    include "template/posts.php";
    $HTMLPage[$pageURI] = ob_get_clean();

}

// Generate the post pages
foreach ($postArray as $postDate => $post) {

    $pageURI = $post->getURI().'/index';
    $pageAssetsURI = $post->getURI().'/images';

    ob_start();
    include "template/post/full.php";
    $HTMLPage[$pageURI] = ob_get_clean();

    if ($post->hasBannerImage()) {
        $assets[$pageAssetsURI . '/banner.jpg'] = $post->getBannerFilePath();
    }
}

// Generate the tag index pages
foreach ($tags as $tag => $posts) {

    $pageURI = '/tags/'.str_replace(' ', '-', $tag).'/index';

    ob_start();
    include "template/tags.php";
    $HTMLPage[$pageURI] = ob_get_clean();
}

// Write the HTML to files
foreach ($HTMLPage as $URI => $HTML) {

    $filePath = './docroot' . $URI . '.html';
    $fileDirectory = dirname($filePath);

    if (is_dir($fileDirectory) === false) {
        mkdir($fileDirectory, 0755, true);
    }

    echo 'WRITING '.mb_strlen($HTML).' bytes to: '.$filePath.PHP_EOL;

    file_put_contents($filePath, $HTML);
}

foreach ($assets as $URI => $assetPath) {
    $assetsPath = './docroot' . $URI;
    $assetsDirectory = dirname($assetsPath);

    if (is_dir($assetsDirectory) === false) {
        mkdir($assetsDirectory, 0755, true);
    }

    copy($assetPath, $assetsPath);
    echo $assetPath.' => '.$assetsPath.PHP_EOL;
}
