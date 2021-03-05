<?php


namespace App\Models;


use App\Core\System\Model;

class SensorsModel extends Model
{
    protected int $id;
    protected int $type_id;
    protected string $name;
    protected bool $active;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getTypeId(): int
    {
        return $this->type_id;
    }

    /**
     * @param int $type_id
     */
    public function setTypeId(int $type_id): SensorsModel
    {
        $this->type_id = $type_id;
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
     */
    public function setName(string $name): SensorsModel
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): SensorsModel
    {
        $this->active = $active;
        return $this;
    }
}