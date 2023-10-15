<?php

namespace App\Http\Controllers\Issue;

use App\Http\Controllers\Controller;
use App\Model\issueType;
use App\Model\ProductIssue;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function oldEntry(){
        $issue_types = issueType::getListForSlect();
        return view('issue.old-entry.entry', compact('issue_types'));
    }

    public function oldEntrySave(Request $request){
       // return $request->all();
        return ProductIssue::insertProductIssue($request);
    }
}
