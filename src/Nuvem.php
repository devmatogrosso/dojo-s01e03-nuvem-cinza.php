<?php

namespace App;

class Nuvem {

	private $map;
	private $daysElapsed = 1;

	public function __construct($mapInitial)
	{
		$this->map = $mapInitial;
		$this->mapInitial = $mapInitial;
	}

	public function getDaysElapsed()
	{
		return $this->daysElapsed;
	}

	public function getActualMap()
	{
		return $this->map;
	}

	public function getCoveredAirports(){

		$covered = array();

		foreach ($this->map as $x => $row)
		{
			foreach ($row as $y => $col)
			{
				if($col == "*" && $this->mapInitial[$x][$y] == "A"){
					$covered[] = (object)array("x"=>$x, "y"=>$y);
				}
			}
		}

		return $covered;

	}
	
	public function advanceDay()
	{
		$nextMap = $this->map;

		foreach ($this->map as $x => $row)
		{
			foreach ($row as $y => $col)
			{
				if ($col == '*')
				{
					if ($x < count($row) - 1)
					{
						$nextMap[$x + 1][$y] = '*';
					}

					if ($x > 0)
					{
					   $nextMap[$x - 1][$y] = '*';
					}

					if ($y < count($nextMap) - 1)
					{ 
						$nextMap[$x][$y + 1] = '*';
					}

					if ($y > 0)
					{
						$nextMap[$x][$y - 1] = '*';
					}
				}
			}
		}

		$this->daysElapsed++;
		$this->map = $nextMap;
	}
}