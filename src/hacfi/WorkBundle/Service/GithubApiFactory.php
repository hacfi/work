<?php

namespace hacfi\WorkBundle\Service;

use Github\Client;
use Github\Api\CurrentUser;
use Github\HttpClient\CachedHttpClient;

class GithubApiFactory
{
    private $client;

    /**
     * Constructor.
     */
    public function __construct($githubUsername, $githubPassword)
    {
        $client = new Client(
            new CachedHttpClient(array('cache_dir' => '/tmp/github-api-cache'))
        );
        $client->authenticate($githubUsername, $githubPassword, Client::AUTH_HTTP_PASSWORD);

        $this->client = $client;
    }


    /**
     * @param $apiName
     * @return \Github\Api\ApiInterface
     */
    public function getApi($apiName)
    {
        return $this->client->api($apiName);
    }

    public function getClient()
    {
        return $this->client;
    }
}
