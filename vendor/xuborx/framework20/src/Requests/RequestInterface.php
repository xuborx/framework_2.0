<?php

namespace Xuborx\Framework\Requests;

interface RequestInterface
{
    /**
     * @return array
     */
    public function parameters(): array;
}