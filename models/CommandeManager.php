<?php
declare(strict_types=1);

class CommandeManager
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function addCommande(int $userId, int $produitId): bool
    {
        $sql = 'INSERT INTO commandes (utilisateur_id, produit_id, statut) VALUES (:utilisateur_id, :produit_id, :statut)';
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'utilisateur_id' => $userId,
            'produit_id' => $produitId,
            'statut' => 'confirmee',
        ]);
    }

    public function getByUtilisateurId(int $userId): array
    {
        $sql = <<<SQL
            SELECT c.id, c.statut, c.date_commande, p.designation, p.prix, p.image_produit
            FROM commandes c
            INNER JOIN produits p ON p.id = c.produit_id
            WHERE c.utilisateur_id = :user_id
            ORDER BY c.date_commande DESC, c.id DESC
        SQL;

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function deleteByIdAndUtilisateurId(int $commandeId, int $userId): bool
    {
        // Sécurité métier: un client ne peut supprimer que ses propres commandes.
        $sql = 'DELETE FROM commandes WHERE id = :commande_id AND utilisateur_id = :user_id';
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'commande_id' => $commandeId,
            'user_id' => $userId,
        ]);
    }
}
