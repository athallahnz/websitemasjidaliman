@extends('layouts.app')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"> <!-- Modal di tengah layar -->
            <div class="modal-content">
                <div class="modal-header">
                    <strong class="modal-title" id="exampleModalLabel">Informasi Penting</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center">
                    <img src="{{ asset('images/poster-layanan-konsultasi.jpg') }}" class="img-fluid" alt="poster"
                        style="max-width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </div>
    <div>
        <!-- Konten utama di sini -->
        <iframe src="https://konsultasisyariah.net" width="100%" height="800px" style="border:none;"></iframe>
    </div>
@endsection
@push('scripts')
    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                myModal.show();
            }, 1000);
        });
    </script>
@endpush
