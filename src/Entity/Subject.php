<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
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
}