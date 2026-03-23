<?php

namespace App\Entity;

class Account
{
    private ?int $id;
    private ?string $firstname;
    private ?string $lastname;
    private ?string $email;
    private ?string $password;
    private ?string $image;

    public function __construct(
        ?string $email = null,
        ?string $password = null
    )
    {
        $this->email = $email;
        $this->password = $password;
        $this->image = "profil.png";
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self 
    {
        $this->id = $id;
        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self 
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self 
    {
        $this->password = $password;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;
        return $this;
    }

    //Méthodes
    public function __toString(): string
    {
        return $this->firstname . ", " . $this->lastname;
    }
    
    /**
     * Méthode pour hasher le password en Bycript
     * @return void
     */
    public function hashPassword(): void
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    /**
     * Méthode pour vérifier le hash du password
     * @param string $plainPassword mot de passe en clair
     * @return bool true si valide false si invalide
     */
    public function verifyPassword(string $plainPassword): bool 
    {
        return password_verify($plainPassword, $this->password);
    }
}