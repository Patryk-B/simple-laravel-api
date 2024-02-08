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
     * database uses `underscore_case`, json standard expects `camelCase`, map between the two.
     */
    protected $columnMap = [
        // 'uploadedBy' => 'uploaded_by'
    ];

    /**
     * map operators
     */
    protected $operatorMap = [
        'eq' => '=',
    ];
}
