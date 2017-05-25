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

class PostArticleController
{

    /**
     * PostArticle画面
     *
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Application $app, Request $request)
    {

        return $app->render('PostArticle/Resource/template/admin/index.twig', array(
            // add parameter...
            'hello' => 'Hello_World',
        ));
    }
    public function store(Application $app, Request $request)
    {
        dump($request);
        return $app->render('PostArticle/Resource/template/admin/index.twig', array(
            // add parameter...
            'hello' => 'bay',
        ));
    }

}
