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
            <div class="d-flex justify-content-between align-items-center px-3 pt-3">
                <form action="" method="GET">
                    <div class="d-flex align-items-center gap-3">

                        <div class="mb-3">
                            <p>Pilih User</p>
                            <select class="form-input select-2 form-control" id="example-select" name="user_id">
                                <option value="">Pilih User</option>
                                @foreach ($users as $user)
                                <option value="{{$user->id}}" {{request('user_id') == $user->id ? 'selected' : ''}}>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info d-inline mt-3">Cari</button>
                    </div>
                </form>
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
                                <th scope="col">Nama Personel</th>
                                <th scope="col">NIK</th>
                                <th scope="col">Tempat Lahir</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Jenis Personil</th>
                                <th scope="col">Bidang Jasa</th>
                                <th scope="col">Klasifikasi</th>
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
            var user_id = '{{$request->user_id ?? null}}'
            $('#licenses-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: function (data, callback, settings) {
                    // Ambil nilai user_id dari select
                    var userId = $('#example-select').val();
                    var url = "{{ route('admin.license.index') }}";

                    // Tambahkan parameter user_id ke URL jika ada
                    if (userId) {
                        url += '?user_id=' + userId;
                    }

                    // Lakukan request ke server
                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: data,
                        success: function (response) {
                            callback(response); // Kirim data ke DataTables
                        }
                    });
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'number_license', name: 'number_license' },
                    { data: 'status', name: 'status' },
                    { data: 'user_name', name: 'user.name' },
                    { data: 'license_name', name: 'license_name' },
                    { data: 'nik', name: 'nik' },
                    { data: 'birth_place', name: 'birth_place' },
                    { data: 'birthdate', name: 'birthdate' },
                    { data: 'personel_type', name: 'personel_type' },
                    { data: 'service_sector', name: 'service_sector' },
                    { data: 'clasification', name: 'clasification' },
                    { data: 'expired_date', name: 'expired_date' },
                    { data: 'license_file', name: 'license_file', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@endsection

