<?php

declare(strict_types=1);

namespace EventSourcerer\EventSourcererCqrs\Factory;

use EventSourcerer\EventSourcererCqrs\Aggregate\Model\IsAggregate;
use PearTreeWebLtd\EventSourcererMessageUtilities\Factory\InstantiateEventFromArray;
use PearTreeWebLtd\EventSourcererMessageUtilities\Model\EventName;
use PearTreeWebLtd\EventSourcererMessageUtilities\Model\EventVersion;
use PearTreeWebLtd\EventSourcererMessageUtilities\Service\ProvideEventClassPath;

final readonly class ReinstantiateAggregate
{
    /**
     * @param class-string<IsAggregate> $aggregateClass
     * @param iterable<array{eventName: string, properties: array<string, mixed>, version: string}> $events
     */
    public function fromEvents(
        ProvideEventClassPath $provideEventClassPath,
        string $aggregateClass,
        iterable $events
    ): IsAggregate {
        $aggregate = $aggregateClass::create();

        $i = 0;

        foreach ($events as $event) {
            $i++;

            $aggregate->applyEvent(
                InstantiateEventFromArray::with(
                    $provideEventClassPath->for(EventName::fromString($event['eventName'])),
                    $event['properties']
                ),
                EventVersion::fromString($event['version'])->toInt()
            );

            $aggregate->setCurrentVersion($i);
        }

        return $aggregate;
    }

    public function withNewEvents(ProvideEventClassPath $provideEventClassPath, IsAggregate $aggregate): IsAggregate
    {
        foreach ($aggregate->newEvents() as $rawEvent) {
            $event = InstantiateEventFromArray::with(
                $provideEventClassPath->for(EventName::fromString($rawEvent['name'])),
                $rawEvent
            );
            $aggregate->applyEvent($event, $aggregate->nextVersion());
        }

        return $aggregate;
    }
}
