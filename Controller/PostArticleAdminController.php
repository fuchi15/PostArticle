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
use Plugin\PostArticle\Entity;


class PostArticleAdminController extends AbstractController
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
        $hello = 'Hello';

        $form = $app['form.factory']->createBuilder('postarticle_config')->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $content = $data["content"];
            $content = str_replace('\"', 'b', $content);
  
            $article = new PostArticle();
            $article->setTitle($data['title']);
            $article->setContent($data['content']);
            $article->setAuthor(2);
            $em = $app['orm.em'];
            $em->persist($article);
            $em->flush();

            $hello = 'Complate';
        }
        return $app->render('PostArticle/Resource/template/admin/index.twig', array(
            // add parameter...
            'hello' => $hello,
            'form' => $form->createView(),
        ));
    }

    public function list(Application $app, Request $request)
    {
        $articles = $app['postarticle.repository.postarticle']->getList();

        return $app->render('PostArticle/Resource/template/admin/list.twig', array(
            // add parameter...
            'hello' => 'Admin List',
            'articles' => $articles
        ));
    }

    public function edit(Application $app, Request $request, $id)
    {
        $article = $app['postarticle.repository.postarticle']->getArticle($id);

        // $postedDate = $article->getCreateDate();

        $form = $app['form.factory']->createBuilder('postarticle_config',$article)->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $app['postarticle.repository.postarticle']->save($article);
        }
        return $app->render('PostArticle/Resource/template/admin/edit.twig', array(
            // add parameter...
            'hello' => 'Admin edit',
            'form' => $form->createView(),
            'article' => $article
        ));
    }
}
