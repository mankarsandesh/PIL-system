<?php

declare(strict_types=1);

namespace App\Dto\Request\User;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

class PaymentUserDto
{
    public string $payment_label;
    public string $description;
    public string $localization;
    public string $gps_location;

    public function getPaymentLabel(): string
    {
        return $this->payment_label;
    }


    public function getDescription(): string
    {
        return $this->description;
    }
    public function getLocalization(): string
    {
        return $this->localization;
    }

    public function getGpsLocation(): string
    {
        return $this->gps_location;
    }
}
