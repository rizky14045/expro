@extends('admin.layout.app')
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
        <h4 class="fs-18 fw-semibold m-0">Lisensi</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="{{route('admin.home.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Lisensi</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="d-flex justify-content-end pe-3 pt-3">
                <a href="{{route('admin.license.create')}}" class="btn btn-success">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mb-0 w-100" id="licenses-table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nomor License</th>
                                <th scope="col">Status</th>
                                <th scope="col">Nama Perusahaan</th>
                                <th scope="col">Nama Lisensi</th>
                                <th scope="col">Jenis Personil</th>
                                <th scope="col">Bidang Jasa</th>
                                <th scope="col">Jenis Alat</th>
                                <th scope="col">Klasifikasi</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Tanggal Expired</th>
                                <th scope="col">Dokumen</th>
                                <th scope="col">Action</th>
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
            $('#licenses-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.license.index') }}", // Route ke controller
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'number_license', name: 'number_license' },
                    { data: 'status', name: 'status' },
                    { data: 'user_name', name: 'user.name' },
                    { data: 'license_name', name: 'license_name' },
                    { data: 'personel_type', name: 'personel_type' },
                    { data: 'service_sector', name: 'service_sector' },
                    { data: 'tool_type', name: 'tool_type' },
                    { data: 'clasification', name: 'clasification' },
                    { data: 'class', name: 'class' },
                    { data: 'expired_date', name: 'expired_date' },
                    { data: 'license_file', name: 'license_file', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@endsection

