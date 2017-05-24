<?php

namespace Plugin\PostArticle;

use Eccube\Event\EventArgs;
use Plugin\PostArticle\Entity\PostArticle;

class PostArticleEvent
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }
}