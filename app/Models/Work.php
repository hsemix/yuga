<?php
namespace App\Models;
use Yuga\Models\ElegantModel as Elegant;
class Work extends Elegant
{
	protected $table_name = "work";
	protected static $massAssign = true;
	
	public function user()
	{
		return $this->belongsTo("User");
	}
}