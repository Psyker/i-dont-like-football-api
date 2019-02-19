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

    public function __construct(LoggerInterface $logger)
    {
        $this->client = new Client();
        $this->endpoint = getenv('API_HOST') . getenv('API_KEY');
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public function getAllLeagues(): array
    {
        try {
            $response = $this->client->request('GET', $this->endpoint.'/all_leagues.php');
        } catch (GuzzleException $e) {
            $this->logger->addError($e->getMessage());
            return [];
        }

        return json_decode($response->getBody()->getContents(), true)['leagues'];
    }
}
