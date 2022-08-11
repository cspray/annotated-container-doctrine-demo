<?php

namespace Cspray\AnnotatedContainerDoctrineDemo\Entity;

use Cspray\AnnotatedContainerDoctrineDemo\Doctrine\Repository\TodoRepository;
use Cspray\AnnotatedContainerDoctrineDemo\Model\TodoStatus;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Ramsey\Uuid\Doctrine\UuidType;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

#[Entity(repositoryClass: TodoRepository::class)]
class Todo {

    #[Id]
    #[Column(type: UuidType::NAME, unique: true)]
    private UuidInterface $id;

    #[Column]
    private string $title;

    #[Column(type: 'string', enumType: TodoStatus::class)]
    private TodoStatus $status;

    private function __construct(
        UuidInterface $id,
        string $title,
        TodoStatus $status
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->status = $status;
    }

    public static function newTask(string $title) : Todo {
        return new self(
            Uuid::uuid6(),
            $title,
            TodoStatus::ToDo
        );
    }

    public function getId() : UuidInterface {
        return $this->id;
    }

    public function getTitle() : string {
        return $this->title;
    }

    public function getStatus() : TodoStatus {
        return $this->status;
    }

    public function setStatus(TodoStatus $status) : void {
        $this->status = $status;
    }
}