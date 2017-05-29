<?php

namespace Plugin\PostArticle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Eccube\Entity\Customer;
use Eccube\Util\EntityUtil;

class PostArticle extends \Eccube\Entity\AbstractEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    private $post_title;
    private $post_content;
    private $created_at;

    public function __construct()
    {
        $this->created_at = new DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

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

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

}