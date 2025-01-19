<?php

namespace App\Service;

use App\Entity\Carte;

class DeckService
{
    private const COLORS = ['Carreaux', 'Cœur', 'Pique', 'Trèfle'];
    private const VALUES = ['AS', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'Valet', 'Dame', 'Roi'];

    /**
     * Génère une main de cartes aléatoire.
     *
     * @param int 
     * @return Carte[] 
     */
    public function generateRandomHand(int $handSize = 10): array
    {
        $deck = [];

        foreach (self::COLORS as $color) {
            foreach (self::VALUES as $value) {
                $deck[] = new Carte($color, $value);
            }
        }
        shuffle($deck);
        return array_slice($deck, 0, $handSize);
    }

    /**
     * Trie une main de cartes par couleur, puis par valeur.
     *
     * @param Carte[] 
     * @return Carte[] 
     */
    public function sortHand(array $hand): array
    {
        usort($hand, function (Carte $a, Carte $b) {
            $colorComparison = array_search($a->getColor(), self::COLORS) <=> array_search($b->getColor(), self::COLORS);

            if ($colorComparison === 0) {
                return array_search($a->getValue(), self::VALUES) <=> array_search($b->getValue(), self::VALUES);
            }

            return $colorComparison;
        });

        return $hand;
    }
}
