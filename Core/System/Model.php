<?php

namespace App\Core\System;

use App\Core\Database\Database;
use PDO;
use PDOStatement;

abstract class Model {

    private string $table;

    public function __construct() {
        $this->table = str_replace('model', '', substr(strrchr(strtolower(get_class($this)), "\\"), 1));
    }

    private function query(string $sql, array $params = null): bool|PDOStatement {
        $db = Database::getPDO();

        if ($params === null) {
            $query = $db->query($sql);
        } else {
            $query = $db->prepare($sql);
            $query->execute($params);
        }

        $query->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$db]);
        return $query;
    }

    /**
     * @return array|bool|$this
     */
    public function findAll(): array|self|bool {
        return $this->query("SELECT * FROM {$this->table}")->fetchAll();
    }

    /**
     * @param int $id
     * @return array|bool|$this
     */
    public function findById(int $id): array|self|bool {
        return $this->query("SELECT * FROM {$this->table} WHERE id = {$id}")->fetch();
    }

    /**
     * @param array $filter
     * @return array|bool|$this
     */
    public function findBy(array $filter): array|bool|self {
        $fields = [];
        $values = [];

        foreach ($filter as $k => $v) {
            $fields[] = "$k = :$k";
            $values[$k] = $v;
        }

        $fields_list = implode(' AND ', $fields);

        return $this->query("SELECT * FROM {$this->table} WHERE {$fields_list}", $values)->fetchAll();
    }

    /**
     * @param array $filter
     * @return array|bool|PDOStatement|$this
     */
    public function findOneBy(array $filter): array|bool|PDOStatement|self {
        $fields = [];
        $values = [];

        foreach ($filter as $k => $v) {
            $fields[] = "$k = :$k";
            $values[$k] = $v;
        }

        $fields_list = implode(' AND ', $fields);

        return $this->query("SELECT * FROM {$this->table} WHERE {$fields_list}", $values)->fetch();
    }

    public function create(): bool|PDOStatement {
        $fields = [];
        $inter = [];
        $values = [];

        foreach ($this as $k => $v) {
            if (!is_null($v) && $k != 'db' && $k != 'table') {
                $fields[] = $k;
                $inter[] = ":$k";
                $values[$k] = $v;
            }
        }

        $fields_list = implode(', ', $fields);
        $inter_list = implode(', ', $inter);

        return $this->query("INSERT INTO {$this->table} ({$fields_list}) VALUES ({$inter_list})", $values);
    }

    public function update(int $id): bool|PDOStatement {
        $fields = [];
        $values = [];

        foreach ($this as $k => $v) {
            if (!is_null($v) && $k != 'db' && $k != 'table') {
                $fields[] = "$k = :$k";
                $values[$k] = $v;
            }
        }

        $fields_list = implode(', ', $fields);

        return $this->query("UPDATE {$this->table} SET {$fields_list} WHERE id = $id", $values);
    }

    public function delete(int $id): bool|PDOStatement {
        return $this->query("DELETE FROM {$this->table} WHERE id = :id", ['id' => $id]);
    }

    public function hydrate(array $data): self {
        foreach ($data as $k => $v) {
            $setter = 'set' . ucfirst($k);

            if (method_exists($this, $setter)) $this->$setter($v);
        }

        return $this;
    }

}
