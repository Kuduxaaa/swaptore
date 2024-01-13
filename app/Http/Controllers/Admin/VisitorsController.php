<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorsController extends Controller
{
    public function index ()
    {
        $visitors = Visitor::orderBy('id', 'desc')->paginate(50);
        $visitors_count = Visitor::all()->count();

        return view('admin.pages.visitors.index', compact('visitors', 'visitors_count'));
    }

    public function clear ()
    {
        Visitor::truncate();

        return redirect()->back()->with('message', 'All records deleted successfully');
    }
}
