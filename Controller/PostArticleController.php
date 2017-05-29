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
use Eccube\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Plugin\PostArticle\Entity\PostArticle;
use Plugin\PayJp\Entity;


class PostArticleController extends AbstractController
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

        $form = $app['form.factory']->createBuilder('postarticle_config')->getForm();

        return $app->render('PostArticle/Resource/template/admin/index.twig', array(
            // add parameter...
            'hello' => 'Hello_World',
            'form' => $form->createView(),
        ));
    }
    public function store(Application $app, Request $request)
    {

        $form = $app['form.factory']->createBuilder('postarticle_config')->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $article = new PostArticle();

            $article->setPostTitle($data['title']);
            $article->setPostContent($data['content']);
//            dump($article);
            $em = $app['orm.em'];
            $em->persist($article);
            $em->flush();


        }
        return $app->render('PostArticle/Resource/template/admin/index.twig', array(
            // add parameter...
            'hello' => 'bay',
            'form' => $form->createView(),
        ));
    }

}
