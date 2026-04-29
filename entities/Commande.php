<?php
declare(strict_types=1);

class Commande
{
    public ?int $id = null;
    public int $utilisateurId;
    public int $produitId;
    public string $statut = 'confirmee';
    public ?string $dateCommande = null;
}
