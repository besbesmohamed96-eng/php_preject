<?php
declare(strict_types=1);

class ProduitController
{
    private ProduitManager $produitManager;

    public function __construct()
    {
        date_default_timezone_set('Africa/Tunis');
        $this->produitManager = new ProduitManager();
    }

    public function catalogue(): void
    {
        $produits = $this->produitManager->getAll();
        require __DIR__ . '/../views/produits/catalogue.php';
    }

    public function create(): void
    {
        $this->requireVendeur();
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $designation = trim($_POST['designation'] ?? '');
            $prix = (float) ($_POST['prix'] ?? 0);

            try {
                $imagePath = Uploader::uploadProduitImage($_FILES['image_produit'] ?? []);
                $this->produitManager->add($designation, $prix, $imagePath);
                header('Location: index.php?controller=produit&action=catalogue');
                exit;
            } catch (Throwable $e) {
                $error = $e->getMessage();
            }
        }

        $produit = null;
        $formAction = 'index.php?controller=produit&action=create';
        require __DIR__ . '/../views/produits/form.php';
    }

    public function edit(): void
    {
        $this->requireVendeur();
        $error = null;
        $id = (int) ($_GET['id'] ?? 0);
        $produit = $this->produitManager->getById($id);

        if (!$produit) {
            http_response_code(404);
            echo 'Produit introuvable.';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $designation = trim($_POST['designation'] ?? '');
            $prix = (float) ($_POST['prix'] ?? 0);
            $imagePath = null;

            try {
                if (!empty($_FILES['image_produit']['name'])) {
                    $imagePath = Uploader::uploadProduitImage($_FILES['image_produit']);
                }

                $this->produitManager->update($id, $designation, $prix, $imagePath);
                header('Location: index.php?controller=produit&action=catalogue');
                exit;
            } catch (Throwable $e) {
                $error = $e->getMessage();
            }
        }

        $formAction = 'index.php?controller=produit&action=edit&id=' . $id;
        require __DIR__ . '/../views/produits/form.php';
    }

    public function delete(): void
    {
        $this->requireVendeur();
        $id = (int) ($_GET['id'] ?? 0);

        if ($id > 0) {
            $this->produitManager->delete($id);
        }

        header('Location: index.php?controller=produit&action=catalogue');
        exit;
    }

    private function requireVendeur(): void
    {
        if (($_SESSION['role'] ?? null) !== 'vendeur') {
            http_response_code(403);
            echo 'Accès interdit : réservé au vendeur.';
            exit;
        }
    }
}
