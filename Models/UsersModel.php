<?php

namespace App\Models;

use App\Core\System\Model;

class UsersModel extends Model {

    protected int $id;
    protected ?int $id_google;
    protected ?int $id_facebook;
    protected int $role_id;
    protected ?string $last_name;
    protected string $first_name;
    protected string $email;
    protected ?string $password;
    protected string $avatar;
    protected bool $is_verified;
    protected string $token;
    protected ?string $last_connexion;
    protected int $nb_values_sensors;
    protected int $nb_values_comparison;
    protected string $created_at;

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UsersModel
     */
    public function setId(int $id): UsersModel {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getIdGoogle(): ?int {
        return $this->id_google;
    }

    /**
     * @param int|null $id_google
     * @return UsersModel
     */
    public function setIdGoogle(?int $id_google): UsersModel {
        $this->id_google = $id_google;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getIdFacebook(): ?int {
        return $this->id_facebook;
    }

    /**
     * @param int|null $id_facebook
     * @return UsersModel
     */
    public function setIdFacebook(?int $id_facebook): UsersModel {
        $this->id_facebook = $id_facebook;
        return $this;
    }

    /**
     * @return int
     */
    public function getRoleId(): int {
        return $this->role_id;
    }

    /**
     * @param int $role_id
     * @return UsersModel
     */
    public function setRoleId(int $role_id): UsersModel {
        $this->role_id = $role_id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string {
        return $this->last_name;
    }

    /**
     * @param string|null $last_name
     * @return UsersModel
     */
    public function setLastName(?string $last_name): UsersModel {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     * @return UsersModel
     */
    public function setFirstName(string $first_name): UsersModel {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @param string $email
     * @return UsersModel
     */
    public function setEmail(string $email): UsersModel {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string {
        return $this->password;
    }

    /**
     * @param string|null $password
     * @return UsersModel
     */
    public function setPassword(?string $password): UsersModel {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvatar(): string {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     * @return UsersModel
     */
    public function setAvatar(string $avatar): UsersModel {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * @return bool
     */
    public function isIsVerified(): bool {
        return $this->is_verified;
    }

    /**
     * @param bool $is_verified
     * @return UsersModel
     */
    public function setIsVerified(bool $is_verified): UsersModel {
        $this->is_verified = $is_verified;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string {
        return $this->token;
    }

    /**
     * @param string $token
     * @return UsersModel
     */
    public function setToken(string $token): UsersModel {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastConnexion(): ?string {
        return $this->last_connexion;
    }

    /**
     * @param string|null $last_connexion
     * @return UsersModel
     */
    public function setLastConnexion(?string $last_connexion): UsersModel {
        $this->last_connexion = $last_connexion;
        return $this;
    }

    /**
     * @return int
     */
    public function getNbValuesSensors(): int {
        return $this->nb_values_sensors;
    }

    /**
     * @param int $nb_values_sensors
     * @return UsersModel
     */
    public function setNbValuesSensors(int $nb_values_sensors): UsersModel {
        $this->nb_values_sensors = $nb_values_sensors;
        return $this;
    }

    /**
     * @return int
     */
    public function getNbValuesComparison(): int {
        return $this->nb_values_comparison;
    }

    /**
     * @param int $nb_values_comparison
     * @return UsersModel
     */
    public function setNbValuesComparison(int $nb_values_comparison): UsersModel {
        $this->nb_values_comparison = $nb_values_comparison;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     * @return UsersModel
     */
    public function setCreatedAt(string $created_at): UsersModel {
        $this->created_at = $created_at;
        return $this;
    }

}
