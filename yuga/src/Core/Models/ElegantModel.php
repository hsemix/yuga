<?php
namespace Yuga\Models;
use Yuga\Database\Elegant\Model;
use Yuga\Shared\Controller as Universal;
class ElegantModel extends Model
{
    use Universal;
    public function __construct(array $options = [])
    {
        $this->init();
        parent::__construct($options);
    }

    protected function init()
    {
        /**
        *   Initialize all model defaults
        */
        $this->getApp();
        $this->getHash();
        $this->getCookie();
        $this->getRequest();
        $this->getSession();
        $this->getResponse();
        $this->getValidator();
        $this->getLoggedInUserId();
    }
    
}