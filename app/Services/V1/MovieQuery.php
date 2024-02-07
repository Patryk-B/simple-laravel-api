<?php

namespace App\Services\V1;

use Illuminate\Http\Request;

/**
 * this class attempts to parse user's query and then run eloquent's query.
 *
 * query is a user input, and the golden rule about user input is: NEVER TRUST USER INPUT !!!
 */
class MovieQuery {

    /**
     * params by which we can query:
     */
    protected $safeParams = [
        'title' => ['eq'],
        'country' => ['eq'],
        // 'genres' => ['in'], // TODO query json column.
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
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];

    /**
     * transforms user input into eloquent's query.
     */
    public function transform(Request $request) {
        $eloquentQuery = [];

        foreach ($this->safeParams as $param => $operators) {
            $query = $request->query($param);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloquentQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloquentQuery;
    }
}
