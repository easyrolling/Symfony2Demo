<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class PortfolioStock
{
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue
   */
  protected $id;

  /**
   * @ORM\ManyToOne(targetEntity="Stock")
   */
  protected $stock;

  /**
   * @ORM\ManyToOne(targetEntity="Portfolio")
   */
  protected $portfolio;

  /**
   * @ORM\Column(type="datetime")
   */
  protected $createdAt;


  /**
   * @ORM\Column(type="integer")
   */
  protected $shares;


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
     * Set stock
     *
     * @param \AppBundle\Entity\Stock $stock
     * @return PortfolioStock
     */
    public function setStock(\AppBundle\Entity\Stock $stock = null)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return \AppBundle\Entity\Stock 
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set portfolio
     *
     * @param \AppBundle\Entity\Portfolio $portfolio
     * @return PortfolioStock
     */
    public function setPortfolio(\AppBundle\Entity\Portfolio $portfolio = null)
    {
        $this->portfolio = $portfolio;

        return $this;
    }

    /**
     * Get portfolio
     *
     * @return \AppBundle\Entity\Portfolio 
     */
    public function getPortfolio()
    {
        return $this->portfolio;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PortfolioStock
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set shares
     *
     * @param integer $shares
     * @return PortfolioStock
     */
    public function setShares($shares)
    {
        $this->shares = $shares;

        return $this;
    }

    /**
     * Get shares
     *
     * @return integer 
     */
    public function getShares()
    {
        return $this->shares;
    }
}
