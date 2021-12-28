<?php
declare(strict_types=1);

namespace Xuborx\Framework\Guards;

abstract class BaseGuard implements GuardInterface
{
    /**
     * @return bool
     */
    public abstract function inspect(): bool;

    /**
     * @return void
     */
    public abstract function ifInspectReturnedFalse(): void;
}