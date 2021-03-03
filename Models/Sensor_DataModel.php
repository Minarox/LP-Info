<?php


namespace App\Models;


use App\Core\System\Model;

class Sensor_DataModel extends Model
{
    protected int $id;
    protected int $sensor_id;
    protected float $temperature;
    protected string $timestamp;

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
    public function getSensorId(): int
    {
        return $this->sensor_id;
    }

    /**
     * @param int $sensor_id
     */
    public function setSensorId(int $sensor_id): void
    {
        $this->sensor_id = $sensor_id;
    }

    /**
     * @return float
     */
    public function getTemperature(): float
    {
        return $this->temperature;
    }

    /**
     * @param float $temperature
     */
    public function setTemperature(float $temperature): void
    {
        $this->temperature = $temperature;
    }

    /**
     * @return string
     */
    public function getTimestamp(): string
    {
        return $this->timestamp;
    }
}