<?php

namespace App\Models;

use App\Core\System\Model;

class Horse_ItemsModel extends Model {

    protected int $horse_id;
    protected int $item_id;
    protected int $quantity;

    /**
     * @return int
     */
    public function getHorseId(): int
    {
        return $this->horse_id;
    }

    /**
     * @param int $horse_id
     */
    public function setHorseId(int $horse_id): void
    {
        $this->horse_id = $horse_id;
    }

    /**
     * @return int
     */
    public function getItemId(): int
    {
        return $this->item_id;
    }

    /**
     * @param int $item_id
     */
    public function setItemId(int $item_id): void
    {
        $this->item_id = $item_id;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

}
