<?php

namespace App\Entity;

use App\Repository\MoyenDeLevageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MoyenDeLevageRepository::class)
 */
class MoyenDeLevage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $CMU;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $zoneservice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fournisseur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emplacement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statusmoyen;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateverifbv;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut_bv;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $motifbv;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pilotecloture;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $delais;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $actionscloture;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaires;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $certificatce;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ficheadequation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rapport;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $plan;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $notedecalcul;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imagemoyen;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $approbationqualite;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $approbationmaintenance;

    /**
     * @ORM\Column(type="date")
     */
    private $dateenregistrement;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_mise_ajour;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut_final;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mise_en_service;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->user_name;
    }

    public function setUserName(string $user_name): self
    {
        $this->user_name = $user_name;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

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

    public function getCMU(): ?int
    {
        return $this->CMU;
    }

    public function setCMU(int $CMU): self
    {
        $this->CMU = $CMU;

        return $this;
    }

    public function getZoneservice(): ?string
    {
        return $this->zoneservice;
    }

    public function setZoneservice(string $zoneservice): self
    {
        $this->zoneservice = $zoneservice;

        return $this;
    }

    public function getFournisseur(): ?string
    {
        return $this->fournisseur;
    }

    public function setFournisseur(string $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    public function getEmplacement(): ?string
    {
        return $this->emplacement;
    }

    public function setEmplacement(string $emplacement): self
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getStatusmoyen(): ?string
    {
        return $this->statusmoyen;
    }

    public function setStatusmoyen(string $statusmoyen): self
    {
        $this->statusmoyen = $statusmoyen;

        return $this;
    }

    public function getDateverifbv(): ?\DateTimeInterface
    {
        return $this->dateverifbv;
    }

    public function setDateverifbv(?\DateTimeInterface $dateverifbv): self
    {
        $this->dateverifbv = $dateverifbv;

        return $this;
    }

    public function getStatutBv(): ?string
    {
        return $this->statut_bv;
    }

    public function setStatutBv(?string $statut_bv): self
    {
        $this->statut_bv = $statut_bv;

        return $this;
    }

    public function getMotifbv(): ?string
    {
        return $this->motifbv;
    }

    public function setMotifbv(?string $motifbv): self
    {
        $this->motifbv = $motifbv;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getPilotecloture(): ?string
    {
        return $this->pilotecloture;
    }

    public function setPilotecloture(?string $pilotecloture): self
    {
        $this->pilotecloture = $pilotecloture;

        return $this;
    }

    public function getDelais(): ?\DateTimeInterface
    {
        return $this->delais;
    }

    public function setDelais(?\DateTimeInterface $delais): self
    {
        $this->delais = $delais;

        return $this;
    }

    public function getActionscloture(): ?string
    {
        return $this->actionscloture;
    }

    public function setActionscloture(?string $actionscloture): self
    {
        $this->actionscloture = $actionscloture;

        return $this;
    }

    public function getCommentaires(): ?string
    {
        return $this->commentaires;
    }

    public function setCommentaires(?string $commentaires): self
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    public function getCertificatce(): ?string
    {
        return $this->certificatce;
    }

    public function setCertificatce(?string $certificatce): self
    {
        $this->certificatce = $certificatce;

        return $this;
    }

    public function getFicheadequation(): ?string
    {
        return $this->ficheadequation;
    }

    public function setFicheadequation(?string $ficheadequation): self
    {
        $this->ficheadequation = $ficheadequation;

        return $this;
    }

    public function getRapport(): ?string
    {
        return $this->rapport;
    }

    public function setRapport(?string $rapport): self
    {
        $this->rapport = $rapport;

        return $this;
    }

    public function getPlan(): ?string
    {
        return $this->plan;
    }

    public function setPlan(?string $plan): self
    {
        $this->plan = $plan;

        return $this;
    }

    public function getNotedecalcul(): ?string
    {
        return $this->notedecalcul;
    }

    public function setNotedecalcul(?string $notedecalcul): self
    {
        $this->notedecalcul = $notedecalcul;

        return $this;
    }

    public function getImagemoyen(): ?string
    {
        return $this->imagemoyen;
    }

    public function setImagemoyen(?string $imagemoyen): self
    {
        $this->imagemoyen = $imagemoyen;

        return $this;
    }

    public function getApprobationqualite(): ?bool
    {
        return $this->approbationqualite;
    }

    public function setApprobationqualite(?bool $approbationqualite): self
    {
        $this->approbationqualite = $approbationqualite;

        return $this;
    }

    public function getApprobationmaintenance(): ?bool
    {
        return $this->approbationmaintenance;
    }

    public function setApprobationmaintenance(?bool $approbationmaintenance): self
    {
        $this->approbationmaintenance = $approbationmaintenance;

        return $this;
    }

    public function getDateenregistrement(): ?\DateTimeInterface
    {
        return $this->dateenregistrement;
    }

    public function setDateenregistrement(\DateTimeInterface $dateenregistrement): self
    {
        $this->dateenregistrement = $dateenregistrement;

        return $this;
    }

    public function getDateMiseAjour(): ?\DateTimeInterface
    {
        return $this->date_mise_ajour;
    }

    public function setDateMiseAjour(?\DateTimeInterface $date_mise_ajour): self
    {
        $this->date_mise_ajour = $date_mise_ajour;

        return $this;
    }

    public function getStatutFinal(): ?string
    {
        return $this->statut_final;
    }

    public function setStatutFinal(?string $statut_final): self
    {
        $this->statut_final = $statut_final;

        return $this;
    }

    public function getMiseEnService(): ?string
    {
        return $this->mise_en_service;
    }

    public function setMiseEnService(?string $mise_en_service): self
    {
        $this->mise_en_service = $mise_en_service;

        return $this;
    }
}
