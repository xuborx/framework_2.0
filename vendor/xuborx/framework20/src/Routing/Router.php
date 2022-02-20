<?php
declare(strict_types=1);

namespace Xuborx\Framework\Routing;

use Xuborx\Framework\Requests\Request;
use Xuborx\Framework\Requests\RequestFactory;

class Router
{
    /**
     * @var Route[]
     */
    private static $routes = [];

    public function __construct()
    {
        RouteHandler::getInstance(
            self::findCurrentRoute(),
            RequestFactory::create()
        );
    }

    /**
     * @param string $method
     * @param string $path
     * @param string $controller
     * @param string $action
     * @param string|null $guard
     * @return void
     */
    public static function addRoute(
        string $method,
        string $path,
        string $controller,
        string $action,
        string $guard = null
    ) {
        self::$routes[self::getRouteName($method, $path)] =
            new Route(
                $method,
                $path,
                $controller,
                $action,
                $guard
            );
    }

    /**
     * @param string $method
     * @param string $path
     * @return string
     */
    private static function getRouteName(string $method, string $path): string
    {
        return $method . ':' . $path;
    }

    /**
     * @return Route[]
     */
    public static function getRoutes(): array
    {
        return self::$routes;
    }

    /**
     * @return Route|null
     */
    private static function findCurrentRoute(): ?Route
    {
        return self::$routes[self::getRouteName(
                $_SERVER['REQUEST_METHOD'],
                parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)
            )] ?? null;
    }

}
