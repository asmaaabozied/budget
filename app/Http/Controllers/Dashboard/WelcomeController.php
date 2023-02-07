<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Rating;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    /*----------------------------------------------------
  || Name     : show to dashboard index with total all cruds       |
  || Tested   : Done                                    |
  ||                                     |
  ||                                    |
    -----------------------------------------------------*/
    public function index()
    {
        $todays = Carbon::now()->format('d');
        $lastmonth = 30;

        $remainday = $lastmonth - $todays;

        $date = Carbon::now()->format('d-m-Y');

        $today = Carbon::now();
        $dayName = $today->format('l');

        $subdate = Carbon::now()->subDays(30)->diffForHumans();

        // return $subdate;
        $hour = Carbon::now()->toDayDateTimeString();

        // $hour= $date->hour.'::'.$date->minute;
        $note = Page::first()->description ?? '';
        $rate = Rating::where('employe_id', Auth::id())->first()->rate ?? '';

        return view('dashboard.welcome', compact('remainday', 'date', 'dayName', 'note', 'rate', 'hour'));
    }//end of index
}//end of controller
