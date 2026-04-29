<?php
declare(strict_types=1);

class UtilisateurManager
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function login(string $email, string $password): ?array
    {
        $sql = 'SELECT id, nom_complet, email, password, role FROM utilisateurs WHERE email = :email LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if (!$user) {
            return null;
        }

        if (!password_verify($password, $user['password'])) {
            return null;
        }

        return $user;
    }

    public function register(string $nomComplet, string $email, string $password, string $role = 'client'): bool
    {
        $allowedRoles = ['client', 'vendeur'];
        if (!in_array($role, $allowedRoles, true)) {
            $role = 'client';
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO utilisateurs (nom_complet, email, password, role) VALUES (:nom, :email, :password, :role)';
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'nom' => $nomComplet,
            'email' => $email,
            'password' => $hash,
            'role' => $role,
        ]);
    }
}
