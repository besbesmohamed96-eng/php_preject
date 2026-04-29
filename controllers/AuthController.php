<?php
declare(strict_types=1);

class AuthController
{
    private UtilisateurManager $utilisateurManager;

    public function __construct()
    {
        // Redondance volontaire pour garantir le fuseau sur tout point d'entrée.
        date_default_timezone_set('Africa/Tunis');
        $this->utilisateurManager = new UtilisateurManager();
    }

    public function login(): void
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $user = $this->utilisateurManager->login($email, $password);
            if ($user) {
                $_SESSION['user_id'] = (int) $user['id'];
                $_SESSION['nom_complet'] = $user['nom_complet'];
                $_SESSION['role'] = $user['role'];

                header('Location: index.php?controller=produit&action=catalogue');
                exit;
            }

            $error = 'Email ou mot de passe incorrect.';
        }

        require __DIR__ . '/../views/auth/login.php';
    }

    public function register(): void
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nomComplet = trim($_POST['nom_complet'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'client';

            if ($nomComplet === '' || $email === '' || $password === '') {
                $error = 'Tous les champs sont obligatoires.';
            } else {
                try {
                    $ok = $this->utilisateurManager->register($nomComplet, $email, $password, $role);
                    if ($ok) {
                        header('Location: index.php?controller=auth&action=login');
                        exit;
                    }
                    $error = 'Impossible de créer le compte.';
                } catch (PDOException $e) {
                    $error = 'Email déjà utilisé ou données invalides.';
                }
            }
        }

        require __DIR__ . '/../views/auth/register.php';
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
        header('Location: index.php?controller=auth&action=login');
        exit;
    }
}
