<?php

use markdownBlog\Post;

error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', true);

require 'vendor/autoload.php';
require 'Post.php';

$postPaths = glob('posts/*', GLOB_ONLYDIR);
$postTags = [];

foreach ($postPaths as $postPath) {

    $postName = str_replace('posts/', '', $postPath);

    $post = new Post($postName);

    // Add this posts tags to the tag array
    foreach ($post->getMeta()->tags as $tag) {
        $postTags[$tag]++;
    }


    echo "<h1>".$post->getMeta()->title."</h1>";
    echo "<time datetime='".date('c', $post->getMeta()->date)."'>".date('d/m/Y H:i', $post->getMeta()->date)."</time>";
}
