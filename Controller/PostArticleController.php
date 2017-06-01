<?php

/*
 * This file is part of the PostArticle
 *
 * Copyright (C) 2017 fuchi
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\PostArticle\Controller;


use Eccube\Application;

use Symfony\Component\HttpFoundation\Request;
use Plugin\PostArticle\Entity\PostArticle;
use Plugin\PostArticle\Entity;


class PostArticleController
{
    public function index(Application $app, Request $request)
    {
        $articles = $app['postarticle.repository.postarticle']->getList();

        return $app->render('PostArticle/Resource/template/list.twig', array(
            // add parameter...
            'hello' => 'List',
            'Articles' => $articles
        ));
    }

    public function detail(Application $app, Request $request, $id)
    {
        $article = $app['postarticle.repository.postarticle']->getArticle($id);
        // $content = html_entity_decode($article["content"],ENT_QUOTES);
        // $content = htmlspecialchars($aritlce["content"]);
        
        $content = $article["content"];
        
        // $content = strip_tags($content);
       
        return $app->render('PostArticle/Resource/template/detail.twig', array(
            // add parameter...
            'hello' => 'Detail',
            'article' => $article,
            'content' => $content
        ));
    }
}