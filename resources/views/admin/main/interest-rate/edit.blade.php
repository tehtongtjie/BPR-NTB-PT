@extends('admin.layouts.app')

@section('title', 'Edit Suku Bunga')

@section('content')
<form method="POST"
      action="{{ route('admin.main.interest-rate.update', $interestRate) }}">
    @csrf
    @method('PUT')

    {{-- Judul --}}
    <input name="title"
           value="{{ $interestRate->title }}"
           class="form-control mb-3" required>

    {{-- Rate --}}
    <input name="rate"
           value="{{ $interestRate->rate }}"
           class="form-control mb-3" required>

    {{-- Deskripsi --}}
    <textarea name="description"
              class="form-control mb-3">{{ $interestRate->description }}</textarea>

    {{-- Status --}}
    <label>
        <input type="checkbox"
               name="is_active"
               value="1"
               {{ $interestRate->is_active ? 'checked' : '' }}>
        Aktif
    </label>

    <button class="btn btn-primary mt-3">Update</button>
</form>


<hr>

<h5>Rincian Suku Bunga</h5>

<form method="POST"
      action="{{ route('admin.main.interest-rate.detail.store', $interestRate) }}"
      class="row g-2 mb-3">
@csrf
<div class="col">
    <select name="category" class="form-control">
        <option value="tabungan">Tabungan</option>
        <option value="deposito">Deposito</option>
    </select>
</div>
<div class="col">
    <input name="name" class="form-control" placeholder="Nama">
</div>
<div class="col">
    <input name="rate" class="form-control" placeholder="Rate">
</div>
<div class="col">
    <button class="btn btn-success">Tambah</button>
</div>
</form>

@foreach ($interestRate->details as $detail)
<div class="d-flex justify-content-between border p-2 mb-1">
    <span>{{ $detail->name }} ({{ $detail->category }})</span>
    <span>
        {{ $detail->rate }}
        <form method="POST"
              action="{{ route('admin.main.interest-rate.detail.destroy', $detail) }}"
              class="d-inline">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger">x</button>
        </form>
    </span>
</div>
@endforeach

</div>
@endsection
