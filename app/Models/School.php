<?php
namespace App\Models;
use Yuga\Models\ElegantModel as Elegant;
class School extends Elegant
{
	protected $table_name = "school";
	protected static $massAssign = true;
	
	public function user()
	{
		return $this->belongsTo("User");
	}
}