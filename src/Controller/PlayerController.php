<?php

namespace App\Controller;

use App\Repository\SportsDBRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PlayerController extends AbstractController
{
    /**
     * @Route("/teams/{id}/players", name="app_list_team_players")
     * @param SportsDBRepository $sportsDBRepository
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function listTeamPlayers(SportsDBRepository $sportsDBRepository, int $id): JsonResponse
    {
        $players = $sportsDBRepository->getPlayersByTeam($id);

        return $this->json($players);
    }
}
