<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

/**
 *
 */
class CoversFilter extends ApiFilter {

    /**
     * params by which we can query:
     */
    protected $safeParams = [
        'movieId' => ['eq'],
    ];

    /**
     * database uses `underscore_case`, json standard expects `camelCase`, map between the two.
     */
    protected $columnMap = [
        'movieId' => 'movie_id'
    ];

    /**
     * map operators
     */
    protected $operatorMap = [
        'eq' => '=',
    ];
}
