<?php
declare(strict_types=1);

namespace Xuborx\Framework\Routing;

class Route
{
    /**
     * @var string
     */
    private $method;
    /**
     * @var string
     */
    private $path;
    /**
     * @var string
     */
    private $controller;
    /**
     * @var string
     */
    private $action;
    /**
     * @var string|null
     */
    private $guard = null;

    /**
     * @param string $method
     * @param string $path
     * @param string|null $guard
     */
    public function __construct
    (
        string $method,
        string $path,
        string $controller,
        string $action,
        string $guard = null
    ) {
        $this->method = $method;
        $this->path = $path;
        $this->controller = $controller;
        $this->action = $action;
        $this->guard = $guard;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string|null
     */
    public function getQuery(): ?string
    {
        return $this->query;
    }

    /**
     * @return string|null
     */
    public function getGuard(): ?string
    {
        return $this->guard;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }
}
