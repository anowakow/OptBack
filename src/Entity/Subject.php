<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubjectRepository")
 * @ORM\Table(name="Subject")
 */
class Subject 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;    
    
    /** 
     * @ORM\Column(type="string") 
     */
    protected $name;
    
    /** 
     * @ORM\Column(type="string") 
     */
    protected $description;

    /** 
     * @ORM\Column(type="string") 
     */
    protected $icon;

    /** 
     * @ORM\Column(type="boolean") 
     */
    protected $active;

    /** 
     * @ORM\Column(type="boolean") 
     */
    protected $demo;
/*
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
*/
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    public function isDemo()
    {
        return $this->demo;
    }

    public function setDemo($demo)
    {
        $this->demo = $demo;
    }

    public function isActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }
}