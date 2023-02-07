<?php
/*
 * custom helper functions
 */

if (! function_exists('userTimezone')) {
    function userTimezone() {
//        return config('app.timezone');
        return (auth()->check() && auth()->user()->branches()->first()->timezone) ? auth()->user()->branches()->first()->timezone : config('app.timezone');
    }
}