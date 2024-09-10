<?php

declare(strict_types=1);

namespace Controller;

use App\Branch;

class AdController
{
    public function show(int $id): void
    {
        /**
         * @var $id
         */
        $ad        = (new \App\Ads())->getAd($id);
        if($ad->image) {
            $ad->image = "../assets/images/ads/$ad->image";
        }

        loadView('single-ad', ['ad' => $ad], false);
    }

    public function create(): void
    {
        $title       = $_POST['title'];
        $description = $_POST['description'];
        $price       = (float) $_POST['price'];
        $address     = $_POST['address'];
        $rooms       = (int) $_POST['rooms'];

        if ($_POST['title']
            && $_POST['description']
            && $_POST['price']
            && $_POST['address']
            && $_POST['rooms']
        ) {
            // TODO: Replace hardcoded values
            $newAdsId = (new \App\Ads())->createAds(
                $title,
                $description,
                5,
                1,
                1,
                $address,
                $price,
                $rooms
            );

            if ($newAdsId) {
                $imageHandler = new \App\Image();
                $fileName     = $imageHandler->handleUpload();

                if (!$fileName) {
                    exit('Rasm yuklanmadi!');
                }

                $imageHandler->addImage((int) $newAdsId, $fileName);

                header('Location: /');

                exit();
            }

            return;
        }

        echo "Iltimos, barcha maydonlarni to'ldiring!";
    }

    public function update(int $id): void{
        loadView('dashboard/create-ad', ['ad' => (new \App\Ads())->getAd($id)],  false);
    }

    public function search()
    {
        $searchPhrase = $_REQUEST['search-phrase'];
        $ads = (new \App\Ads())->search($searchPhrase);
        $branches = (new Branch())->getBranches();
        loadView('home', ['ads' => $ads, 'branches' => $branches], false);
    }
}
