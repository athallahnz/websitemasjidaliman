@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4">Daftar Slideshow</h2>
                <a href="{{ route('slideshow.create') }}" class="btn btn-primary btn-block" style="background-color: #622200; border-color: #622200;">
                    <i class="bi bi-plus-circle me-2"></i> Tambah Slide
                </a>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead style="background-color: #8e4c28; color: white;">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col" style="width: 250px;">Action</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #f5e9e1;">
                        @foreach($slideshows as $slide)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td><img src="/images/{{ $slide->image }}" alt="{{ $slide->title }}" width="100"></td>
                            <td>{{ $slide->title }}</td>
                            <td>{{ $slide->description }}</td>
                            <td>
                                <a href="{{ route('slideshow.edit', $slide->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('slideshow.destroy', $slide->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
