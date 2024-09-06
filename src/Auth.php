<?php

declare(strict_types=1);

namespace App;

use PDO;
use PDOException;

class Auth
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    public function login(string $username, string $password)
    {
        // Get user or fail
        $user = (new User())->getByUsername($username, $password);
        if ($user === null) {
            $_SESSION['message']['error'] = "Wrong email or password";
            redirect('/login');
            return;
        }

        // Prepare query with parameterized statements
        $query = "SELECT users.*, user_roles.role_id
                  FROM users
                  JOIN user_roles ON users.id = user_roles.user_id
                  WHERE users.id = :user_id";

        try {
            // Prepare and execute query
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['user_id' => $user->id]);
            $userWithRoles = $stmt->fetch(PDO::FETCH_OBJ);

            if ($userWithRoles === false) {
                $_SESSION['message']['error'] = "User not found";
                redirect('/login');
                return;
            }

            // Check user role
            if ($userWithRoles->role_id === Role::ADMIN) {
                redirect('/admin');
            }

            // Store user information in session
            $_SESSION['user'] = [
                'username' => $userWithRoles->username,
                'id'       => $userWithRoles->id,
                'role'     => $userWithRoles->role_id
            ];

            unset($_SESSION['message']['error']);
            redirect('/profile2');
        } catch (PDOException $e) {
            // Handle the error
            error_log('Database error: ' . $e->getMessage());
            $_SESSION['message']['error'] = "An error occurred. Please try again later.";
            redirect('/login');
        }
    }
}
