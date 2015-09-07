<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class User
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
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
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
}
