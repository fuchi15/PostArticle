<?php

namespace Plugin\PostArticle\Repository;

use Doctrine\ORM\EntityRepository;
use Plugin\PostArticle\Entity\PostArticle;

class PostArticleRepository extends EntityRepository
{
    public function getList()
    {
        $query = $this->createQueryBuilder('p')
            ->getQuery();

        $articles = $query->getResult();
        return $articles;
    }

    public function getArticle($id)
    {
        $repository = $this->find($id);;
        return $repository;
    }

    public function save(PostArticle $postarticle)
    {
        $this->_em->persist($postarticle);
        $this->_em->flush($postarticle);

        return true;
    }
}