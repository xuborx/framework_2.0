<?php
declare(strict_types=1);

namespace Xuborx\Framework\Requests;

class Request implements RequestInterface
{

    /**
     * @return array
     */
    public function parameters(): array
    {
        return $_REQUEST;
    }

}
