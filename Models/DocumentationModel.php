<?php


namespace App\Models;


use App\Core\System\Model;

class DocumentationModel extends Model
{
    protected int $id;
    protected string $content;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return DocumentationModel
     */
    public function setId(int $id): DocumentationModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return DocumentationModel
     */
    public function setContent(string $content): DocumentationModel
    {
        $this->content = $content;
        return $this;
    }
}