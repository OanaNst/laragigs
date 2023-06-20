<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;

class ListingController extends Controller
{

    //Show all listings
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
        ]);
    }

    //Show single listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    //Show create form
    public function create()
    {
        return view('listings.create');
    }

    //Store Listing Data
    public function store(Request $request)
    {
        // var_dump($request->all());
        $formFields = $request->all(); //validate([
        // 'title' => 'required',
        // 'company' => ['required', Rule::unique('listings', 'company')],
        // 'location' => 'required',
        // 'website' => 'required',
        // 'email' => ['required', 'email'],
        // 'tags' => 'required',
        // 'description' => 'required'
        // ]);

        // die();

        Listing::create($formFields);

        return redirect('/')->with('msg', 'Listings created successfully!');
    }
}