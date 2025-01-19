<?php

namespace App\Controller;

use App\Entity\Carte;
use App\Service\DeckService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class JeuController extends AbstractController
{
    #[Route('/api/random-hand', methods: ['GET'])]
    public function randomHand(DeckService $deckService): JsonResponse
    {
        $hand = $deckService->generateRandomHand();
        return $this->json($hand);
    }

    #[Route('/api/sort-hand', methods: ['POST'])]
    public function sortHand(Request $request, DeckService $deckService): JsonResponse
    {
        try {
            $handData = json_decode($request->getContent(), true);
            if (!$handData || !is_array($handData)) {
                return $this->json(['error' => 'Invalid data'], 400);
            }
            $hand = [];
            foreach ($handData as $cardData) {
                $hand[] = new Carte($cardData['color'], $cardData['value']);
            }
            $sortedHand = $deckService->sortHand($hand);

            return $this->json($sortedHand);
        } catch (\Exception $e) {
            return $this->json(['error' => 'Internal Server Error: ' . $e->getMessage()], 500);
        }
    }

}
