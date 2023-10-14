<?php

namespace App\Http\Controllers\Issue;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function oldEntry(){
        return view('issue.old-entry.entry');
    }

    public function oldEntrySave(Request $request){

    }
}
