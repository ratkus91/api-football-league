<?php

namespace App\Controller;

use App\Entity\League;
use App\Entity\Team;
use App\Services\TeamService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class TeamsController.
 *
 * @Route("/api/v1/leagues/{league}/teams")
 * @ParamConverter("league", class="App\Entity\League", options={"id" = "league"})
 */
class TeamsController extends Controller
{
    protected $context = ['groups' => ['group']];

    /**
     * @Route("/", name="teams")
     * @Method("GET")
     *
     * @param Request     $request
     * @param League      $league
     * @param TeamService $teamService
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(Request $request, League $league, TeamService $teamService)
    {
        return $this->json(
            $teamService->findByParams($request->query, $league),
            JsonResponse::HTTP_OK,
            [],
            $this->context
        );
    }

    /**
     * @Route("/", name="teams_create")
     * @Method("POST")
     *
     * @param Request     $request
     * @param League      $league
     * @param TeamService $teamService
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function create(Request $request, League $league, TeamService $teamService)
    {
        try {
            $team = $teamService->save($league, new Team(), $request->request);

            return $this->json($team, JsonResponse::HTTP_CREATED, [], $this->context);
        } catch (\Exception $e) {
            return $this->json($e->getMessage(), JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/{id}", name="teams_modify")
     * @Method("PUT")
     *
     * @param Request     $request
     * @param League      $league
     * @param Team        $team
     * @param TeamService $teamService
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function modify(Request $request, League $league, Team $team, TeamService $teamService)
    {
        try {
            $team = $teamService->save($league, $team, $request->query);

            return $this->json($team, JsonResponse::HTTP_OK, [], $this->context);
        } catch (\Exception $e) {
            return $this->json($e->getMessage(), JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}
