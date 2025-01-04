@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h2 class="h4 mb-4">{{ isset($slideshow) ? 'Edit Slide' : 'Tambah Slide' }}</h2>
            <form action="{{ isset($slideshow) ? route('slideshow.update', $slideshow->id) : route('slideshow.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($slideshow))
                    @method('PUT')
                @endif
                <!-- Gambar Slide -->
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Slide</label>
                    <input type="file" name="image" class="form-control" @if(!isset($slideshow)) required @endif>
                    @isset($slideshow)
                        <img src="{{ asset('storage/' . $slideshow->image) }}" width="150" class="mt-2">
                    @endisset
                </div>

                <!-- Judul -->
                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" name="title" class="form-control" value="{{ $slideshow->title ?? '' }}">
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control">{{ $slideshow->description ?? '' }}</textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn" style="background-color: #622200; border-color: #622200; color:white;">
                    <i class="bi bi-save me-2"></i>{{ isset($slideshow) ? 'Update' : 'Simpan' }}
                </button>
                <a href="{{ route('slideshow.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
