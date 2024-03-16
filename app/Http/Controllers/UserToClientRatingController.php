<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\UserToClientRating;
use App\Http\Requests\StoreUserToClientRatingRequest;
use App\Http\Requests\UpdateUserToClientRatingRequest;

class UserToClientRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('auth');
     }

    public function index()
    {
        //get all clients
        // dd(auth()->user()->id);
        $clients = Client::with('userToClientRatings')->latest()->paginate(10);
        return view('rate-clients.index', compact('clients'));
    }
    public function indexApi()
    {
        //get all clients
        // dd(auth()->user()->id);
        $clients = Client::with('userToClientRatings')->latest()->paginate(10);
        return response()->json($clients);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function UserRateClient(StoreUserToClientRatingRequest $request)
    {
        $rating = UserToClientRating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'client_id' => $request->client_id,
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]
        );
        if ($rating) {
            # code...
            return redirect()->back()->with('success', 'Rating submitted successfully');
        }
        else{
            return redirect()->back()->with('error', 'Rating not submitted');
        }
    }
    public function UserRateClientApi(StoreUserToClientRatingRequest $request)
    {
        $rating = UserToClientRating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'client_id' => $request->client_id,
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]
        );
        if ($rating) {
            # code...
            return response()->json($rating);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(UserToClientRating $userToClientRating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserToClientRating $userToClientRating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserToClientRatingRequest $request, UserToClientRating $userToClientRating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserToClientRating $userToClientRating)
    {
        //
    }
}
