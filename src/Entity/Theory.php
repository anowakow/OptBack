<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Theory")
 */
class Theory
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;    
    
    /** 
     * @ORM\Column(type="text") 
     */
    protected $content;
    
    /** 
     * @ORM\Column(type="integer") 
     */
    protected $order;

   
    /**
     * @ORM\ManyToOne(targetEntity="Course")
     */
    protected $course;

     /** 
     * @ORM\Column(type="boolean") 
     */
    protected $active;

    public function getId()
    {
        return $this->id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getTopic()
    {
        return $this->content;
    }

    public function setTopic($topic)
    {
        $this->topic = $topic;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->course = $active;
    }
}