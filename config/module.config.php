<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

use InteractiveSolutions\Postgres\AST\Functions\AllInArray;
use InteractiveSolutions\Postgres\AST\Functions\Arr;
use InteractiveSolutions\Postgres\AST\Functions\InArray;
use InteractiveSolutions\Postgres\Type\IntArray;
use InteractiveSolutions\Postgres\Type\StringArray;

return [
    'doctrine' => [
        'configuration' => [
            'orm_default' => [

                'types' => [
                    'string_array'  => StringArray::class,
                    'integer_array' => IntArray::class,
                ],

                'string_functions' => [
                    'ARR'          => Arr::class,
                    'IN_ARRAY'     => InArray::class,
                    'ALL_IN_ARRAY' => AllInArray::class,
                ],
            ],
        ],
    ],
];
