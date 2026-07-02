<?php

declare(strict_types=1);

namespace EventSourcerer\EventSourcererCqrs\Aggregate;

use PearTreeWebLtd\EventSourcererMessageUtilities\Model\IsEvent;

abstract class Aggregate
{
    /**
     * @param IsEvent[] $newEvents
     */
    protected function __construct(
        protected array $newEvents = [],
        protected int $currentVersion = 0,
    ) {}

    public function addNewEvent(IsEvent $event): void
    {
        $this->newEvents[] = array_merge(
            ['version' => $event::version()->toInt()],
            $event->toArray(),
        );
    }
}
