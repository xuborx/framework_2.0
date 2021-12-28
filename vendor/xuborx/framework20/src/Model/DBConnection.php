<?php
declare(strict_types=1);

namespace Xuborx\Framework\Model;

use RedBeanPHP\R;

class DBConnection
{

    /**
     * @var \PDO|null
     */
    private static $connection = null;

    /**
     *
     */
    private function __construct(){}

    /**
     * @return \PDO
     */
    public static function get(): \PDO
    {
        if (self::$connection === null) {
            self::$connection = new \PDO(self::buildDsn(), DB_USERNAME, DB_PASSWORD);
        }

        return self::$connection;
    }

    /**
     * @return void
     */
    public static function getRedBeanConnection(): void
    {
        R::setup(self::buildDsn(), DB_USERNAME, DB_PASSWORD);
    }

    /**
     * @return string
     */
    private static function buildDsn(): string
    {
        return 'mysql:dbname='. DB_NAME .';host='. DB_HOST .';port=' . DB_PORT;
    }

}
