<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoachRequest;
use App\Http\Resources\CoachResource;
use App\Models\Coach;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CoachController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $posts = Coach::all();
        return CoachResource::collection($posts);
    }

    public function store(StoreCoachRequest $request): CoachResource
    {
        $coach = Coach::create($request->validated());
        return new CoachResource($coach);
    }

    public function show(Coach $coach): CoachResource
    {
        return new CoachResource($coach);
    }

    public function update(StoreCoachRequest $request, Coach $coach): CoachResource
    {
        $coach->update($request->validated());
        return new CoachResource($coach);
    }

    public function destroy(Coach $coach): JsonResponse
    {
        $coach->delete();
        return response()->json([
            'message' => 'Coach deleted successfully.',
        ], 204);
    }
}
