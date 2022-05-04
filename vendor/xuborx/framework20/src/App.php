<?php
declare(strict_types=1);

namespace Xuborx\Framework;

use Xuborx\Framework\Model\DBConnection;
use Xuborx\Framework\Routing\Router;

class App
{
    /**
     * The main action of framework.
     *
     * @return void
     */
    public static function start(): void
    {
        if (DEBUG) {
            error_reporting(E_ALL);
            ini_set('display_errors', '1');
        }

        session_start();

        if (USE_REDBEAN) {
            DBConnection::getRedBeanConnection();
        }

        require_once 'DevTools/functions.php';
        new Router();
    }
}
