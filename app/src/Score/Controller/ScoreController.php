<?php declare(strict_types = 1);

namespace App\Score\Controller;

use App\HsRedis\ScoreFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ScoreController
{
    public function index(Request $reuqest): JsonResponse
    {
        $term = (string) $reuqest->query->get('term', false);

        if (!$term || strlen($term) > 64) {
            return new JsonResponse([]);
        }

        $score = (new ScoreFactory())->createScore()->getKeyByTerm($term);

        return new JsonResponse([
            'term' => $term,
            'score' => $score
        ]);
    }
}
