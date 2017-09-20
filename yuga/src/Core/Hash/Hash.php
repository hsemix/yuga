<?php
namespace Yuga\Hash;
use Yuga\Database\Elegant\Model;
class Hash
{
    private $crypt;
    private $algorithm = 'sha256';
    public function __construct()
    {
        $this->setCypt(env('AUTH_MODEL_CRYPT_TYPE'));
    }

    public function make($string, $salt = '')
    {
        if ($this->algorithm == 'crypt')
            return crypt($string, $salt);

        return hash($this->getAlgorithm(), $string . $salt);
    }

    public function setAlgorithm($algorithm)
    {
        $this->algorithm = $algorithm;
        return $this;
    }

    public static function salt($length = 8)
    {
        return bin2hex(mcrypt_create_iv($length));
    }

    public static function unique()
    {
        return self::make(uniqid());
    }

    public static function code($length = 8)
    {
        return "$1$".self::salt($length)."$";
    }

    public function password($string, $code = null)
    {
        //return ($code !== '') ? crypt($string, $code) : call_user_func($this->getCrypt(), $string);
        return $this->make($string, $code);
    }

    public function getCrypt()
    {
        return $this->crypt;
    }

    public function setCypt($crypt)
    {
        $this->crypt = $crypt;
        return $this;
    }

    public function getAlgorithm()
    {
        return $this->algorithm;
    }

    public function getSalt(Model $model)
    {
        $modelUserSalt = env('AUTH_MODEL_TOKEN_FIELD');
        $appSecret = env('APP_SECRET', 'NoApplicationSecret');
        if (is_null($modelUserSalt)) {
            $modelUserSalt = $appSecret;
        } else {
            $modelUserSalt = $model->$modelUserSalt?:$appSecret;
        }
        return $modelUserSalt;
    }
}