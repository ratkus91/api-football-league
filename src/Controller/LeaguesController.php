<?php

namespace App\Controller;

use App\Entity\League;
use App\Services\LeagueService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class LeaguesController.
 *
 * @Route("/api/v1/leagues")
 */
class LeaguesController extends Controller
{
    protected $context = ['groups' => ['group']];

    /**
     * @Route("/", name="leagues")
     * @Method("GET")
     *
     * @param Request       $request
     * @param LeagueService $leagueService
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(Request $request, LeagueService $leagueService)
    {
        return $this->json(
            $leagueService->findByParams($request->query),
            JsonResponse::HTTP_OK,
            [],
            $this->context
        );
    }

    /**
     * @Route("/{id}", name="leagues_delete")
     * @Method("DELETE")
     *
     * @param League        $league
     * @param LeagueService $leagueService
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function delete(League $league, LeagueService $leagueService)
    {
        try {
            $leagueService->delete($league);

            return $this->json(null, JsonResponse::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return $this->json($e->getMessage(), JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}
