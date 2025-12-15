@extends('layouts.app')

@section('content')
    <div class="container page-offset">
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-body p-4">

                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
                    <div>
                        <h2 class="h4 fw-bold mb-1">Infaq Jamaah</h2>
                        <div class="text-muted small">Monitoring data infaq yang masuk beserta bukti transfer.</div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 yajra-datatable">
                        <thead class="table-head-brown">
                            <tr>
                                <th style="width:60px;">No</th>
                                <th>Nama</th>
                                <th style="width:140px;">No. Tlp</th>
                                <th>Alamat</th>
                                <th style="width:160px;">Nominal</th>
                                <th style="width:180px;">Tujuan</th>
                                <th style="width:140px;">Bukti</th>
                                <th style="width:160px;" class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-body-soft"></tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('jamaah.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'nomor',
                        name: 'nomor'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'nominal',
                        name: 'nominal'
                    },
                    {
                        data: 'infaq_name',
                        name: 'infaq_id'
                    },
                    {
                        data: 'file_path',
                        name: 'file_path',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            if (!data) return '<span class="text-muted">-</span>';
                            return `
                                <a href="{{ asset('storage') }}/${data}"
                                   class="btn btn-sm btn-outline-primary"
                                   target="_blank" rel="noopener"
                                   style="white-space:nowrap;">
                                   Lihat Bukti
                                </a>`;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endpush
