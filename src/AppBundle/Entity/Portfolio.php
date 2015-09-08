<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Colletions;
use Doctrine\Common\Collections\ArrayCollection;

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

  //protected $historical_data;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->portfolio_stocks = new ArrayCollection();
        //$this->historical_data = array();
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
    
    public function __toString()
    {
      return $this->getName();
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

    public function getPortfolioBreakdown()
    {
      $string = array();
       foreach($this->portfolio_stocks as $stock)
       {
        $string[$stock->getStock()->getTicker()] = $stock->getShares(); 
       }
      return $string;    
    }

    public function getTodaysCost()
    {
      $cost = 0;
      foreach($this->portfolio_stocks as $stock)
      {
        $cost += ($stock->getStock()->getLastPrice() * $stock->getShares());
        
      }
      return $cost;
    }

    public static function calculateCost(&$price, $key, $shares)
    {
      $price = $price * $shares;
    }

    public static function addToPortfolio(&$cost, $key, $pdata)
    {
      if(array_key_exists($key, $pdata))
      {
        $cost = $cost + $pdata[$key];
      }
    }

    public function getHistoricalData()
    {
      $pdata = array();
      foreach($this->portfolio_stocks as $stock)
      {
        //sleep(1);
        $data = $stock->getStock()->getHistoricalData();
        array_walk($data, 'self::calculateCost', $stock->getShares());
        array_walk($data, 'self::addToPortfolio', $pdata);

        $pdata = $data;
      }
   
      return $pdata;
    }
}
