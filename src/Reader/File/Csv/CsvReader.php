<?php

namespace OpsWay\Migration\Reader\File\Csv;

use OpsWay\Migration\Reader\ReaderInterface;

use OpsWay\Migration\Writer\File\OutOfStockLogger;

class CsvReader implements ReaderInterface {
	
	private $filename = 'data/export.csv';
	private $stockLogger;
	
	public function __construct(){
		$this->stockLogger = new OutOfStockLogger();
	}
	
	  public function read()
    {
        if (($handle = fopen($this->filename, "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$this->stockLogger->write($data);
		}
		fclose($handle);
    }
}
}