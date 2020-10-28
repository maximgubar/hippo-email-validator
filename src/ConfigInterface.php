<?php

namespace Nrgone\EmailHippo\Validator;

interface ConfigInterface
{
    public function isEnabled(): bool;

    public function getApiUrl(): string;

    public function getApiKey(): string;

    public function getMinimumHippoScore(): float;
}
