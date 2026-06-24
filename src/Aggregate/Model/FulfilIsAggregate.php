<?php

declare(strict_types=1);

namespace EventSourcerer\EventSourcererCqrs\Aggregate\Model;

trait FulfilIsAggregate
{
    public function id(): AggregateId
    {
        return $this->id;
    }

    public function newEvents(): array
    {
        return $this->newEvents;
    }

    public function clearNewEvents(): void
    {
        $this->newEvents = [];
    }

    public function setCurrentVersion(int $currentVersion): void
    {
        $this->currentVersion = $currentVersion;
    }

    public function getCurrentVersion(): int
    {
        return $this->currentVersion;
    }

    public function nextVersion(): int
    {
        return $this->getCurrentVersion() +1;
    }

    public function isEmpty(): bool
    {
        return 0 === $this->getCurrentVersion();
    }
}
