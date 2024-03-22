<?php

namespace App\Entity;

use App\Repository\MasterPaymentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MasterPaymentRepository::class)]
class MasterPayment
{
    public function __construct(
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?string $id = null,

        #[ORM\Column(length: 255)]
        private ?string $payment_label = null,

        #[ORM\Column(length: 255)]
        private ?string $description = null,

        #[ORM\Column(length: 255, nullable: true)]
        private ?string $localization = null,

        #[ORM\Column(length: 50)]
        private ?string $gps_location = null,

        #[ORM\Column(type: Types::DATETIME_MUTABLE)]
        private ?\DateTimeInterface $date_time = null,

        #[ORM\ManyToOne]
        #[ORM\JoinColumn(nullable: false)]
        private ?User $user = null,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaymentLabel(): ?string
    {
        return $this->payment_label;
    }

    public function setPaymentLabel(string $payment_label): static
    {
        $this->payment_label = $payment_label;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLocalization(): ?string
    {
        return $this->localization;
    }

    public function setLocalization(?string $localization): static
    {
        $this->localization = $localization;

        return $this;
    }

    public function getGpsLocation(): ?string
    {
        return $this->gps_location;
    }

    public function setGpsLocation(string $gps_location): static
    {
        $this->gps_location = $gps_location;

        return $this;
    }

    public function getDateTime(): ?\DateTimeInterface
    {
        return $this->date_time;
    }

    public function setDateTime(\DateTimeInterface $date_time): static
    {
        $this->date_time = $date_time;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
