<?php
declare(strict_types=1);

class Produit
{
    public ?int $id = null;
    public string $designation;
    public float $prix;
    public string $imageProduit = 'uploads/default_product.png';
    public ?string $createdAt = null;
}
