<?php

namespace App\Controller;

use App\Repository\SportsDBRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
    /**
     * @Route("/leagues/{name}/teams", name="app_list_league_teams")
     * @param SportsDBRepository $sportsDBRepository
     * @param string $name
     * @return JsonResponse
     */
    public function listLeagueTeams(SportsDBRepository $sportsDBRepository, string $name): JsonResponse
    {
        $teams = $sportsDBRepository->getTeamsByLeague($name);

        return $this->json($teams);
    }
}
