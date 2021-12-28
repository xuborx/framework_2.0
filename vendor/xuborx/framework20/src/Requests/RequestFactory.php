<?php
declare(strict_types=1);

namespace Xuborx\Framework\Requests;

class RequestFactory
{

    /**
     * @return Request|null
     */
    public static function create(): ?Request
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return new GetRequest();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return new PostRequest();
        }

        return null;
    }

}