<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\UserPayments;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserPaymentRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\DevTools\PHPStan\ThisRouteDoesntNeedAVoter;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Security\Voter\UserVoter;

class UserPaymentsController extends AbstractController
{

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserPaymentRepository $userPaymentRepository,
        private readonly UserRepository $userRepository,

    ) {
    }


    #[Route('/user/payments', name: 'app_user_payments', methods: ['GET'])]
    #[IsGranted(UserVoter::VIEW_ANY_USER)]
    #[ThisRouteDoesntNeedAVoter]
    public function listUserPayments(\Symfony\Bundle\SecurityBundle\Security $security): JsonResponse
    {
        $data = $this->userPaymentRepository->findAll();
        return new JsonResponse($data);
    }
}
