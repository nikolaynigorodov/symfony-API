<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Model\SubscriberRequest;
use App\Service\SubscriberServices;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Model\ErrorResponse;

class SubscriberController extends AbstractController
{
    public function __construct(private SubscriberServices $subscriberServices)
    {
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Subscribe email to newsletter mailing list"
     * )
     * @OA\Response(
     *     response="400",
     *     description="Validation failed",
     *     @Model(type=ErrorResponse::class)
     * )
     * @OA\RequestBody(@Model(type=SubscriberRequest::class))
     */
    #[Route(path: '/api/v1/subscriber', methods: ['POST'])]
    public function subscribe(#[RequestBody] SubscriberRequest $subscriberRequest): Response // from arguments will be called RequestBodyArgumentResolver.php
    {
        $this->subscriberServices->subscribe($subscriberRequest);

        return $this->json(null);
    }
}
