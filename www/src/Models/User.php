<?php

namespace App\Models;

use App\Core\DB;

class User extends DB
{
    const _ROLE_NONE = 0;
    const _ROLE_USER = 1;
    const _ROLE_MODERATOR = 5;
    const _ROLE_ADMIN = 10;

    const _STATUS_INACTIVE = 0;
    const _STATUS_ACTIVE = 1;

    protected int $id;
    protected string $firstname;
    protected string $lastname;
    protected string $email;
    protected string $pwd;
    protected int $status  = self::_STATUS_INACTIVE;
    protected bool $isdeleted;
    protected int $role = self::_ROLE_NONE;
    protected ?string $verificationcode;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        if ($id < 0) {
            throw new \Exception("L'id ne peut pas etre negatif");
        }
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $firstname = strip_tags(ucwords(strtolower(trim($firstname))));
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $lastname = strip_tags(strtoupper(trim($lastname)));
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $email = strip_tags(strtolower(trim($email)));
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPwd(): string
    {
        return $this->pwd;
    }

    /**
     * @param string $pwd
     */
    public function setPwd(string $pwd): void
    {
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $this->pwd = $pwd;
    }

    // On génère un nouveau mot de passe
    public function resetPassword(): string
    {
        $chars = "abcd1973efghijklmn13987opqrs871240tuvwxyzABCD913703EFGHIJKLMNOPQ130987RSTUVWXYZ0123456789";
        $pwd = substr(str_shuffle($chars), 0, 8);

        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
        return $pwd;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        // Si le status passe à activé, on supprime le code de vérification
        if ($this->status === self::_STATUS_INACTIVE && $status === self::_STATUS_ACTIVE) {
            $this->verificationcode = null;
        }

        $this->status = $status;
    }

    public function getStatusName(): string
    {
        return $this->status === self::_STATUS_ACTIVE ? "Actif" : "Inactif";
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->isdeleted;
    }

    /**
     * @param bool $isdeleted
     */
    public function setIsdeleted(bool $isdeleted): void
    {
        $this->isdeleted = $isdeleted;
    }

    /**
     * Get the value of role
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  void
     */
    public function setRole(int $role): void
    {
        $this->role = $role;
    }

    public function getInsertedAt(): string
    {
        return $this->inserted;
    }

    /**
     * @return string
     */
    public function getVerificationcode(): string
    {
        return $this->verificationcode;
    }

    public function resetVerificationCode(): void
    {
        $this->verificationcode = rand(100000, 999999);
    }

    /**
     * Verificate code
     */
    public function verificateCode(string $code): bool
    {
        return $code === $this->verificationcode;
    }
}