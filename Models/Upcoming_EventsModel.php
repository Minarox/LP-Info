<?php

namespace App\Models;

use App\Core\System\Model;

class Upcoming_EventsModel extends Model {

    protected int $id;
    protected int $id_newspaper;
    protected string $name;
    protected string $description;
    protected string $image;

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Upcoming_EventsModel
     */
    public function setId(int $id): Upcoming_EventsModel {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdNewspaper(): int {
        return $this->id_newspaper;
    }

    /**
     * @param int $id_newspaper
     * @return Upcoming_EventsModel
     */
    public function setIdNewspaper(int $id_newspaper): Upcoming_EventsModel {
        $this->id_newspaper = $id_newspaper;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Upcoming_EventsModel
     */
    public function setName(string $name): Upcoming_EventsModel {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Upcoming_EventsModel
     */
    public function setDescription(string $description): Upcoming_EventsModel {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage(): string {
        return $this->image;
    }

    /**
     * @param string $image
     * @return Upcoming_EventsModel
     */
    public function setImage(string $image): Upcoming_EventsModel {
        $this->image = $image;
        return $this;
    }

}
