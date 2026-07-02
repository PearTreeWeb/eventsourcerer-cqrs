<?php

declare(strict_types=1);

namespace EventSourcerer\EventSourcererCqrs\Repository;

use EventSourcerer\EventSourcererCqrs\Aggregate\Model\AggregateId;
use EventSourcerer\EventSourcererCqrs\Aggregate\Model\IsAggregate;
use PearTreeWebLtd\EventSourcererMessageUtilities\Model\Checkpoint;

abstract class EventSourcererAggregateRepository implements AggregateRepository
{
    public function __construct(
        private StreamRepository $streamRepository,
        private IsAggregate $createBasketAggregate
    ) {}

    public function get(AggregateId $id): IsAggregate
    {
        return $this->createBasketAggregate->fromEvents(
            $this->streamRepository->get(BasketAggregate::streamId($id), Checkpoint::zero())
        );
    }

    public function save(IsAggregate $aggregate): void
    {
        if ($aggregate::class !== BasketAggregate::class) {
            throw UnexpectedAggregateType::cannotSaveAggregateWithType(
                $aggregate::class,
                BasketAggregate::class
            );
        }

        $aggregate = $this->createBasketAggregate->withNewEvents($aggregate);

        $this->streamRepository->save(
            new Stream(
                BasketAggregate::streamId($aggregate->id()),
                $aggregate::streamName(),
                $aggregate->newEvents(),
                $aggregate->getCurrentVersion(),
            )
        );

        $aggregate->clearNewEvents();
    }

    public function stream(): StreamName
    {
        return StreamName::fromString(self::STREAM_NAME);
    }
}
