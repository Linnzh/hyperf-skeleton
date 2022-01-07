<?php

declare(strict_types=1);

namespace App\Lib;

use Hyperf\Constants\AbstractConstants;

class Enum extends AbstractConstants
{
    public static function toArray()
    {
        $r = new \ReflectionClass(static::class);
        $list = $r->getConstants();

        $class = make(static::class);

        $result = [];

        foreach ($list as $item) {
            $name = $class::getMessage($item);
            $result[] = [
                'id' => $item,
                'name' => $name
            ];
        }

        return $result;
    }
}
