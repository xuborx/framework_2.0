<?php
declare(strict_types=1);

namespace Xuborx\Framework\Requests;

class GetRequest extends Request
{

    /**
     * @return array
     */
    public function parameters(): array
    {
        return $_GET;
    }

}
