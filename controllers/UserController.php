<?php

declare(strict_types=1);

namespace Controller;

use App\Ads;
use App\Branch;
use App\Session;

class UserController
{
    public function loadProfile(): void
    {
        $ads = (new Ads())->getUsersAds((int)(new Session())->getId());
        loadView('profile', ['ads' => $ads], false);
    }

    public function branches()
    {
        $branches = (new Branch())->getBranches();
        loadView('dashboard/branches', ['branches' => $branches]);
    }
}