<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\ReviewCollection;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $reviews = new ReviewCollection(Review::paginate(10));
        return response()->json($reviews);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ReviewRequest $request)
    {
        $user = auth()->user();
        $review = Review::create($request->validated());
        $review['user_id'] = $user->id;
        $review->save();
        return response()->json(new ReviewResource($review), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $review = new ReviewResource(Review::findOrFail($id));
        return response()->json($review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ReviewRequest $request, Review $review)
    {
        $review->update($request->validated());
        return response()->json(new ReviewResource($review));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Review $review)
    {
        try {
            $user = auth()->user();
            if ($user['id'] == $review['user_id']) {
                $review->delete();
                return response()->json(null, 204);
            }
        } catch (\Throwable) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
