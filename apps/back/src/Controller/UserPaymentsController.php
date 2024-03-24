<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\UserPayments;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserPaymentRepository;
use App\Repository\MasterPaymentRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\DevTools\PHPStan\ThisRouteDoesntNeedAVoter;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Security\Voter\UserVoter;
use App\UseCase\User\UpdateUserUseCase;
use App\UseCase\User\UserPaymentUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use App\Dto\Request\User\PaymentUserDto;
use App\Entity\MasterPayment;
use App\Entity\UserPayment;
use App\Entity\User;

class UserPaymentsController extends AbstractController
{

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserPaymentRepository $userPaymentRepository,
        private readonly MasterPaymentRepository $masterPaymentRepository,
        private readonly UserRepository $userRepository,
        private readonly UpdateUserUseCase $updateUser,
        private readonly UserPaymentUseCase $userPayment,

    ) {
    }


    #[Route('/user/payments', name: 'app_user_payments', methods: ['GET'])]
    #[ThisRouteDoesntNeedAVoter]
    public function listUserPayments(\Symfony\Bundle\SecurityBundle\Security $security): JsonResponse
    {
        $user = $security->getUser();
        $data = $this->userPaymentRepository->findBy(['user' => $user]);
        if (!$data) {
            return new JsonResponse(['message' => 'User payments list not found'], Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }


    #[Route('/payment/link', name: 'payment_link', methods: ['POST'])]
    #[IsGranted(UserVoter::CREATE_USER)]
    #[ThisRouteDoesntNeedAVoter]
    public function masterPayment(#[MapRequestPayload]  Request $request): JsonResponse
    {
        $payment = json_decode($request->getContent(), true);
        // Find Payment id exits or not
        $userPayment = $this->entityManager->getRepository(UserPayment::class)->find($payment['user_payment_id']);
        // $paymentId = $userPayment->getPayment();
        if (!$userPayment) {
            return new JsonResponse(['message' => 'User payment not found'], Response::HTTP_NOT_FOUND);
        }
        $paymentId = $userPayment->getPayment();
        // add new master payment information
        $data = new MasterPayment();
        $data->setPaymentLabel($payment['payment_label']);
        $data->setDescription($payment['description']);
        $data->setLocalization($payment['localization']);
        $data->setGpsLocation($payment['gps_location']);
        $data->setUser($this->getUser());
        $data->setDateTime(new \DateTime());

        $this->entityManager->persist($data);
        $this->entityManager->flush();

        // Master Payment Id fetch after save
        $userPayment->setPayment($data);
        $this->entityManager->persist($userPayment);
        $this->entityManager->flush();
        return new JsonResponse($userPayment);
    }
}
