<?php

namespace App\Models;

use App\Core\System\Model;

class UserModel extends Model {

    protected string $User;

    /**
     * @return string
     */
    public function getUser(): string {
        return $this->User;
    }

}
