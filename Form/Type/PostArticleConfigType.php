<?php

/*
 * This file is part of the PostArticle
 *
 * Copyright (C) 2017 fuchi
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\PostArticle\Form\Type;

use Eccube\Application\ApplicationTrait;
use Plugin\PostArticle\Entity\PostArticle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Validator\Constraints as Assert;


class PostArticleConfigType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text')
            ->add('content', 'textarea', array('required'=> false, 'attr' => array('class' => 'tinymce')))
            ->add('author', 'integer')
            ->add('save','submit');
    }

    public function getName()
    {
        return 'postarticle_config';
    }

}
