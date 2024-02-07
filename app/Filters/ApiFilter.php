<?php

namespace App\Filters;

use Illuminate\Http\Request;

/**
 * this class attempts to parse user's query and then run eloquent's query.
 *
 * query is a user input, and the golden rule about user input is: NEVER TRUST USER INPUT !!!
 */
class ApiFilter {

    /**
     * params by which we can queried.
     */
    protected $safeParams = [];

    /**
     * database uses `underscore_case`, in json we should use `camelCase`, map between the two.
     */
    protected $columnMap = [];

    /**
     * map operators.
     */
    protected $operatorMap = [
        // 'eq' => '=',
        // 'lt' => '<',
        // 'lte' => '<=',
        // 'gt' => '>',
        // 'gte' => '>=',
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
