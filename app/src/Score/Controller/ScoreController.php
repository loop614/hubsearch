<?php declare(strict_types = 1);

namespace App\Score\Controller;

use App\Core\Controller\CoreController;
use App\HsRedis\ScoreFactory;
use App\Score\Transfer\ScoreTransfer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ScoreController extends CoreController
{
    const MAX_TERM_SIZE = 16;

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $term = $request->query->get('term', false);

        if (!$term || strlen($term) > self::MAX_TERM_SIZE) {
            throw new BadRequestHttpException();
        }

        $scoreDataRequest = new ScoreTransfer('github', (string) $term);
        $scoreDataResponse = (new ScoreFactory())
            ->createScore()
            ->hydrateScore($scoreDataRequest);
        return new JsonResponse(
            ['data' => $scoreDataResponse->toArray()]
        );
    }
}
