<?php
include_once('MountainPeak.php');

class PeaksService
{
	
	protected $host = "localhost:8889";
	protected $username = "root";
	protected $password = "root";
	protected $db = "php_demos";
	

	protected function connect()
	{
		mysql_connect($this->host,$this->username,$this->password)
		or die ("Unable to connect to database.");
		
		mysql_select_db($this->db)
		or die ("Unable to select database.");
	}
	
	/**
	 * 
	 * Get every peak in the database
	 * 
	 */
	public function getAllPeaks()
	{
		$this->connect();
		$rs = mysql_query("select * from peaks_location")
		or die ("Unable to complete query.");
		
		$arr_peaks = array();
		
		while( $row = mysql_fetch_assoc($rs) )
		{
			$peak = new MountainPeak();
			$peak->id = $row['id']+0;
			$peak->name = $row['name'];
			$peak->elevation = $row['elevation']+0;
			$peak->latitude = $row['latitude']+0.0;
			$peak->longitude = $row['longitude']+0.0;
			$peak->prominence = $row['prominence']+0;
			$peak->range_name = $row['range_name'];
			$peak->state = $row['state'];
			$peak->first_ascent = $row['first_ascent'];
			
			array_push($arr_peaks,$peak);
		}
		
		return $arr_peaks;
	}


	public function getDistinctRanges()
	{
		$this->connect();
		$rs = mysql_query("select distinct range_name from peaks_location")
		or die ("Unable to complete query");
		
		$arr_ranges = array();
		
		while ($row = mysql_fetch_array($rs))
		{
			array_push($arr_ranges,$row);
		}
		
		return $arr_ranges;
	}

	public function getDistinctStates()
	{
		$this->connect();
		$rs = mysql_query("select distinct state from peaks_location")
		or die ("Unable to complete query");
		
		$arr_states = array();
		
		while ($row = mysql_fetch_array($rs))
		{
			array_push($arr_states,$row);
		}
		
		return $arr_states;
	}
	
	/*****
	 * Update a Peak
	 */
	public function updateForest($peak)
	{
		$this->connect();
		$query = sprintf("update peaks_location set 
				name = '%s', elevation = '%s', latitude = '%s', longitude = '%s', prominence = '%s', range_name = '%s', state = '%s', first_ascent = '%s'
				where id = '%s' ",
				mysql_real_escape_string($peak->name),
				mysql_real_escape_string($peak->elevation),
				mysql_real_escape_string($peak->latitude),
				mysql_real_escape_string($peak->longitude),
				mysql_real_escape_string($peak->prominence),
				mysql_real_escape_string($peak->range_name),
				mysql_real_escape_string($peak->state),
				mysql_real_escape_string($peak->first_ascent),
				mysql_real_escape_string($peak->id));
		$rs = mysql_query($query)
		or die ("Unable to complete query.");
		
		return $peak;
	}
		
}

?>