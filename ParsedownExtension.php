<?php namespace MardownBlog\Parsedown;

use Parsedown;

class ParsedownExtension extends Parsedown
{
    protected function blockFencedCode($Line)
    {
        $Block = parent::blockFencedCode($Line);

        $Block['element']['attributes']['class'] = 'line-numbers';

        return $Block;
    }
}