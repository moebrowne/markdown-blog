<?php

use markdownBlog\Post;

error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', true);

require 'vendor/autoload.php';
require 'Post.php';

$postPaths = glob('posts/*', GLOB_ONLYDIR);
$tags = [];

foreach ($postPaths as $postPath) {

    $postName = str_replace('posts/', '', $postPath);

    $post = new Post($postName);

    // Add this posts tags to the tag array
    foreach ($post->getMeta()->tags as $tag) {
        $tags[$tag]++;
    }

    ob_start();
    include 'template/post/summary.php';
    $posts[$post->getMeta()->date] = ob_get_clean();
}


// Sort by date order
krsort($posts, SORT_NUMERIC);

// Display the page
include "template/head.html";

foreach ($posts as $post) {
    echo $post;
}

include "template/tags.php";
include "template/foot.html";
