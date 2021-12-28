<?php
declare(strict_types=1);

namespace Xuborx\Framework\Controller;

use Xuborx\Framework\Routing\Route;
use Xuborx\Framework\View\BaseView;

class BaseController
{
    /**
     * @var Route
     */
    protected $route;
    /**
     * @var BaseView
     */
    protected $view;

    /**
     * @param Route $route
     * @param BaseView $view
     */
    public function __construct(Route $route, BaseView $view)
    {
        $this->route = $route;
        $this->view = $view;
    }
}
