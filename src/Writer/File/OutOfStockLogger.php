<?php

namespace OpsWay\Migration\Writer\File;

use OpsWay\Migration\Writer\WriterInterface;

class OutOfStockLogger implements WriterInterface
{

    protected $file;
    protected $filename;
	
	
    public function __construct()
    {   
	    $this->filename = 'data/output.log.csv';
        $this->checkFileName();
    }
	
    public function write(array $item)
    {		
		if (!$this->file) {
            if (!($this->file = fopen($this->filename, 'w+'))) {
                throw new \RuntimeException(sprintf('Can not create file "%s" for writing data.', $this->filename));
            }
			return fputcsv($this->file,$item,',');
        }
		
		if($item[3]==0 && $item[4]==0){
			return	fputcsv($this->file,$item,',');
		}
		
    }

    public function __destruct()
    {
        if ($this->file) {
            fclose($this->file);
        }
    }

    private function checkFileName()
    {
        if (file_exists($this->filename)) {
            throw new \RuntimeException(sprintf('File "%s" already exists. Remove it and run again.', $this->filename));
        }
    }











}
