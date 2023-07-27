<?php declare(strict_types = 1);

namespace App\Score\Controller;

use App\Score\ScoreFacadeInterface;
use App\Score\Transfer\ScoreTransfer;
use App\Score\Validator\ScoreTermValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ScoreController extends AbstractController
{
    /**
     * @param \App\Score\Validator\ScoreTermValidatorInterface $scoreTermValidator
     * @param \App\Score\ScoreFacadeInterface $scoreFacade
     */
    public function __construct(
        private readonly ScoreTermValidatorInterface $scoreTermValidator,
        private readonly ScoreFacadeInterface $scoreFacade,
    ) {}

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $term = $request->query->get('term', false);
        if (!$this->scoreTermValidator->validateScoreTerm($term)) {
            throw new BadRequestHttpException();
        }

        $scoreDataRequest = new ScoreTransfer('github', (string) $term);
        $scoreDataResponse = $this->scoreFacade->hydrateScore($scoreDataRequest);

        return new JsonResponse(['data' => $scoreDataResponse->toArray()]);
    }
}
