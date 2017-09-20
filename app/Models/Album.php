<?php
namespace App\Models;
use Yuga\Models\ElegantModel as Elegant;
class Album extends Elegant
{
	protected $table_name = "album";
	protected static $massAssign = true;
	public function user()
	{
		return $this->belongsTo("User");
	}
	public function photos($id = 0)
	{
		if($id){
		}else{
			return $this->hasMany("Photograph");
		}

	}

	public function date()
	{
        return datetime_to_text($this->created_at);
    }
}