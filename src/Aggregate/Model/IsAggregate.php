<?php

declare(strict_types=1);

namespace EventSourcerer\EventSourcererCqrs\Aggregate\Model;

use EventSourcerer\EventSourcererCqrs\Common\IsEvent;
use PearTreeWebLtd\EventSourcererMessageUtilities\Model\StreamName;

interface IsAggregate
{
    public function id(): AggregateId;

    /**
     * @return array[]
     */
    public function newEvents(): array;

    public function clearNewEvents(): void;

    public function applyEvent(IsEvent $event, int $currentVersion): void;

    public static function streamName(): StreamName;

    public function setCurrentVersion(int $currentVersion): void;

    public function getCurrentVersion(): int;

    public function nextVersion(): int;

    public function isEmpty(): bool;
}
