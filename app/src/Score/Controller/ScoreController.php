<?php declare(strict_types = 1);

namespace App\Score\Controller;

use App\Core\Controller\CoreController;
use App\Score\Transfer\ScoreTransfer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @method \App\Score\ScoreFacade getFacade()
 * @method \App\Score\ScoreFactory getFactory()
 */
class ScoreController extends CoreController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $term = $request->query->get('term', false);
        if (!$this->getFactory()->createScoreTermValidator()->validateScoreTerm($term)) {
            throw new BadRequestHttpException();
        }

        $scoreDataRequest = new ScoreTransfer('github', (string) $term);
        $scoreDataResponse = $this->getFacade()->hydrateScore($scoreDataRequest);

        return new JsonResponse(['data' => $scoreDataResponse->toArray()]);
    }
}
