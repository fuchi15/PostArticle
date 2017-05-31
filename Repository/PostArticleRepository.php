<?php

namespace Plugin\PostArticle\Repository;

use Doctrine\ORM\EntityRepository;


class PostArticleRepository extends EntityRepository
{
    public function getList(){
        $query = $this->createQueryBuilder('p')
            ->getQuery();

        $articles = $query->getResult();
        return $articles;
    }

    public function getArticle($id){
        $repository = $this->find($id);;
        return $repository;
    }
}