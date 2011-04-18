<?php
class MountainPeak
{
	/**
	 * @var int
	 */
	public $id;
	
	/**
	 * @var string
	 */
	public $name;
		
	
	/**
	 * @var int
	 */
	public $elevation;
	
	/**
	 * @var float
	 */
	public $latitude;
	
	/**
	 * @var float
	 */
	public $longitude;
	
	/**
	 * @var int
	 */
	public $prominence;
	
	/**
	 * @var string
	 */
	public $range_name;
	
	/**
	 * @var string
	 */
	public $state;
	
	/**
	 * @var DateTime
	 */
	public $first_ascent;
	
	/**
	 * @var string
	 */
	public $wa_bulger_list;
	
	public function __construct()
	{
		$this->id = 0;
		$this->name = "";
		$this->elevation = 0;
		$this->latitude = 0.0;
		$this->longitude = 0.0;
		$this->prominence = 0;
		$this->range_name = "";
		$this->state = "";
		$this->first_ascent = date(c);
		$this->wa_bulger_list = false;	
	}
}
?>