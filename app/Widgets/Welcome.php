<?php
namespace App\Widgets;
use Byakuno\Models\User;
class Welcome extends Site 
{
    protected $appName;
    public function __construct($appName) 
    {
        parent::__construct();
        $this->appName = $appName;
    }
    
    public function getAppName()
    {
        return $this->appName;
    }
}