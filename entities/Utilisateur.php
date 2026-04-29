<?php
declare(strict_types=1);

class Utilisateur
{
    public ?int $id = null;
    public string $nomComplet;
    public string $email;
    public string $password;
    public string $role = 'client';
    public ?string $createdAt = null;
}
