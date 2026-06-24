<?php

namespace EventSourcerer\EventSourcererCqrs\Repository;

use EventSourcerer\EventSourcererCqrs\Aggregate\Model\AggregateId;
use EventSourcerer\EventSourcererCqrs\Aggregate\Model\IsAggregate;
use PearTreeWebLtd\EventSourcererMessageUtilities\Model\StreamName;

interface AggregateRepository
{
    public function get(AggregateId $id): IsAggregate;

    public function save(IsAggregate $aggregate): void;

    public function stream(): StreamName;
}
