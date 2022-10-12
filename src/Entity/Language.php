<?php

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanguageRepository::class)]
class Language
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $typed = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $execution_speed = null;

    #[ORM\Column]
    private ?int $developpement_speed = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $documentation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $repository = null;

    #[ORM\ManyToOne(inversedBy: 'languages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?LanguageExecution $language_execution = null;

    #[ORM\OneToMany(mappedBy: 'language_id', targetEntity: LanguageParadigme::class)]
    private Collection $languageParadigmes;

    #[ORM\OneToMany(mappedBy: 'language', targetEntity: LanguageExemple::class)]
    private Collection $language_exemple;

    public function __construct()
    {
        $this->languageParadigmes = new ArrayCollection();
        $this->language_exemple = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function isTyped(): ?bool
    {
        return $this->typed;
    }

    public function setTyped(bool $typed): self
    {
        $this->typed = $typed;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getExecutionSpeed(): ?int
    {
        return $this->execution_speed;
    }

    public function setExecutionSpeed(int $execution_speed): self
    {
        $this->execution_speed = $execution_speed;

        return $this;
    }

    public function getDeveloppementSpeed(): ?int
    {
        return $this->developpement_speed;
    }

    public function setDeveloppementSpeed(int $developpement_speed): self
    {
        $this->developpement_speed = $developpement_speed;

        return $this;
    }

    public function getDocumentation(): ?string
    {
        return $this->documentation;
    }

    public function setDocumentation(string $documentation): self
    {
        $this->documentation = $documentation;

        return $this;
    }

    public function getRepository(): ?string
    {
        return $this->repository;
    }

    public function setRepository(?string $repository): self
    {
        $this->repository = $repository;

        return $this;
    }

    public function getLanguageExecution(): ?LanguageExecution
    {
        return $this->language_execution;
    }

    public function setLanguageExecution(?LanguageExecution $language_execution): self
    {
        $this->language_execution = $language_execution;

        return $this;
    }

    /**
     * @return Collection<int, LanguageParadigme>
     */
    public function getLanguageParadigmes(): Collection
    {
        return $this->languageParadigmes;
    }

    public function addLanguageParadigme(LanguageParadigme $languageParadigme): self
    {
        if (!$this->languageParadigmes->contains($languageParadigme)) {
            $this->languageParadigmes->add($languageParadigme);
            $languageParadigme->setLanguageId($this);
        }

        return $this;
    }

    public function removeLanguageParadigme(LanguageParadigme $languageParadigme): self
    {
        if ($this->languageParadigmes->removeElement($languageParadigme)) {
            // set the owning side to null (unless already changed)
            if ($languageParadigme->getLanguageId() === $this) {
                $languageParadigme->setLanguageId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LanguageExemple>
     */
    public function getLanguageExemple(): Collection
    {
        return $this->language_exemple;
    }

    public function addLanguageExemple(LanguageExemple $languageExemple): self
    {
        if (!$this->language_exemple->contains($languageExemple)) {
            $this->language_exemple->add($languageExemple);
            $languageExemple->setLanguage($this);
        }

        return $this;
    }

    public function removeLanguageExemple(LanguageExemple $languageExemple): self
    {
        if ($this->language_exemple->removeElement($languageExemple)) {
            // set the owning side to null (unless already changed)
            if ($languageExemple->getLanguage() === $this) {
                $languageExemple->setLanguage(null);
            }
        }

        return $this;
    }

}
