<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ListingController extends Controller
{

    //Show all listings
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
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
        $validator = Validator::make($request->all(), [
        'title' => 'required',
        'company' => ['required', Rule::unique('listings', 'company')],
        'location' => 'required',
        'website' => 'required',
        'email' => ['required', 'email'],
        'tags' => 'required',
        'description' => 'required'
        ]);

        $formFields = $validator->safe()->except(['_token']);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($formFields);

        return redirect('/')->with('msg', 'Listing created successfully!');
    }

    // Show Edit Form
    public function edit(Listing $listing) {
        return view('listings.edit', ['listing' => $listing]);
    }

    //Update Listing Data
    public function update(Request $request, Listing $listing)
    {
        $validator = Validator::make($request->all(), [
        'title' => 'required',
        'company' => ['required'],
        'location' => 'required',
        'website' => 'required',
        'email' => ['required', 'email'],
        'tags' => 'required',
        'description' => 'required'
        ]);

        $formFields = $validator->safe()->except(['_token']);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('msg', 'Listing update successfully!');
    }

    // Delete Listing
    public function destroy(Listing $listing) {
        $listing->delete();
        return redirect('/')->with('msg', 'Listing deleted successfully!');
    }
}
