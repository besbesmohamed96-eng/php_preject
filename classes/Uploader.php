<?php
declare(strict_types=1);

final class Uploader
{
    /**
     * Gère l'upload d'image produit de manière sécurisée.
     * Retourne le chemin stockable en base (ex: uploads/abc.webp).
     */
    public static function uploadProduitImage(array $file): string
    {
        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
            return 'uploads/default_product.png';
        }

        if (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
            throw new RuntimeException('Erreur lors de l\'upload du fichier.');
        }

        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $originalName = $file['name'] ?? '';
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        if (!in_array($extension, $allowed, true)) {
            throw new InvalidArgumentException('Extension non autorisée. Formats acceptés: jpg, png, webp.');
        }

        $uploadDir = __DIR__ . '/../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $newFileName = bin2hex(random_bytes(16)) . '.' . $extension;
        $targetAbsolutePath = $uploadDir . $newFileName;

        if (!move_uploaded_file($file['tmp_name'], $targetAbsolutePath)) {
            throw new RuntimeException('Impossible de déplacer l\'image uploadée.');
        }

        return 'uploads/' . $newFileName;
    }
}
