@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h2 class="h4 mb-4">{{ isset($slideshow) ? 'Edit Slide' : 'Tambah Slide' }}</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="d-flex flex-wrap align-items-start">
                <div class="image-container text-center mb-3 me-3">
                    @isset($slideshow->image)
                        <img src="/images/{{ $slideshow->image }}" class="img-fluid rounded" style="width: 300px; height: 300px; object-fit: cover;" alt="{{ $slideshow->title }}">
                    @else
                        <div class="no-image bg-light d-flex justify-content-center align-items-center rounded" style="width: 300px; height: 300px;">
                            <span class="text-muted">No Image Available</span>
                        </div>
                    @endisset
                </div>
                <div class="content-container flex-grow-1">
                    <form action="{{ isset($slideshow) ? route('slideshow.update', $slideshow->id) : route('slideshows.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($slideshow))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Slide</label>
                            <input type="text" name="title" value="{{ old('title', $slideshow->title ?? '') }}" class="form-control" placeholder="Masukkan judul">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" placeholder="Masukkan deskripsi">{{ old('description', $slideshow->description ?? '') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label">Gambar Slide</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn" style="background-color: #622200; color: white;">{{ isset($slideshow) ? 'Update' : 'Simpan' }}</button>
                            <a href="{{ route('slideshow.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
