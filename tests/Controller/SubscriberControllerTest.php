<?php

namespace App\Tests\Controller;

use App\Tests\AbstractTestController;
use Symfony\Component\HttpFoundation\Response;

class SubscriberControllerTest extends AbstractTestController
{
    public function testSubscribe(): void
    {
        $content = json_encode(['email' => 'test@test.com', 'agreed' => true]);
        $this->client->request('POST', '/api/v1/subscriber', [], [], [], $content);

        $this->assertResponseIsSuccessful();
    }

    public function testSubscribeNotAgreed(): void
    {
        $content = json_encode(['email' => 'test@test.com']);
        $this->client->request('POST', '/api/v1/subscriber', [], [], [], $content);
        $responseContent = json_decode($this->client->getResponse()->getContent());

        $this->assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
        $this->assertJsonDocumentMatches($responseContent, [
            '$.message' => 'validation failed',
            '$.details.violation' => self::countOf(1),
            '$.details.violation[0].fields' => 'agreed',
        ]);
    }
}