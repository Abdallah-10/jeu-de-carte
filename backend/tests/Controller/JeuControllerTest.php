<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JeuControllerTest extends WebTestCase
{
    public function testRandomHand()
    {
        $client = static::createClient();
        $client->request('GET', '/api/random-hand');

        // Vérifie que la réponse est réussie
        $this->assertResponseIsSuccessful();

        // Vérifie que le contenu de la réponse est JSON
        $this->assertResponseHeaderSame('content-type', 'application/json');

        $data = json_decode($client->getResponse()->getContent(), true);

        $this->assertIsArray($data);
        $this->assertCount(10, $data); 
    }

    public function testSortHandSuccess()
    {
        $client = static::createClient();

        // Exemples de données pour la requête
        $hand = [
            ['value' => '5', 'color' => 'Cœur'],
            ['value' => '2', 'color' => 'Pique'],
            ['value' => '10', 'color' => 'Carreaux'],
        ];

        // Appel à l'endpoint POST /api/sort-hand
        $client->request(
            'POST',
            '/api/sort-hand',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($hand)
        );

        // Vérifie que la réponse est réussie
        $this->assertResponseIsSuccessful();

        // Vérifie que le contenu de la réponse est JSON
        $this->assertResponseHeaderSame('content-type', 'application/json');

        // Décoder la réponse JSON
        $data = json_decode($client->getResponse()->getContent(), true);

        // Vérifie que le résultat est trié 
        $this->assertIsArray($data);
        $this->assertCount(3, $data); 
        $this->assertEquals('2', $data[0]['value']); 
    }

    public function testSortHandWithValidData(): void
    {
        $client = static::createClient();

        $hand = [
            ['color' => 'Cœur', 'value' => 'AS'],
            ['color' => 'Carreaux', 'value' => '10'],
            ['color' => 'Trèfle', 'value' => 'Roi'],
        ];

        $client->request(
            'POST',
            '/api/sort-hand',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($hand)
        );

        $this->assertResponseIsSuccessful();

        $responseContent = $client->getResponse()->getContent();
        $sortedHand = json_decode($responseContent, true);

        $this->assertCount(3, $sortedHand);
        $this->assertEquals('Carreaux', $sortedHand[0]['color']); 
        $this->assertEquals('10', $sortedHand[0]['value']);      
    }

}
