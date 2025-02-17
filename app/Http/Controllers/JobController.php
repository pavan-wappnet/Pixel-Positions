<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateJobRequest;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Employer;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::all()->groupBy('featured');

        return view('jobs.index', [
            'featuredJobs' => $jobs[0],
            'jobs' => Job::all(),
            'tags' => Tag::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'title' => 'required|string|max:255',
            'salary' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'tags' => 'required|string',
            'employer_name' => 'required|string|max:255',
            'employer_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if employer already exists
        $employer = Employer::firstOrCreate(
            ['name' => $request->employer_name],
            ['user_id' => Auth::id()]
        );

        // Handle logo upload and store public URL
        if ($request->hasFile('employer_logo')) {
            $path = $request->file('employer_logo')->store('logos', 'public');
            $url = asset('storage/' . $path); // Generate public URL

            // Update employer logo URL
            $employer->update(['logo' => $url]);
        }

        // Create the job
        $job = Job::create([
            'employer_id' => $employer->id,
            'title' => $request->title,
            'salary' => $request->salary,
            'location' => $request->location,
            'schedule' => $request->schedule ?? 'Full Time',
            'url' => $request->url ?? '',
            'featured' => false,
        ]);

        // Handling Tags (Comma-separated input)
        $tags = explode(',', $request->tags);
        foreach ($tags as $tagName) {
            $job->tag(trim($tagName));
        }

        return redirect()->route('index')->with('success', 'Job posted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}
