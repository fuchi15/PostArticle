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

        // 独自コントローラ
        $app->match('/plugin/postarticle/hello', 'Plugin\PostArticle\Controller\PostArticleController::index')->bind('plugin_PostArticle_hello');
        $app->match('/' . $app["config"]["admin_route"]  . '/plugin/PostArticle/post', '\Plugin\PostArticle\Controller\PostArticleController::index')->bind('postArticle_addPost');

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
                        'id' => 'postArticle_addpost',
                        'name' => '新規登録',
                        'url' => 'postArticle_addPost'
                    ),
                )
            ));
            $config['nav'] = array_merge($head, $append, $tail);
            return $config;
        }));
        // メッセージ登録
        // $file = __DIR__ . '/../Resource/locale/message.' . $app['locale'] . '.yml';
        // $app['translator']->addResource('yaml', $file, $app['locale']);

        // load config
        // プラグイン独自の定数はconfig.ymlの「const」パラメータに対して定義し、$app['postarticleconfig']['定数名']で利用可能
        // if (isset($app['config']['PostArticle']['const'])) {
        //     $config = $app['config'];
        //     $app['postarticleconfig'] = $app->share(function () use ($config) {
        //         return $config['PostArticle']['const'];
        //     });
        // }

        // ログファイル設定
        $app['monolog.logger.postarticle'] = $app->share(function ($app) {

            $logger = new $app['monolog.logger.class']('postarticle');

            $filename = $app['config']['root_dir'].'/app/log/postarticle.log';
            $RotateHandler = new RotatingFileHandler($filename, $app['config']['log']['max_files'], Logger::INFO);
            $RotateHandler->setFilenameFormat(
                'postarticle_{date}',
                'Y-m-d'
            );

            $logger->pushHandler(
                new FingersCrossedHandler(
                    $RotateHandler,
                    new ErrorLevelActivationStrategy(Logger::ERROR),
                    0,
                    true,
                    true,
                    Logger::INFO
                )
            );

            return $logger;
        });

    }

    public function boot(BaseApplication $app)
    {
    }

}
