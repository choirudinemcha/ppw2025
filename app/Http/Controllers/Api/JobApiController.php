<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobVacancy;

class JobApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * @OA\Get(
     *     path="/api/jobs",
     *     summary="Get all job listings",
     *     tags={"Jobs"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of jobs",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="title", type="string"),
     *                 @OA\Property(property="company", type="string"),
     *                 @OA\Property(property="location", type="string")
     *             )
     *         )
     *     )
     * )
     */
    public function index(Request $req)
    {
        // optional search & pagination
        $q = JobVacancy::query();

        if ($req->filled('keyword')) {
            $kw = $req->keyword;
            $q->where(function ($s) use ($kw) {
                $s->where('title', 'like', "%$kw%")
                    ->orWhere('company', 'like', "%$kw%")
                    ->orWhere('location', 'like', "%$kw%");
            });
        }

        $jobs = $q->orderBy('created_at', 'desc')->paginate($req->get('per_page', 10));
        return response()->json($jobs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        if ($req->user()->role !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $data = $req->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'company' => 'required',
            'salary' => 'nullable|integer',
        ]);

        $job = JobVacancy::create($data);
        return response()->json(['message' => 'Created', 'job' => $job], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(JobVacancy $job)
    {
        return response()->json($job);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, JobVacancy $job)
    {
        if ($req->user()->role !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $data = $req->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'location' => 'sometimes|required',
            'company' => 'sometimes|required',
            'salary' => 'nullable|integer',
        ]);

        $job->update($data);
        return response()->json(['message' => 'Updated', 'job' => $job]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $req, JobVacancy $job)
    {
        if ($req->user()->role !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $job->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
