<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MiddlewareBase
{
    protected $currentDateTime;

    public function __construct()
    {
        // Get current date and time from the database
        $this->currentDateTime = DB::select('select NOW()::timestamp as date_time;')[0]->date_time;
    }

    /**
     * Method to retrieve the current date and time from the database.
     *
     * @return string
     */
    protected function getCurrentDateTime()
    {
        return $this->currentDateTime;
    }

    /**
     * Method to retrieve the instance of the authenticated user.
     *
     * @param Request $request
     * @return object|null
     */
    protected function getUserModelInstance(Request $request)
    {
        // Return the authenticated user using Laravel's Auth system
        return Auth::user();
    }
}
