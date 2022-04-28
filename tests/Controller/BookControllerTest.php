<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookControllerTest extends WebTestCase
{
    public function testBooksByCategory()
    {
        $client = static::createClient();
        $client->request('GET', '/api/v1/category/19/books');
        $requestContent = $client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertJsonStringEqualsJsonFile(
            __DIR__.'/responses/BookControllerTest.testBooksByCategory.json',
            $requestContent
        );
    }
}
