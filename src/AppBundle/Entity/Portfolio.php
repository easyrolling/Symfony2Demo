<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Colletions;
/**
 * @ORM\Entity
 */
class Portfolio
{
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue
   */
  protected $id;

  /**
   * @ORM\ManyToOne(targetEntity="User")
   */
  protected $user;

  /**
   * @ORM\Column(type="string")
   */
  protected $name;

  /**
   * @ORM\OneToMany(targetEntity="PortfolioStock", mappedBy="portfolio")
   */
  protected $portfolio_stocks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->portfolio_stocks = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Portfolio
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return Portfolio
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add portfolio_stocks
     *
     * @param \AppBundle\Entity\PortfolioStock $portfolioStocks
     * @return Portfolio
     */
    public function addPortfolioStock(\AppBundle\Entity\PortfolioStock $portfolioStocks)
    {
        $this->portfolio_stocks[] = $portfolioStocks;

        return $this;
    }

    /**
     * Remove portfolio_stocks
     *
     * @param \AppBundle\Entity\PortfolioStock $portfolioStocks
     */
    public function removePortfolioStock(\AppBundle\Entity\PortfolioStock $portfolioStocks)
    {
        $this->portfolio_stocks->removeElement($portfolioStocks);
    }

    /**
     * Get portfolio_stocks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPortfolioStocks()
    {
        return $this->portfolio_stocks;
    }
}
