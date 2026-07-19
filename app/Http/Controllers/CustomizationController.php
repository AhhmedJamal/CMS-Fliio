<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomizationController extends Controller
{
    public function index()
    {
        return view('customization.index');
    }
    public function create()
    {
        // return view('customization.create');
    }
    public function store(Request $request)
    {
        // return view('customization.store');
    }
    public function edit($id)
    {
        // return view('customization.edit');
    }
    public function update(Request $request, $id)
    {
        // return view('customization.update');
    }
    public function destroy($id)
    {
        // return view('customization.destroy');
    }
}
