<?php

/*
 * This file is part of the PostArticle
 *
 * Copyright (C) 2017 fuchi
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\PostArticle\ServiceProvider;

use Monolog\Handler\FingersCrossed\ErrorLevelActivationStrategy;
use Monolog\Handler\FingersCrossedHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Plugin\PostArticle\Form\Type\PostArticleConfigType;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;

class PostArticleServiceProvider implements ServiceProviderInterface
{

    public function register(BaseApplication $app)
    {
        // プラグイン用設定画面
        $app->match('/'.$app['config']['admin_route'].'/plugin/PostArticle/config', 'Plugin\PostArticle\Controller\ConfigController::index')->bind('plugin_PostArticle_config');

        $app['postarticle.repository.postarticle'] = $app->share(function () use ($app) {
            return $app['orm.em']->getRepository('Plugin\PostArticle\Entity\PostArticle');
        });

        // 独自コントローラ
        $app->match('/postarticle/list', 'Plugin\PostArticle\Controller\PostArticleController::index')->bind('PostArticle_list');
        $app->match('/postarticle/detail/{id}','Plugin\PostArticle\Controller\PostArticleController::detail')->assert('id', '\d+')->bind('PostArticle_detail');
        $app->match('/' . $app["config"]["admin_route"]  . '/plugin/PostArticle/index', '\Plugin\PostArticle\Controller\PostArticleAdminController::index')->bind('PostArticle_index');
        $app->match('/' . $app["config"]["admin_route"]  . '/plugin/PostArticle/store', '\Plugin\PostArticle\Controller\PostArticleAdminController::store')->bind('PostArticle_store');
        // Form
        $app['form.types'] = $app->share($app->extend('form.types', function ($types) use ($app) {
            $types[] = new PostArticleConfigType();
            return $types;
        }));

        // Repository

        // Service

        // 管理メニュー
        $app['config'] = $app->share($app->extend('config', function ($config) {
            $head = array_slice($config['nav'], 0, 4);
            $tail = array_slice($config['nav'], 4);
            $append = array(array(
                'id' => 'postArticle',
                'name' => '記事の投稿',
                'has_child' => 'true',
                'child' => array(
                    array(
                        'id' => 'postArticle_index',
                        'name' => '新規登録',
                        'url' => 'postArticle_index'
                    ),
                )
            ));
            $config['nav'] = array_merge($head, $append, $tail);
            return $config;
        }));


    }

    public function boot(BaseApplication $app)
    {
    }

}
