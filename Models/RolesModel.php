<?php


namespace App\Models;


use App\Core\System\Model;

class RolesModel extends Model
{
    protected int $id;
    protected string $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return RolesModel
     */
    public function setId(int $id): RolesModel
    {
        $this->id = $id;
        return $this;
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
     * @return RolesModel
     */
    public function setName(string $name): RolesModel
    {
        $this->name = $name;
        return $this;
    }
}