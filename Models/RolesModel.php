<?php


namespace App\Models;


class RolesModel extends Model
{
    private string $name;

    public function __construct() {
        $this->table = 'roles';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}