<?php

namespace Plugin\PostArticle\Entity;

class PostArticle extends \Eccube\Entity\AbstractEntity
{
    private $id;
    private $post_data;
    private $post_title;
    private $post_content;
    private $post_status;
    private $post_author;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getPostData()
    {
        return $this->post_data;
    }

    public function setPostData($post_data)
    {
        $this->post_data = $post_data;

        return $this;
    }

    public function getPostTitle()
    {
        return $this->post_title;
    }

    public function setPostTitle($post_title)
    {
        $this->post_title = $post_title;

        return $this;
    }

    public function getPostContent()
    {
        return $this->post_content;
    }

    public function setPostContent($content)
    {
        $this->post_content = $content;

        return $this;
    }

    public function getPostStatus()
    {
        return $this->post_status;
    }

    public function setPostStatus($post_status)
    {
        $this->post_status = $post_status;

        return $this;
    }

    public function getPostAuthor()
    {
        return $this->post_author;
    }

    public function setPostAuthor($post_author)
    {
        $this->post_author = $post_author;

        return $this;
    }
}