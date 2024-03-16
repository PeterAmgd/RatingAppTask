<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ClientToUserRating;
use App\Http\Requests\StoreClientToUserRatingRequest;
use App\Http\Requests\UpdateClientToUserRatingRequest;

class ClientToUserRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::with('ClientToUserRatings')->latest()->paginate(10);
        return view('rate-users.index', compact('users'));
    }
    public function indexApi()
    {
        //
        $users = User::with('ClientToUserRatings')->latest()->paginate(10);
        return response()->json($users);
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
    public function ClientRateUser(StoreClientToUserRatingRequest $request)
    {
        //
        $rating = ClientToUserRating::create(
            [
                'user_id' => $request->user_id,
                'client_id' => auth()->id() ?? null ,
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
    public function ClientRateUserApi(StoreClientToUserRatingRequest $request)
    {
        //
        $rating = ClientToUserRating::create(
            [
                'user_id' => $request->user_id,
                'client_id' => auth()->id() ?? null ,
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
    public function show(ClientToUserRating $clientToUserRating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClientToUserRating $clientToUserRating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientToUserRatingRequest $request, ClientToUserRating $clientToUserRating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClientToUserRating $clientToUserRating)
    {
        //
    }
}
