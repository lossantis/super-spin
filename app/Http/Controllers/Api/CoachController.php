<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoachRequest;
use App\Http\Resources\CoachResource;
use App\Models\Coach;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CoachController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by', 'hourly_rate');
        $sortOrder = $request->input('sort', 'asc');

        $search = $request->input('search');

        $allowedSortBy = ['name', 'hourly_rate'];
        if (! in_array($sortBy, $allowedSortBy)) {
            return response()->json(['error' => 'Invalid sort_by value. Allowed: name, hourly_rate.'], 400);
        }

        if (! in_array($sortOrder, ['asc', 'desc'])) {
            return response()->json(['error' => 'Invalid sort value. Use "asc" or "desc".'], 400);
        }

        $coaches = Coach::query()
            ->search($search)
            ->orderBy($sortBy, $sortOrder)
            ->get();

        return CoachResource::collection($coaches);
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
