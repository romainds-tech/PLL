<?php

namespace App\Entity;

use App\Repository\LanguageParadigmeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanguageParadigmeRepository::class)]
class LanguageParadigme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'languageParadigmes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Language $language_id = null;

    #[ORM\ManyToOne(inversedBy: 'languageParadigmes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Paradigme $paradigme_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLanguageId(): ?Language
    {
        return $this->language_id;
    }

    public function setLanguageId(?Language $language_id): self
    {
        $this->language_id = $language_id;

        return $this;
    }

    public function getParadigmeId(): ?Paradigme
    {
        return $this->paradigme_id;
    }

    public function setParadigmeId(?Paradigme $paradigme_id): self
    {
        $this->paradigme_id = $paradigme_id;

        return $this;
    }
}
