@extends('admin.layouts.app')

@section('title', 'Articles')

@section('content')

<div class="admin-dashboard">

    <div class="dashboard-header">
        <div>
            <h2>Articles</h2>
            <p>Kelola berita dan publikasi website</p>
        </div>

        <a href="/admin/articles/create" class="btn-primary">
            + Tambah Artikel
        </a>
    </div>

    <div class="dashboard-card">

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td>
                            <span class="badge {{ $article->is_published ? 'badge-success' : 'badge-warning' }}">
                                {{ $article->is_published ? 'Publish' : 'Draft' }}
                            </span>
                        </td>
                        <td>{{ $article->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="/admin/articles/{{ $article->id }}/edit">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum ada artikel</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>

@endsection
