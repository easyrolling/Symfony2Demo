<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Entity
 */
class User implements UserInterface, \Serializable
{
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue
   */
  protected $id;
  
  /**
   * @ORM\Column(type="string")
   */
  protected $username;
  
  /**
   * @ORM\Column(type="string")
   */
  protected $password;
  
  /**
   * @ORM\OneToMany(targetEntity="Portfolio", mappedBy="user")
   */ 
  protected $portfolios;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->portfolios = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __toString()
    {
      return $this->getUsername();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Add portfolios
     *
     * @param \AppBundle\Entity\Portfolio $portfolios
     * @return User
     */
    public function addPortfolio(\AppBundle\Entity\Portfolio $portfolios)
    {
        $this->portfolios[] = $portfolios;

        return $this;
    }

    /**
     * Remove portfolios
     *
     * @param \AppBundle\Entity\Portfolio $portfolios
     */
    public function removePortfolio(\AppBundle\Entity\Portfolio $portfolios)
    {
        $this->portfolios->removeElement($portfolios);
    }

    /**
     * Get portfolios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPortfolios()
    {
        return $this->portfolios;
    }

    public function getRoles()
    {
      return array('ROLE_USER');
    }
    
    public function getSalt()
    {
      return null;
    }

    public function eraseCredentials()
    {

    }

    public function serialize()
    {

      return serialize(array($this->id, $this->username, $this->password));
    }

    public function unserialize($serialized)
    {

      list($this->id, $this->username, $this->password) = unserialize($serialized);
    }
}
