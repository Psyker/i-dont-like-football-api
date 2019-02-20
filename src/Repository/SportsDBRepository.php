<?php

namespace App\Repository;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class SportsDBRepository
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var Logger
     */
    private $logger;

    // I choose to not create models to map data because of the context of a simple wrapper

    public function __construct(LoggerInterface $logger)
    {
        // Creating the GuzzleHttp Client with env params.
        $this->client = new Client();
        $this->endpoint = getenv('API_HOST') . getenv('API_KEY');
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public function getAllLeagues(): array
    {
        // Log the exception.
        try {
            $response = $this->client->request('GET', $this->endpoint.'/all_leagues.php');
        } catch (GuzzleException $e) {
            $this->logger->addError($e->getMessage());
            return [];
        }

        return json_decode($response->getBody()->getContents(), true)['leagues'] ?? [];
    }

    /**
     * @param string $league
     * @return array
     */
    public function getTeamsByLeague(string $league): array
    {
        // https://www.thesportsdb.com/api/v1/json/1/search_all_teams.php
        // Log exception
        try {
            $response = $this->client->request('GET', $this->endpoint. "/search_all_teams.php?l=$league");
        } catch (GuzzleException $e) {
            $this->logger->addError($e->getMessage());
            return [];
        }

        return json_decode($response->getBody()->getContents(), true)['teams'] ?? [];
    }

    /**
     * @param int $id
     * @return array
     */
    public function getPlayersByTeam(int $id): array
    {
        // https://www.thesportsdb.com/api/v1/json/1/lookup_all_players.php?id=133604
        // Log exception
        try {
            $response = $this->client->request('GET', $this->endpoint. "/lookup_all_players.php?id=$id");
        } catch (GuzzleException $e) {
            $this->logger->addError($e->getMessage());
            return [];
        }

        return json_decode($response->getBody()->getContents(), true)['player'] ?? [];
    }
}
