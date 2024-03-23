<?php

declare(strict_types=1);

namespace App\UseCase\User;

use App\Dto\Request\User\UpdateUserDto;
use App\Dto\Request\User\PaymentUserDto;
use App\Entity\User;
use App\Entity\MasterPayment;
use Doctrine\Persistence\ObjectManager;

class UpdateUserUseCase
{
    public function __construct(
        private readonly PasswordUseCase $passwordUseCase,
    ) {
    }

    public function updateUser(User $user, UpdateUserDto $userDto): User
    {
        $user->setEmail($userDto->getEmail());
        $this->passwordUseCase->updatePassword($user, $userDto);
        return $user;
    }


    public function updateUserPayment(ObjectManager $manager, MasterPayment $masterpayment, PaymentUserDto $payment): MasterPayment
    {
        $masterpayment->setPaymentLabel($payment->getPaymentLabel());
        $masterpayment->setDescription($payment->getDescription());
        $masterpayment->setLocalization($payment->getLocalization());
        $masterpayment->setGpsLocation($payment->getGpsLocation());
        $masterpayment->setGpsLocation($payment->getGpsLocation());
        $masterpayment->setDateTime(new \DateTime());
        $manager->persist($masterpayment);
        // $this->passwordUseCase->updatePassword($user, $payment);
        return $payment;
    }
}
