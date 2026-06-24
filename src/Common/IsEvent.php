<?php

namespace EventSourcerer\EventSourcererCqrs\Common;

use PearTreeWebLtd\EventSourcererMessageUtilities\Model\CanBeRepresentedAsArray;
use PearTreeWebLtd\EventSourcererMessageUtilities\Model\EventVersion;

interface IsEvent extends CanBeRepresentedAsArray
{
    public static function name(): string;

    public static function version(): EventVersion;
}
