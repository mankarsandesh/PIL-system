<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\UserPayments;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserPaymentRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserPaymentsController extends AbstractController
{

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserPaymentRepository $UserPaymentRepository,
    ) {
    }


    #[Route('/user/payments', name: 'app_user_payments')]
    public function index(): JsonResponse
    {

        $data = $this->UserPaymentRepository->findAll();

        return new JsonResponse($data);


        // return $this->render('user_payments/index.html.twig', [
        //     'controller_name' => 'UserPaymentsController',
        // ]);
    }
}
