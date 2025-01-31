@extends('user.layout.app')
@section('styles')
<style>
    .accordion-button::after {
        filter: invert(100%);
    }
    .table th, .table td {
        white-space: nowrap; /* Menghindari teks tumpang tindih */
    }
</style>

@stop
@section('content')
    

<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">Inspeksi</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="{{route('user.home.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Inspeksi</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mb-0 w-100" id="inspections-table-user">
                        <thead>
                            <tr>
                                <th scope="col" class="text-nowrap">No</th>
                                <th scope="col" class="text-nowrap">Nomor Form</th>
                                <th scope="col" class="text-nowrap">Nama Perusahaan</th>
                                <th scope="col" class="text-nowrap">Objek yang diuji</th>
                                <th scope="col" class="text-nowrap">Lokasi objek yang diuji</th>
                                <th scope="col" class="text-nowrap">Tanggal Inspeksi</th>
                                <th scope="col" class="text-nowrap">Tanggal Tes Berikutnya</th>
                                <th scope="col" class="text-nowrap">Dokumen</th>
                                <th scope="col" class="text-nowrap">Status</th>
                                <th scope="col" class="text-nowrap">Qrcode</th>
                                <th scope="col" class="text-nowrap">Print Qrcode</th>
                                <th scope="col" class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
         
            </div> <!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div> <!-- end row -->
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $('#inspections-table-user').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.inspection.index') }}", // Route untuk AJAX
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'number_inspection', name: 'number_inspection' },
                { data: 'user_name', name: 'user.name' }, // Relasi user
                { data: 'object_name', name: 'object_name' },
                { data: 'object_location', name: 'object_location' },
                { data: 'inspection_date', name: 'inspection_date' },
                { data: 'next_test_date', name: 'next_test_date' },
                { data: 'inspection_file', name: 'inspection_file', orderable: false, searchable: false },
                { data: 'status', name: 'status' },
                { data: 'qrcode', name: 'qrcode', orderable: false, searchable: false },
                { data: 'print', name: 'print', searchable: false },
                { data: 'action', name: 'action', searchable: false },
            ]
        });
    });
</script>
@endsection

