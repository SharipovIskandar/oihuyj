<?php

declare(strict_types=1);

namespace Controller;

use App\Ads;
use App\Branch;
use App\Session;

class UserController
{
    public function logout()
    {
        session_destroy();
    }
    public function loadProfile(): void
    {
        $ads = (new Ads())->getUsersAds((int)(new Session())->getId());
        loadView('dashboard/profile', ['ads' => $ads], false);
    }

    public function branches()
    {
        $branches = (new Branch())->getBranches();
        loadView('dashboard/branches', ['branches' => $branches], false);
    }

    public function allAds(): void
    {
        $ads = (new Ads())->getAds();

        loadView('dashboard/allAds', ['ads' => $ads], false);
    }
}