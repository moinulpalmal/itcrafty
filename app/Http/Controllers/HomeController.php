<?php

namespace App\Http\Controllers;

use App\Model\ServiceMaster;
use App\Model\ServiceWarranty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       //return ServiceMaster::serviceSummaryCount()
        $total_service_summary = ServiceMaster::serviceSummaryCount();
        $user_service_summary = ServiceMaster::serviceSummaryCountByUser(Auth::id());
        $total_warranty_summary = ServiceWarranty::warrantySummaryCount();

        //return $total_warranty_summary;

        return view('home', compact('total_service_summary',
            'total_warranty_summary', 'user_service_summary'));
    }
}
