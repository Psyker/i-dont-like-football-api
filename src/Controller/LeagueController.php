<?php

namespace App\Controller;

use App\Repository\SportsDBRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LeagueController extends AbstractController
{
    /**
     * @Route("/leagues", name="app_list_leagues")
     * @param SportsDBRepository $sportsDBRepository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function listLeagues(SportsDBRepository $sportsDBRepository)
    {
        $leagues = $sportsDBRepository->getAllLeagues();

        return $this->json($leagues);
    }
}
