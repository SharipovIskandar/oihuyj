<?php

declare(strict_types=1);

namespace App;

use PDO;

class Ads
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    public function createAds(
        string $title,
        string $description,
        int    $user_id,
        int    $status_id,
        int    $branch_id,
        string $address,
        float  $price,
        int    $rooms,
    ): false|string {
        $query = "INSERT INTO ads (title, description, user_id, status_id, branch_id, address, price, rooms, created_at) 
                  VALUES (:title, :description, :user_id, :status_id, :branch_id, :address, :price, :rooms, NOW())";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':status_id', $status_id);
        $stmt->bindParam(':branch_id', $branch_id);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':rooms', $rooms);
        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

    public function getAd($id)
    {
        $query = "SELECT ads.*, image_path AS image
                  FROM ads
                    JOIN images ON ads.id = images.ads_id
                  WHERE ads.id = :id";

        $stmt  = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function getAds(): false|array
    {
        $query = "SELECT *, ads.id AS id, ads.address AS address, images.image_path AS image
                  FROM ads
                    JOIN branch ON branch.id = ads.branch_id
                    LEFT JOIN images ON ads.id = images.ads_id";
         return $this->pdo->query($query)->fetchAll();
    }

    public function getUsersAds(int $userId): false|array
    {
        $query = "SELECT *, ads.id AS id, ads.address AS address, images.image_path AS image
                  FROM ads
                    JOIN branch ON branch.id = ads.branch_id
                    LEFT JOIN images ON ads.id = images.ads_id
                  WHERE user_id = $userId"; // FIXME: Prepare userId
        return $this->pdo->query($query)->fetchAll();
    }

    public function updateAds(
        int    $id,
        string $title,
        string $description,
        int    $user_id,
        int    $status_id,
        int    $branch_id,
        string $address,
        float  $price,
        int    $rooms
    ) {
        $query = "UPDATE ads SET title = :title, description = :description, user_id = :user_id,
                 status_id = :status_id, branch_id = :branch_id, address = :address, 
                 price = :price, rooms = :rooms, updated_at = NOW() WHERE id = :id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':status_id', $status_id);
        $stmt->bindParam(':branch_id', $branch_id);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':rooms', $rooms);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteAds(int $id): array|false
    {
        $query = "DELETE FROM ads WHERE id = :id";
        $stmt  = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function search(string $searchPhrase, int|null $branch_id = null, int|null $minPrice = null, int|null $maxPrice = null)
    {
        $searchPhrase = "%$searchPhrase%";
        $query = "SELECT *, ads.id AS id, ads.address AS address, images.image_path AS image
              FROM ads
                JOIN branch ON branch.id = ads.branch_id
                LEFT JOIN images ON ads.id = images.ads_id
                WHERE (title LIKE :searchPhrase 
                OR description LIKE :searchPhrase)";

        $params = [':searchPhrase' => $searchPhrase];

        if ($branch_id) {
            $query .= " AND (ads.branch_id = :branch_id)";
            $params[':branch_id'] = $branch_id;
        }

        if ($minPrice && $maxPrice) {
            $query .= " AND (ads.price BETWEEN :min_price AND :max_price)";
            $params[':min_price'] = $minPrice;
            $params[':max_price'] = $maxPrice;
        }

        $stmt = $this->pdo->prepare($query);

        foreach ($params as $key => $value) {
            $stmt->bindParam($key, $value);
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }


}