<?php
declare(strict_types=1);

class CommandeController
{
    private CommandeManager $commandeManager;

    public function __construct()
    {
        date_default_timezone_set('Africa/Tunis');
        $this->commandeManager = new CommandeManager();
    }

    public function add(): void
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        $userId = (int) $_SESSION['user_id'];
        $produitId = (int) ($_GET['produit_id'] ?? 0);

        if ($produitId > 0) {
            // Statut métier imposé : "confirmee" par défaut dans la couche DAO.
            $this->commandeManager->addCommande($userId, $produitId);
        }

        header('Location: index.php?controller=commande&action=mesCommandes');
        exit;
    }

    public function mesCommandes(): void
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        $commandes = $this->commandeManager->getByUtilisateurId((int) $_SESSION['user_id']);
        require __DIR__ . '/../views/commandes/mes_commandes.php';
    }

    public function delete(): void
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        $commandeId = (int) ($_GET['id'] ?? 0);
        $userId = (int) $_SESSION['user_id'];

        if ($commandeId > 0) {
            $this->commandeManager->deleteByIdAndUtilisateurId($commandeId, $userId);
        }

        header('Location: index.php?controller=commande&action=mesCommandes');
        exit;
    }
}
