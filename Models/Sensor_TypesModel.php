<?php


namespace App\Models;


use App\Core\System\Model;

class Sensor_TypesModel extends Model
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Sensor_TypesModel
     */
    public function setName(string $name): Sensor_TypesModel
    {
        $this->name = $name;
        return $this;
    }
}