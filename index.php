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

    // Check if we are filtering for a specific tag
    // and if so drop posts that don't have the requested tag
    if (empty($_GET['tag']) === false) {
        if (in_array($_GET['tag'], $post->getMeta()->tags) === false) {
            continue;
        }
    }

    ob_start();
    include 'template/post/summary.php';
    $posts[$post->getMeta()->date] = ob_get_clean();
}

// Sort tags by name
ksort($tags, SORT_NATURAL);

// Sort posts by date order
krsort($posts, SORT_NUMERIC);

$pageLength = 5;
$pageCount = ceil(count($posts)/$pageLength);
$pageCurrent = $_GET['page'];

$posts = array_slice($posts, $pageCurrent*$pageLength, $pageLength);

// Display the page
include "template/head.html";
include "template/posts.php";
include "template/tags.php";
include "template/foot.html";
