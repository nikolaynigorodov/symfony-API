<?php

namespace App\Service;

use App\Entity\Subscriber;
use App\Exception\SubscriberAlreadyExistException;
use App\Model\SubscriberRequest;
use App\Repository\SubscriberRepository;
use Doctrine\ORM\EntityManagerInterface;

class SubscriberServices
{
    public function __construct(private SubscriberRepository $subscriberRepository, private EntityManagerInterface $em)
    {
    }

    public function subscribe(SubscriberRequest $request): void
    {
        if ($this->subscriberRepository->existsByEmail($request->getEmail())) {
            throw new SubscriberAlreadyExistException();
        }

        $subscriber = new Subscriber();
        $subscriber->setEmail($request->getEmail());

        $this->em->persist($subscriber);
        $this->em->flush();
    }
}
