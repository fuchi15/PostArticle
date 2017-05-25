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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PostArticleConfigType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

    }

    public function getName()
    {
        return 'postarticle_config';
    }

}
