<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

/**
 *
 */
class MoviesFilter extends ApiFilter {

    /**
     * params by which we can query:
     */
    protected $safeParams = [
        'title' => ['eq'],
        'country' => ['eq'],
    ];

    /**
     * map operators
     */
    protected $operatorMap = [
        'eq' => '=',
    ];
}
