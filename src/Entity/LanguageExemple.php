<?php

namespace App\Entity;

use App\Repository\LanguageExempleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanguageExempleRepository::class)]
class LanguageExemple
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column]
    private ?int $execution = null;

    #[ORM\OneToMany(mappedBy: 'languageExemple', targetEntity: LanguageExempleType::class)]
    private Collection $type;

    #[ORM\ManyToOne(inversedBy: 'language_exemple')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Language $language = null;

    public function __construct()
    {
        $this->type = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getExecution(): ?int
    {
        return $this->execution;
    }

    public function setExecution(int $execution): self
    {
        $this->execution = $execution;

        return $this;
    }

    /**
     * @return Collection<int, LanguageExempleType>
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function addType(LanguageExempleType $type): self
    {
        if (!$this->type->contains($type)) {
            $this->type->add($type);
            $type->setLanguageExemple($this);
        }

        return $this;
    }

    public function removeType(LanguageExempleType $type): self
    {
        if ($this->type->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getLanguageExemple() === $this) {
                $type->setLanguageExemple(null);
            }
        }

        return $this;
    }

    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    public function setLanguage(?Language $language): self
    {
        $this->language = $language;

        return $this;
    }
}
