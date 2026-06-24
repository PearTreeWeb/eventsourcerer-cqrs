<?php

namespace EventSourcerer\EventSourcererCqrs\Stream;

use PearTreeWebLtd\EventSourcererMessageUtilities\Model\Checkpoint;
use PearTreeWebLtd\EventSourcererMessageUtilities\Model\Stream;
use PearTreeWebLtd\EventSourcererMessageUtilities\Model\StreamId;

interface StreamRepository
{
    public function get(StreamId $id, Checkpoint $checkpoint): iterable;

    public function save(Stream $aggregate): void;
}
