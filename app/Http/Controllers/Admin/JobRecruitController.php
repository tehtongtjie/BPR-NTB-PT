<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobRecruit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobRecruitController extends Controller
{
    private const STATUS_OPTIONS = [
        'active' => 'Aktif',
        'closed' => 'Ditutup',
        'draft' => 'Draft',
    ];

    private const TYPE_OPTIONS = [
        'Full-time',
        'Part-time',
        'Contract',
        'Internship',
    ];

    public function index(Request $request)
    {
        $search = trim((string) $request->query('q', ''));
        $type = trim((string) $request->query('type', ''));
        $status = $request->query('status', '');
        $featured = $request->query('featured', '');

        $query = JobRecruit::query();

        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder->where('title', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('requirements', 'like', "%{$search}%");
            });
        }

        if ($type !== '') {
            $query->where('category', $type);
        }

        if (array_key_exists($status, self::STATUS_OPTIONS)) {
            $query->where('status', $status);
        }

        if ($featured === '1') {
            $query->where('is_featured', true);
        }

        $jobs = $query
            ->orderByDesc('is_featured')
            ->orderByDesc('deadline')
            ->orderBy('title')
            ->paginate(10)
            ->withQueryString();

        return view('admin.job-recruits.index', compact('jobs', 'search', 'type', 'status', 'featured'))
            ->with('statusOptions', self::STATUS_OPTIONS)
            ->with('typeOptions', self::TYPE_OPTIONS);
    }

    public function create()
    {
        return view('admin.job-recruits.create', [
            'statusOptions' => self::STATUS_OPTIONS,
            'typeOptions' => self::TYPE_OPTIONS,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:150',
            'location' => 'nullable|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'salary_range' => 'nullable|string|max:255',
            'status' => 'required|in:active,closed,draft',
            'deadline' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
            'url_recruits' => 'nullable|url',
        ]);

        $data['slug'] = Str::slug($data['title']) . '-' . Str::random(6);
        $data['category'] = $data['category'] ?: 'Full-time';
        $data['is_featured'] = $request->boolean('is_featured');

        JobRecruit::create($data);

        return redirect()
            ->route('admin.jobs.index')
            ->with('success', 'Lowongan berhasil disimpan.');
    }

    public function edit(JobRecruit $jobRecruit)
    {
        return view('admin.job-recruits.edit', [
            'jobRecruit' => $jobRecruit,
            'statusOptions' => self::STATUS_OPTIONS,
            'typeOptions' => self::TYPE_OPTIONS,
        ]);
    }

    public function update(Request $request, JobRecruit $jobRecruit)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:150',
            'location' => 'nullable|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'salary_range' => 'nullable|string|max:255',
            'status' => 'required|in:active,closed,draft',
            'deadline' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
            'url_recruits' => 'nullable|url',
        ]);

        if ($jobRecruit->title !== $data['title']) {
            $data['slug'] = Str::slug($data['title']) . '-' . Str::random(6);
        }

        $data['category'] = $data['category'] ?: 'Full-time';
        $data['is_featured'] = $request->boolean('is_featured');

        $jobRecruit->update($data);

        return redirect()
            ->route('admin.jobs.index')
            ->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(JobRecruit $jobRecruit)
    {
        $jobRecruit->delete();

        return redirect()
            ->route('admin.jobs.index')
            ->with('success', 'Lowongan berhasil dihapus.');
    }
}
