<?php
declare(strict_types=1);

namespace Xuborx\Framework\Redirect;

class Redirector
{

    /**
     * @param string $url
     * @param bool $replace
     * @param int $responseCode
     * @return void
     */
    public static function redirect(string $url, bool $replace = false, int $responseCode = 303): void
    {
        header('Location: ' . $url, $replace, $responseCode);
        exit();
    }

}