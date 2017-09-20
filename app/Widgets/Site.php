<?php
namespace App\Widgets;

use Yuga\Views\Widgets\Menu\Menu;
use Yuga\Views\Widgets\Widget;

abstract class Site extends Widget
{
    protected $mainMenu;

    public function __construct()
    {
        parent::__construct();
        $this->getSite()->setTitle('Yuga Framework Test Case');
        $this->getStyles();
    }

    protected function getStyles()
    {
        $this->getSite()->addWrappedCss(assets('css/styles.css'));
    }
}