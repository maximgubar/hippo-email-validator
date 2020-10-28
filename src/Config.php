<?php

namespace Nrgone\EmailHippo\Validator;

class Config implements ConfigInterface
{
    private bool $isEnabled;

    private string $apiUrl;

    private string $apiKey;

    private float $minimumHippoScore;

    public function __construct(
        bool $isEnabled,
        string $apiUrl,
        string $apiKey,
        float $minimumHippoScore
    ) {
        $this->isEnabled = $isEnabled;
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;
        $this->minimumHippoScore = $minimumHippoScore;
    }

    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getMinimumHippoScore(): float
    {
        return $this->minimumHippoScore;
    }
}
