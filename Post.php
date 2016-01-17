<?php namespace markdownBlog\Post;

use Exception;
use Parsedown;

class Post
{

    private $name;

    private $meta;
    private $metaPath;
    private $metaExists;

    private $markdown;
    private $markdownPath;
    private $markdownHash;
    private $markdownExists;

    private $HTML;

    /**
     * Post constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = str_replace(' ', '-', $name);

        $this->markdownPath = 'posts/'.$this->getName().'/content.md';
        $this->markdownExists = file_exists($this->markdownPath);

        $this->metaPath = 'posts/'.$this->getName().'/meta.json';
        $this->metaExists = file_exists($this->metaPath);
    }

    private function getMarkdownHash()
    {
        if ($this->markdownExists === false) {
            throw new Exception('Can\'t hash the markdown as it doesn\'t exist');
        }

        if (empty($this->markdownHash) === true) {
            $this->markdownHash = md5_file($this->markdownPath);
        }

        return $this->markdownHash;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the posts markdown
     *
     * @return string
     */
    private function getMarkdown()
    {
        if (empty($this->markdown) === true && $this->markdownExists === true) {
            $this->markdown = file_get_contents($this->markdownPath);
        }

        return $this->markdown;
    }

    /**
     * Get the posts meta data
     *
     * @return object
     */
    public function getMeta()
    {
        if (empty($this->meta) === true && $this->metaExists === true) {
            $this->meta = json_decode(file_get_contents('posts/'.$this->getName().'.json'));
        }

        return $this->meta;
    }

    public function isCached()
    {
        return file_exists('cache/'.$this->getMarkdownHash().'.html');
    }

    private function writeCache($content)
    {
        return file_put_contents('cache/'.$this->getMarkdownHash().'.html', $content);
    }

    private function getCache()
    {
        if ($this->isCached() === false) {
            return false;
        }

        return file_get_contents('cache/'.$this->getMarkdownHash().'.html');
    }

    /**
     * Get the HTML content of this post
     *
     * @param bool|false $fresh Whether or not to load from the cache
     * @return string
     */
    public function getHTML($fresh = false)
    {
        if (empty($this->HTML) === true) {

            if ($this->isCached() && $fresh !== true) {
                $this->HTML = $this->getCache();
            } else {
                $this->HTML = $this->generateHTML();
                $this->writeCache($this->getHTML());
            }

        }

        return $this->HTML;
    }

    /**
     * Generate the HTML for this post
     *
     * @return string
     */
    private function generateHTML()
    {
        $parsedown = new Parsedown();

        return $parsedown->parse($this->getMarkdown());
    }
}
