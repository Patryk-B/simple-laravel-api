<?php

namespace App\Helpers;

class ValidGenres {

    /**
     * Get list of valid genres.
     */
    public static function get() {
        return [
            'Action',
            'Adventure',
            'Animation',
            'Biography',
            'Comedy',
            'Costume',
            'Crime',
            'Documentary',
            'Drama',
            'Family',
            'Fantasy',
            'History',
            'Horror',
            'Kung-fu',
            'Musical',
            'Mystery',
            'Romance',
            'Sci-Fi',
            'Talk-Show',
            'Thriller',
            'War',
            'Western'
        ];
    }
}
