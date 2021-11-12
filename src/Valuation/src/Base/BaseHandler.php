<?php

declare(strict_types=1);

namespace Valuation\Base;

use Psr\Http\Server\MiddlewareInterface;

abstract class BaseHandler implements MiddlewareInterface
{

    public function getLevelColor()
    {
        $colorLevel = [];
        $colorLevel[null] = 'gray';
        $colorLevel[1] = 'green';
        $colorLevel[2] = 'yellow';
        $colorLevel[3] = 'orange';
        $colorLevel[4] = 'red';

        return $colorLevel;
    }

    public function getLevelName()
    {
        $colorName = [];
        $colorName[null] = 'žádná';
        $colorName[1] = 'Nízká';
        $colorName[2] = 'Střední';
        $colorName[3] = 'Vysoká';
        $colorName[4] = 'Kritická';

        return $colorName;
    }

}