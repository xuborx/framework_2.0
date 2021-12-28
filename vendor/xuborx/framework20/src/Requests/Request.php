<?php
declare(strict_types=1);

namespace Xuborx\Framework\Requests;

abstract class Request implements RequestInterface
{

    /**
     * @return array
     */
    public abstract function parameters(): array;

}
