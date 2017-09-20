<?php
namespace App\Models;
use Yuga\Models\ElegantModel as Elegant;
class User extends Elegant
{
    protected $hidden = [
        'password',
        'fullname',
        'user_code',
        'username'
    ];

    // protected $fillable = [
    //     'fullname'
    // ];

    protected static $massAssign = true;
    
    public function albums()
    {
        return $this->hasMany('Album');
    }


    public function work()
    {
        return $this->hasOne('Work');
    }

    public function school()
    {
        return $this->hasOne("School");
    }
}