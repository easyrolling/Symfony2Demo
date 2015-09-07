<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Stock
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
	protected $ticker;

	
	/**
     	 * @ORM\Column(type="string")
     	 */
	protected $name;

  protected $client;

    public function __construct()
    {
      $this->client = new \Scheb\YahooFinanceApi\ApiClient();
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
      return $this->getTicker();
    }
    /**
     * Set ticker
     *
     * @param string $ticker
     * @return Stock
     */
    public function setTicker($ticker)
    {
        $this->ticker = $ticker;

        return $this;
    }

    /**
     * Get ticker
     *
     * @return string 
     */
    public function getTicker()
    {
        return $this->ticker;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Stock
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

    public function getLastPrice()
    {
      $client = new \Scheb\YahooFinanceApi\ApiClient();
      
      $data = $client->getQuotesList($this->ticker);

      //print_r($data);
      return $data['query']['results']['quote']['LastTradePriceOnly'];
    }

    public function getHistoricalData()
    {
      $client = new \Scheb\YahooFinanceApi\ApiClient();
      $end_date = new \DateTime();
      $start_date = new \DateTime("-2 days");
      //echo $end_date->format("Y-m-d");
      //$hist_data = $client->getHistoricalData($this->ticker, $start_date, $end_date);
      //print_r($hist_data);
    } 
}
