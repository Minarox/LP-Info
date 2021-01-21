<?php


namespace App\Models;


class UsersModel extends Model
{
    protected int $id;
    protected int $id_google;
    protected int $id_facebook;
    protected RolesModel $role_id;
    protected string $last_name;
    protected string $first_name;
    protected string $email;
    protected string $password;
    protected string $avatar;
    protected bool $is_verified;
    protected string $token;

    public function __construct() {
        $this->table = 'users';
    }

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
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getIdGoogle(): int
    {
        return $this->id_google;
    }

    /**
     * @param int $id_google
     */
    public function setIdGoogle(int $id_google): void
    {
        $this->id_google = $id_google;
    }

    /**
     * @return int
     */
    public function getIdFacebook(): int
    {
        return $this->id_facebook;
    }

    /**
     * @param int $id_facebook
     */
    public function setIdFacebook(int $id_facebook): void
    {
        $this->id_facebook = $id_facebook;
    }

    /**
     * @return RolesModel
     */
    public function getRoleId(): RolesModel
    {
        return $this->role_id;
    }

    /**
     * @param RolesModel $role_id
     */
    public function setRoleId(RolesModel $role_id): void
    {
        $this->role_id = $role_id;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
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
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     */
    public function setAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
    }

    /**
     * @return bool
     */
    public function isIsVerified(): bool
    {
        return $this->is_verified;
    }

    /**
     * @param bool $is_verified
     */
    public function setIsVerified(bool $is_verified): void
    {
        $this->is_verified = $is_verified;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }
}