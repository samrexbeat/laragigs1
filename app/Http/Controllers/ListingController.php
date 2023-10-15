<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //show all listing
    public function index(){
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(4)
        ]);
    }

    //single listing
    public function show(Listing $listing){
        return view('listings.show',[
            'listing'=> $listing
         ]);
    }

    //create listings
    public function create() {
        return view('listings.create');
    }

    //store listing data
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);
     
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);
        return redirect('/')->with('success', 'Job created successfully!');
    }

    // show edit form
    public function edit(Listing $listing){
        return view('listings.edit', ['listing' => $listing]);
    }

      //update listing data
      public function update(Request $request, Listing $listing) {

        // make sure user is logged in
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);
     
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        

        $listing->update($formFields);
        return back()->with('success', 'Job updated successfully!');
    }


    // delete listing
    public function destroy(Listing $listing){

          // make sure user is logged in
          if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized action');
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing delete');
    }

    // manage listing
    public function manage()
    {
       return view('listings.manage', ['listings'=> auth()->user()->listings()->get()]);
    }
}
