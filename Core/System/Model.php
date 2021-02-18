<?php


namespace App\Core\System;


use App\Core\Database\Database;
use PDOStatement;

abstract class Model
{
    protected string $table;

    private function query(string $sql, array $params = null): bool|PDOStatement
    {
        $db = Database::getPDO();

        if ($params === null) return $db->query($sql);

        $query = $db->prepare($sql);
        $query->execute($params);
        return $query;
    }

    public function findAll(): array
    {
        return $this->query("SELECT * FROM {$this->table}")->fetchAll();
    }

    public function findById(int $id): array
    {
        return $this->query("SELECT * FROM {$this->table} WHERE id = {$id}")->fetch();
    }

    public function findBy(array $filter): array
    {
        $fields = [];
        $values = [];

        foreach ($filter as $k => $v) {
            $fields[] = "$k = :$k";
            $values[$k] = $v;
        }

        $fields_list = implode(' AND ', $fields);

        return $this->query("SELECT * FROM {$this->table} WHERE {$fields_list}", $values)->fetchAll();
    }

    public function findOneBy(array $filter): array|bool|PDOStatement
    {
        $fields = [];
        $values = [];

        foreach ($filter as $k => $v) {
            $fields[] = "$k = :$k";
            $values[$k] = $v;
        }

        $fields_list = implode(' AND ', $fields);

        return $this->query("SELECT * FROM {$this->table} WHERE {$fields_list}", $values)->fetch();
    }

    public function create(): bool|PDOStatement
    {
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

    public function update(int $id): bool|PDOStatement
    {
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

    public function delete(int $id): bool|PDOStatement
    {
        return $this->query("DELETE FROM {$this->table} WHERE id = :id", ['id' => $id]);
    }

    public function hydrate(array $data): self
    {
        foreach ($data as $k => $v) {
            $setter = 'set' . ucfirst($k);

            if (method_exists($this, $setter)) $this->$setter($v);
        }

        return $this;
    }
}