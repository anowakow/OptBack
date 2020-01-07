<?php
namespace App\Entity;use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;    
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @ORM\Column(name="name", type="string", length=255,nullable=true)
     */
    protected $name;

    /**
     * @ORM\Column(name="surname", type="string", length=255,nullable=true)
     */
    protected $surname;

     /**
     * @ORM\Column(name="phone", type="string", length=255,nullable=true)
     */
    protected $phoneNumber;


    /**
     *  @return String
     */
    public function getName()
    {
        return $this->name;
    }

     /**
     * @param String $name
     */
    public function setName($name)
    {
        $this->name=$name;
    }

     /**
     * @return String
     */
    public function getSurname()
    {
        return $this->surname;
    }

     /**
     * @param String $surname
     */
    public function setSurname($surname)
    {
        $this->surname=$surname;
    }

     /**
     * @return String
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

     /**
     * @param String $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber=$phoneNumber;
    }



}