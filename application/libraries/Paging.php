<?php

/**
 * Paging Class
 *
 * @package		Jogjamedicom
 * @subpackage	Libraries
 * @category	Paging
 * @author		Punto Aji <punto@jogjamedia.co.id>
 * @link		http://www.jogjamedia.co.id
 */

class Paging{
	public $page;
	public $per_page;
	public $num_rows;
	public $num_page;
	public $offset;
	public $prev;
	public $next;
	public $start_link;
	public $end_link;

	public $c_start_link;
	public $c_end_link;
	
	function __construct($props=array()){
		if (count($props) > 0)
			$this->init($props);
	}
	
	function init($input=array()){
		
		if(isset($input['page'])) 		$this->page     = $input['page'];
		if(isset($input['per_page'])) 	$this->per_page = $input['per_page'];
		if(isset($input['num_rows']))	$this->num_rows = $input['num_rows'];
		
		//Sanitizing Input
		if((int)$this->page<1) $this->page=1;
		if((int)$this->per_page<1) $this->per_page=20;
		if((int)$this->num_rows<1) $my_num_rows=1;
			else $my_num_rows = (int)$this->num_rows;
		
		$o=($my_num_rows-1)/$this->per_page;
		$this->num_page=(int)$o+1;
		
		$o=($this->page-1)*$this->per_page;
		$this->offset=(int)$o;
		
		$this->prev=$this->page-1;
		$this->next=$this->page+1;
		if($this->next>$this->num_page) $this->next=0;
		
		//Create Paging Link
		if($this->page < 10){
			$start=1;
			if($this->num_page > 10)
				$end=10;
			else $end=$this->num_page;
		}
		else if($this->page > $this->num_page-10){
			$start=$this->num_page-10;
			$end=$this->num_page; 
		}
		else{
			$start=$this->page-4;
			$end=$this->page+5; 
		}
		$this->c_start_link=$start;
		$this->c_end_link=$end;

		$this->v_start_page=$this->offset+1;
		$this->v_end_page=$this->v_start_page + $this->per_page - 1;

		$this->start_link=1;
		$this->end_link=$this->num_page;

		$this->per_page=$this->per_page;
	}	
}

?>