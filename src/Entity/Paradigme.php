<?php

namespace App\Entity;

use App\Repository\ParadigmeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParadigmeRepository::class)]
class Paradigme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'paradigme_id', targetEntity: LanguageParadigme::class)]
    private Collection $languageParadigmes;

    public function __construct()
    {
        $this->languageParadigmes = new ArrayCollection();
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
            $languageParadigme->setParadigmeId($this);
        }

        return $this;
    }

    public function removeLanguageParadigme(LanguageParadigme $languageParadigme): self
    {
        if ($this->languageParadigmes->removeElement($languageParadigme)) {
            // set the owning side to null (unless already changed)
            if ($languageParadigme->getParadigmeId() === $this) {
                $languageParadigme->setParadigmeId(null);
            }
        }

        return $this;
    }
}
