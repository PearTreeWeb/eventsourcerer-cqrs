<?php

declare(strict_types=1);

namespace EventSourcerer\EventSourcererCqrs\Aggregate\Model;

use PearTreeWebLtd\EventSourcererMessageUtilities\Model\FulfilIsString;
use PearTreeWebLtd\EventSourcererMessageUtilities\Model\IsString;

abstract readonly class AggregateId implements IsString
{
    use FulfilIsString;

    private static function validate(?string $value): void
    {
        // @todo check can be converted into Symfony uuid
    }

    public static function null(): self
    {
        return new static('00000000-0000-0000-0000-000000000000');
    }
}
