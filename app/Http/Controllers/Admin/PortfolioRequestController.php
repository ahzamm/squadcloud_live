<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioDemoRequest;
use App\Http\Requests\PortfolioDemoRequest\{ViewPortfolioDemoRequest, DeletePortfolioDemoRequest};

class PortfolioRequestController extends Controller
{
    public function index(ViewPortfolioDemoRequest $request)
    {
        $portfolio_demo_requests = PortfolioDemoRequest::all();
        return view('admin.portfolio_demo_requests.index', compact('portfolio_demo_requests'));
    }

    public function destroy(DeletePortfolioDemoRequest $request, $id = null)
    {
        $delete = PortfolioDemoRequest::find($id)->delete();
        if ($delete == true) {
            return response()->json(['status' => true]);
        }
    }
}
