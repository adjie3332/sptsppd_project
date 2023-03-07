<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    public function myTestAddToLog()
    {

        //kalian bisa melakukan apapun 
        //seperti create, read, update dan delete sebelum fungsi log di bawah ini dijalankan

        LogActivity::addToLog('My Testing Add To Log.');
        dd('log insert successfully.');
    }
    public function logActivity()
    {

        //kalian bisa melakukan apapun 
        //seperti create, read, update dan delete sebelum fungsi log di bawah ini dijalankan

        $logs = LogActivity::logActivityLists();
        return view('log_activity', compact('logs'));
    }
}
