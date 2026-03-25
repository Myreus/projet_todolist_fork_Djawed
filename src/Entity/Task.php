<?php

namespace App\Entity;

use App\Entity\Category;
use App\Entity\Account;
use DateTime;

class Task
{
    private ?int $id;
    private string $title;
    private string $description;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;
    private ?\DateTime $finishOn;
    private ?string $repeat;
    private bool $status;
    private Account $author;
    private array $categories;

    public function __construct(
        string $title,
        string $description,
        \DateTime $createdAt,
        Account $author
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->updatedAt = $createdAt;
        $this->status = true;
        $this->finishOn = $createdAt;
        $this->repeat = "";
        $this->author = $author;
        $this->categories = [];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getFinishOn(): ?\DateTime
    {
        return $this->finishOn;
    }

    public function setFinishOn(?\DateTime $finishOn): self
    {
        $this->finishOn = $finishOn;
        return $this;
    }

    public function getRepeat(): ?string
    {
        return $this->repeat;
    }

    public function setRepeat(?string $repeat): self
    {
        $this->repeat = $repeat;
        return $this;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getAuthor(): Account
    {
        return $this->author;
    }

    public function setAuthor(Account $author): self
    {
        $this->author = $author;
        return $this;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        $this->categories[] = $category;
        return $this;
    }

    public function removeCategory(Category $category): self
    {
        unset($this->categories[array_search($category, $this->categories)]);
        sort($this->categories);
        return $this;
    }

    public function __toString(): string
    {
        return $this->title
            . ", "
            . $this->description
            . ", "
            . $this->finishOn->format('d-m-Y');
    }
}
