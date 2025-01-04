@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h2 class="h4 mb-4">Edit Kajian</h2>
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
                    @if($kajian->image)
                        <img src="/images/{{ $kajian->image }}" class="img-fluid rounded" style="width: 300px; height: 300px; object-fit: cover;" alt="{{ $kajian->title }}">
                    @else
                        <div class="no-image bg-light d-flex justify-content-center align-items-center rounded" style="width: 300px; height: 300px;">
                            <span class="text-muted">No Image Available</span>
                        </div>
                    @endif
                </div>
                <div class="content-container flex-grow-1">
                    <form action="{{ route('kajians.update', $kajian->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Kajian</label>
                            <input type="text" name="title" value="{{ old('title', $kajian->title) }}" class="form-control" placeholder="Masukkan Judul Kajian">
                        </div>

                        <div class="mb-4">
                            <label for="jeniskajian_id" class="form-label">Jenis Kajian</label>
                            <select name="jeniskajian_id" id="jeniskajian_id" class="form-select @error('jeniskajian_id') is-invalid @enderror">
                                @foreach ($jeniskajianList as $id => $name)
                                    <option value="{{ $id }}" {{ old('jeniskajian_id', $kajian->jeniskajian_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('jeniskajian_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="ustadz_id" class="form-label">Ustadz</label>
                            <select name="ustadz_id" id="ustadz_id" class="form-select @error('ustadz_id') is-invalid @enderror">
                                @foreach ($ustadzList as $id => $name)
                                    <option value="{{ $id }}" {{ old('ustadz_id', $kajian->ustadz_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('ustadz_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi Video</label>
                            <textarea class="form-control" name="description" placeholder="Masukkan Deskripsi Kajian">{{ old('description', $kajian->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="youtube_link" class="form-label">Link YouTube</label>
                            <input type="url" name="youtube_link" value="{{ old('youtube_link', $kajian->youtube_link) }}" class="form-control" placeholder="YouTube Link">
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label">Ubah Gambar</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="mb-4">
                            <label for="start_time" class="form-label">Waktu Mulai Kajian</label>
                            <input type="datetime-local" name="start_time" class="form-control" value="{{ old('start_time', $kajian->start_time ? \Carbon\Carbon::parse($kajian->start_time)->format('Y-m-d\TH:i') : '') }}">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-block" style="background-color: #622200; border-color: #622200;">Submit</button>
                            <a href="{{ route('kajians.index') }}" class="btn btn-secondary" style="background-color: #6c757d; border-color: #6c757d;">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
