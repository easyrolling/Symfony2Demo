<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */
class Stock
{
	/*
	 * @ORM/Id
	 * @ORM/GeneratedValue
	 * @ORM/Column(type="integer")
	 */
	private $id;

	/*
	 * @ORM\Column(type="string")
	 */
	private $ticker;

	/*
         * @ORM\Column(type="string")
         */
	private $name;
	

	public function __construct()
	{
		
	}

}
