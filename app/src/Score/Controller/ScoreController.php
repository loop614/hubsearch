<?php declare(strict_types = 1);

namespace App\Score\Controller;

use App\HsRedis\ScoreFactory;
use App\Score\Carry\ScoreData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ScoreController extends AbstractController
{
    const MAX_TERM_SIZE = 16;

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $term = $request->query->get('term', false);

        if (!$term || strlen($term) > self::MAX_TERM_SIZE) {
            throw new BadRequestHttpException();
        }

        $scoreDataRequest = new ScoreData('github', (string) $term);
        $scoreDataResponse = (new ScoreFactory())
            ->createScore()
            ->hydrateScore($scoreDataRequest);

        return new JsonResponse(
            [
            'data' => [
                'term' => $scoreDataResponse->getTerm(),
                'score' => $scoreDataResponse->getScore(),
                'message' => $scoreDataResponse->getMessage(),
                'site' => $scoreDataResponse->getSite(),
            ]
            ]
        );
    }
}
