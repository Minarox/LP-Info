<?php

namespace App\Models;

use App\Core\System\Model;

class DocumentationModel extends Model {

    protected int $id;
    protected int $user_id;
    protected string $content;
    protected string $title;
    protected string $created_at;

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     * @return DocumentationModel
     */
    public function setUserId(int $user_id): DocumentationModel {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string {
        return $this->content;
    }

    /**
     * @param string $content
     * @return DocumentationModel
     */
    public function setContent(string $content): DocumentationModel {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * @param string $title
     * @return DocumentationModel
     */
    public function setTitle(string $title): DocumentationModel {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string {
        return $this->created_at;
    }

}
