<?php

declare(strict_types=1);

namespace App\Dto\Request\User;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

class CreateUserDto extends UserDtoAbstract
{
    #[Assert\NotBlank]
    #[Assert\PasswordStrength(['minScore' => Assert\PasswordStrength::STRENGTH_WEAK])]
    public string $password;
    public string $first_name;
    public string $last_name;
    // public  int $score;
    // public  DateTime $date_time;


    public function getPassword(): string
    {
        return $this->password;
    }


    public function getFirstName(): string
    {
        return $this->first_name;
    }
    public function getLastName(): string
    {
        return $this->last_name;
    }
    // public function getScore(): int
    // {
    //     return $this->score;
    // }

    // public function getDateTime(): DateTime
    // {
    //     return $this->date_time;
    // }
}
