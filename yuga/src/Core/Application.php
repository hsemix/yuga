<?php
namespace Yuga;
use Closure;
use Whoops\Run as WhoopsRun;
use Yuga\Support\Config;
use Yuga\Views\UI\Site as UI;
use Yuga\Container\Container;
use Yuga\Support\IServiceProvider;
use Whoops\Handler\PrettyPageHandler as PrettyPage;
class Application extends Container
{
    const CHARSET_UTF8 = 'UTF-8';
    public $config;
    public $site;
    protected $loadedProviders = [];
    protected $debugEnabled = false;
    protected $encryptionMethod = 'AES-256-CBC';

    protected $cssWrapRouteName = 'css/wrap';
    protected $jsWrapRouteName = 'js/wrap';
    protected $cssWrapRouteUrl = '/css-wrap';
    protected $jsWrapRouteUrl = '/js-wrap';

    /**
    * @var Translation
    */
    public $translation;
    /**
    * method to run the entire application
    */
    public function __construct()
    {
        $this->charset = static::CHARSET_UTF8;
        $this->singleton('config', Config::class);
        $this->config = $this->resolve('config');
        $this->setDebugEnabled(env('DEBUG_MODE', true));
        $this->site = new UI;

        // Default stuff
        //$this->setTimezone('UTC');
        //$this->setDefaultLocale('en_gb');
       // $this->setLocale('en_gb');
    }

    public function setDebugEnabled($bool)
    {
        $bool = Boolean::parse($bool);
        $this->debug = ($bool === true) ? new Debug() : null;
        $this->debugEnabled = $bool;

        return $this;
    }

    public function getDebugEnabled()
    {
        return $this->debugEnabled;
    }

    public function setEncryptionMethod($method)
    {
        $this->encryptionMethod = $method;

        return $this;
    }

    public function getEncryptionMethod()
    {
        return $this->encryptionMethod;
    }


    public function run()
    {
        $this->initWhoops();
        $providers = $this->config->load('providers.ServiceProviders');

        foreach ($this->config->getAll() as $name => $provider) {
            $this->singleton($name, $provider);
            $provider = $this->resolve($name);
            $this->registerProvider($provider);
        }

        $this->routeServiceProvider();

        $this->make('session')->delete('errors');
    }

    protected function routeServiceProvider()
    {
        $this->singleton('route', \Yuga\Route\RouteServiceProvider::class);
        $route = $this->resolve('route');
        $this->registerProvider($route);
    }

    /**
    * @param \Yuga\Support\IServiceProvider $provider
    * @return \Yuga\Application
    */

    public function registerProvider(IServiceProvider $provider)
    {
        if (!$this->providerLoaded($provider)) {
            $provider->register($this);
            $this->loadedProviders[] = get_class($provider);
            return $this;
        }
    }

    protected function providerLoaded(IServiceProvider $provider)
    {
        return array_key_exists(get_class($provider), $this->loadedProviders);
    }

    /**
    * start whoops
    * @return \Yuga\Application
    */
    protected function initWhoops()
    {
        (new WhoopsRun)->pushHandler(new PrettyPage)->register();

        return $this;
    }

    public function getCharset()
    {
        return $this->charset;
    }

    /**
    * Change the default wroute for the js wrapper
    *
    * @param string $url
    * @return static $this
    */
    public function setJsWrapRouteUrl($url)
    {
        $this->jsWrapRouteUrl = $url;

        return $this;
    }

    /**
    * Change the default url for the css wrapper
    *
    * @param string $url
    * @return static $this
    */
    public function setCssWrapRouteUrl($url)
    {
        $this->cssWrapRouteUrl = $url;

        return $this;
    }

    public function getJsWrapRouteUrl()
    {
        return $this->jsWrapRouteUrl;
    }

    public function getCssWrapRouteUrl()
    {
        return $this->cssWrapRouteUrl;
    }

    /**
    * Get css wrapper route name
    *
    * @return string
    */
    public function getCssWrapRouteName()
    {
        return $this->cssWrapRouteName;
    }

    /**
    * Get js wrapper route name
    *
    * @return string
    */
    public function getJsWrapRouteName()
    {
        return $this->jsWrapRouteName;
    }
    public function getLocale()
    {
        return $this->locale;
    }

    /**
    * @return string $timezone
    */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
    * @param string $timezone
    */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
        date_default_timezone_set($timezone);
    }

    public function setLocale($locale)
    {
        $this->locale = strtolower($locale);
        setlocale(LC_ALL, $locale);

        // if ($this->translation->getProvider() !== null) {
        //     $this->translation->getProvider()->load($locale, $this->defaultLocale);
        // }
    }


    public function getDefaultLocale()
    {
        return $this->defaultLocale;
    }

    /**
     * Set site locale
     *
     * @param string $defaultLocale
     * @return static $this
     */
    public function setDefaultLocale($defaultLocale)
    {
        $this->defaultLocale = $defaultLocale;

        return $this;
    }
 
 

}