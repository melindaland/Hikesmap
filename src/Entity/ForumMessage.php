<?php

namespace App\Entity;

use App\Repository\ForumMessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ForumMessageRepository::class)]
class ForumMessage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'forumMessages')]
    private ?ForumSujet $sujet = null;

    #[ORM\ManyToOne(inversedBy: 'forumMessages')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }


    public function getSujet(): ?ForumSujet
    {
        return $this->sujet;
    }

    public function setSujet(?ForumSujet $sujet): static
    {
        $this->sujet = $sujet;

        return $this;
    }
}
