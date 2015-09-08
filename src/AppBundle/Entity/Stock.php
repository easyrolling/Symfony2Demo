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
      $quotes = array();
      $client = new \Scheb\YahooFinanceApi\ApiClient();
      try
      {
        sleep(0.8);
        $hist_data1 = $client->getHistoricalData($this->ticker, new \DateTime("-1 year"), new \DateTime("-1 day"));
        sleep(0.8);
        $hist_data2 = $client->getHistoricalData($this->ticker, new \DateTime("-2 years"), new \DateTime("-1 year"));
        $data1 = $hist_data1['query']['results']['quote'];
        $data2 = $hist_data2['query']['results']['quote'];
        $data = array_merge($data1, $data2);
        foreach($data as $datum)
        { 
          $quotes[strtotime($datum['Date'])*1000] = round($datum['Close'], 2);
        }
      }
      catch(Exception $e)
      {
        echo $e->getMessage();
      }
      return $quotes;
    } 
}
