<?php
class Building 
{
	public static $static_var = 100;  //acces to it: Building::$static_var

	const ABOUT = 'рукотворное строение пригодное к экспулатации';

	public $name = "";
	//intelect - 
	public $knowlege = 0; //how educated builder has to be.
	//money
	public $cost = 0;
	//materials needed to build
	public $wood = 0;
	public $stone = 0;
	public $metal = 0;
	public $concrete = 0;
	//time to build
	public $time_build = 10; //in seconds
	//instruments to build
	public $instruments = null; //TODO array

	public $capacity = 0; //how many people can contain
	public $population = 0; //how many people in it

	public $features = 0; //flamable, radiation, biohazard etc.

	function build_hut() {
		$this->name = "хижина";

	}

	public function Building($name) {
		if($name == 'хижина') {
			$this->name = "хижина";
			$this->knowlege = 1;
			$this->wood = 5;
			$this->capacity = 5;
			$this->time_build = 10;
			$this->features = 'flamable';

		}
	}
}
?>