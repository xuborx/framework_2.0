<?php
declare(strict_types=1);

namespace App\Guards;

use Xuborx\Auth\Auth;
use Xuborx\Framework\Guards\BaseGuard;

class UserIsLoggedInGuard extends BaseGuard
{
    public function inspect(): bool
    {
        return Auth::userIsLoggedIn();
    }

    public function ifInspectReturnedFalse(): void
    {
        echo 'Access denied';
    }
}
