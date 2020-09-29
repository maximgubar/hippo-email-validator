<?php

namespace Nrgone\EmailHippo\Validator;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Validator
{
    private Config $config;

    private HttpClientInterface $httpClient;

    private LoggerInterface $logger;

    public function __construct(Config $config, HttpClientInterface $httpClient, LoggerInterface $logger)
    {
        $this->config = $config;
        $this->httpClient = $httpClient;
        $this->logger = $logger;
    }

    public function isValid(string $email): bool
    {
        if (!$this->config->isEnabled()) {
            return true;
        }

        try {
            $validationResult = $this->validate($email);
            return isset($validationResult['hippoTrust']['score'])
                && ((float)$validationResult['hippoTrust']['score'] >= $this->config->getMinimumHippoScore());
        } catch (\Exception $exception) {
            $this->logger->error(sprintf('Failed to validate email [%s].', $email));
            $this->logger->error($exception->getMessage(), $exception->getTrace());
            return false;
        }
    }

    private function validate($email): array
    {
        $response = $this->httpClient->request(
            'GET',
            sprintf(
                '%s/more/json/%s/%s',
                $this->config->getApiUrl(),
                $this->config->getApiKey(),
                $email
            )
        );
        return $response->toArray();
    }
}
