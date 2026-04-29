<?php
declare(strict_types=1);

class ProduitManager
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getAll(): array
    {
        $sql = 'SELECT id, designation, prix, image_produit, created_at FROM produits ORDER BY created_at DESC, id DESC';
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getById(int $id): ?array
    {
        $sql = 'SELECT id, designation, prix, image_produit, created_at FROM produits WHERE id = :id LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $produit = $stmt->fetch();

        return $produit ?: null;
    }

    public function add(string $designation, float $prix, string $imageProduit): bool
    {
        $sql = 'INSERT INTO produits (designation, prix, image_produit) VALUES (:designation, :prix, :image)';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'designation' => $designation,
            'prix' => $prix,
            'image' => $imageProduit,
        ]);
    }

    public function update(int $id, string $designation, float $prix, ?string $imageProduit = null): bool
    {
        if ($imageProduit !== null) {
            $sql = 'UPDATE produits SET designation = :designation, prix = :prix, image_produit = :image WHERE id = :id';
            $params = [
                'id' => $id,
                'designation' => $designation,
                'prix' => $prix,
                'image' => $imageProduit,
            ];
        } else {
            $sql = 'UPDATE produits SET designation = :designation, prix = :prix WHERE id = :id';
            $params = [
                'id' => $id,
                'designation' => $designation,
                'prix' => $prix,
            ];
        }

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete(int $id): bool
    {
        $sql = 'DELETE FROM produits WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
