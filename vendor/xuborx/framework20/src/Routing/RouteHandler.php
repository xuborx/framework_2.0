<?php
declare(strict_types=1);

namespace Xuborx\Framework\Routing;

use Xuborx\Framework\Controller\BaseController;
use Xuborx\Framework\Guards\BaseGuard;
use Xuborx\Framework\Guards\GuardInterface;
use Xuborx\Framework\Requests\Request;
use Xuborx\Framework\View\BaseView;

class RouteHandler
{
    /**
     * @var RouteHandler|null
     */
    private static $instance = null;

    /**
     * @param Route|null $route
     * @param Request|null $request
     */
    private function __construct(?Route $route, ?Request $request){
        $this->handle($route, $request);
    }

    /**
     * @param Route|null $route
     * @param Request|null $request
     * @return RouteHandler|null
     */
    public static function getInstance(?Route $route, ?Request $request)
    {
        if (!self::$instance) {
            self::$instance = new self($route, $request);
        }

        return self::$instance;
    }

    /**
     * @param Route|null $route
     * @param Request|null $request
     * @return void
     */
    public function handle(?Route $route, ?Request $request): void
    {
        if (!$route) {
            echo 'Route not found<br>';
            return;
        }

        if ($route->getGuard() !== null && !$this->checkIfGuardAllowsContinue($route->getGuard())) {
            return;
        }

        $controllerClass = '\App\Controllers\\' . $route->getController() . 'Controller';

        if (!$this->findController($controllerClass)) {
            echo 'Controller not found<br>';
            return;
        }

        $controllerObj = new $controllerClass($route, BaseView::getInstance());
        $action = $route->getAction();

        if (!$this->findAction($controllerObj, $action)) {
            echo 'Action not found<br>';
            return;
        }

        $controllerObj->$action($request);
    }

    /**
     * @param $controllerClass
     * @return bool|null
     */
    private function findController($controllerClass): ?bool
    {
        return class_exists($controllerClass);
    }

    /**
     * @param BaseController $controllerObj
     * @param string $action
     * @return bool
     */
    private function findAction(BaseController $controllerObj, string $action): bool
    {
        return method_exists($controllerObj, $action);
    }

    /**
     * @param string $guardName
     * @return bool
     */
    private function checkIfGuardAllowsContinue(string $guardName): bool
    {
        $guardClass = '\App\Guards\\' . $guardName . 'Guard';

        if (!class_exists($guardClass)) {
            echo 'Guard not found<br>';
            return false;
        }

        $guardObject = new $guardClass();

        if (!$guardObject instanceof BaseGuard) {
            echo 'Guard must extends BaseGuard<br>';
            return false;
        }

        if (!$guardObject->inspect()) {
            $guardObject->ifInspectReturnedFalse();
            return false;
        }

        return $guardObject->inspect();
    }

}
