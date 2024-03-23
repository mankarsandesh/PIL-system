<?php

declare(strict_types=1);

namespace App\UseCase\User;

use App\Dto\Request\User\CreateUserDto;
use App\Dto\Request\User\PaymentUserDto;
use App\Entity\MasterPayment;
use App\Entity\User;
use App\Exception\User\UnexpectedNotUpdatedPassword;
use App\Mailer\UserMailer;
use App\Repository\UserRepository;
use App\Repository\MasterPaymentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserPaymentUseCase
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly MasterPaymentRepository $mastersRepository,
        private readonly UserMailer $userMailer,
        private readonly PasswordUseCase $passwordUseCase,
    ) {
    }

    public function masterPayment(PaymentUserDto $payment): MasterPayment
    {
        $data = $this->mastersRepository->paymentLink($payment);
        $this->entityManager->persist($data);
        return $data;
    }
}
