<?php

declare(strict_types=1);

namespace App\Controller;

use App\DevTools\PHPStan\IKnowWhatImDoingThisIsAPublicRoute;
use App\DevTools\PHPStan\ThisRouteDoesntNeedAVoter;
use App\Entity\MasterPayment;
use App\Entity\User;
use App\Entity\UserPayment;
use OneLogin\Saml2\Auth;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Synfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use App\Entity\UserToken;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Authentication\Token\JWTUserToken;

class AuthController extends AbstractController
{
    public function __construct(
        private readonly Auth $auth,
        private readonly string $appUrl,
        private readonly EntityManagerInterface $entityManager,
        private readonly UserRepository $userRepository,
    ) {
    }

    #[IKnowWhatImDoingThisIsAPublicRoute]
    #[Route('/auth/sso/saml2/login', name: 'api_login_saml2', methods: ['POST'])]
    public function samlLogin(): Response
    {
        // Redirect to the frontend
        return new RedirectResponse($this->appUrl);
    }


    #[Route('/test', name: 'test', methods: ['GET'])]
    #[IKnowWhatImDoingThisIsAPublicRoute]
    public function test(): JsonResponse
    {
        return new JsonResponse("Test");
    }

    #[Route('/login', name: 'api_login', methods: ['POST'])]
    #[IKnowWhatImDoingThisIsAPublicRoute]
    public function login(#[CurrentUser]
    User|null $user): JsonResponse
    {
        $userData = $this->userRepository->findOneBy(['email' => $user->getEmail()]);
        $allPaymentResultCount = $this->entityManager->getRepository(UserPayment::class)->count(['user' => $user]);
        $resultsNotLabel = $this->entityManager->getRepository(UserPayment::class)->count(['user' => $user, 'payment' => null]);

        $score = 0;
        $level1 = 5;
        $level2 = 3;
        $level3 = 1;
        $results = $allPaymentResultCount;
        if ($results < 10) {
            $score = $level1 * $results;
        } else if ($results > 10 && $results < 30) {
            $score = $level1 * 10;
            $level2Value = $results - 10;
            $score += $level2Value * $level2;
        } else {
            $score = $level1 * 10;
            $score += $level2 * 20;
            $level3Value = $results - 30;
            $score += $level3Value * $level3;
        }


        return new JsonResponse(['data' => $userData, 'AllPayment' => $allPaymentResultCount, 'NotPaymentLabel' => $resultsNotLabel, 'score' => $score], Response::HTTP_OK);
    }

    #[Route('/auth/me', name: 'api_me')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[ThisRouteDoesntNeedAVoter]
    public function getLoggedUser(#[CurrentUser]
    User $user,): JsonResponse
    {

        $allPaymentResultCount = $this->entityManager->getRepository(UserPayment::class)->count(['user' => $user]);
        $AllPaymentData = $this->entityManager->getRepository(UserPayment::class)->findBy(['user' => $user]);
        $resultsNotLabel = $this->entityManager->getRepository(UserPayment::class)->count(['user' => $user, 'payment' => null]);

        $score = 0;
        $level1 = 5;
        $level2 = 3;
        $level3 = 1;
        $results = $allPaymentResultCount;
        if ($results < 10) {
            $score = $level1 * $results;
        } else if ($results > 10 && $results < 30) {
            $score = $level1 * 10;
            $level2Value = $results - 10;
            $score += $level2Value * $level2;
        } else {
            $score = $level1 * 10;
            $score += $level2 * 20;
            $level3Value = $results - 30;
            $score += $level3Value * $level3;
        }


        $totalAmount = 0;
        foreach ($AllPaymentData as $restresult) {
            $totalAmount += $restresult->getAmount();
        }



        return new JsonResponse(['data' => $user, 'totalAmount' => $totalAmount, 'AllPayment' => $allPaymentResultCount, 'NotPaymentLabel' => $resultsNotLabel, 'score' => $score], Response::HTTP_OK);
        // return new JsonResponse($user);
    }

    #[Route('/auth/sso/saml2/metadata', name: 'api_get_auth_sso_saml2_metadata')]
    #[IKnowWhatImDoingThisIsAPublicRoute]
    public function getMetadata(): Response
    {
        $auth = $this->auth;
        $settings = $auth->getSettings();
        $metadata = $settings->getSPMetadata(true);

        return new Response(content: $metadata, headers: ['content-type' => 'xml']);
    }
}
