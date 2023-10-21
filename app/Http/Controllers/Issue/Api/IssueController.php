<?php

namespace App\Http\Controllers\Issue\Api;

use App\Http\Controllers\Controller;
use App\Model\ProductIssue;

class IssueController extends Controller
{
    public function getAllNotDeletedIssues()
    {
        return ProductIssue::allNotDeletedProductIssues();
    }
}
