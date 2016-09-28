<?php

class DateTimeParagraph {

	public $show;

	private function addLeadingZero($value){
		return ($value < 10) ? "0" . $value : $value;
	}

	public function __construct()
	{
		$date = getdate();

		foreach ($date as $key => $value) {
			$$key = $value;
		}

		$hours = $this->addLeadingZero($hours);
		$minutes = $this->addLeadingZero($minutes);
		$seconds = $this->addLeadingZero($seconds);

		$mday = date("jS");

		$this->show = "<p>{$weekday}, the {$mday} of {$month} {$year}, The time is {$hours}:{$minutes}:{$seconds}</p>";
	}
}
