<?php
declare(strict_types=1);

namespace Xuborx\Framework\Guards;

interface GuardInterface
{

    /**
     * @return bool
     */
    public function inspect(): bool;

    /**
     * @return void
     */
    public function ifInspectReturnedFalse(): void;
}