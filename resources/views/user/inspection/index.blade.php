@extends('user.layout.app')
@section('styles')
<style>
    .accordion-button::after {
        filter: invert(100%);
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
            <div class="d-flex justify-content-end pe-3 pt-3">
                <a href="{{route('user.inspection.create')}}" class="btn btn-success">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="text-nowrap">No</th>
                                <th scope="col" class="text-nowrap">Kode Supplier</th>
                                <th scope="col" class="text-nowrap">Nama Perusahaan</th>
                                <th scope="col" class="text-nowrap">NPWP</th>
                                <th scope="col" class="text-nowrap">Nama Direktur</th>
                                <th scope="col" class="text-nowrap">Telp</th>
                                <th scope="col" class="text-nowrap">Unit</th>
                                <th scope="col" class="text-nowrap">Tanggal Submit Dokumentasi License</th>
                                <th scope="col" class="text-nowrap">Dokumen</th>
                                <th scope="col" class="text-nowrap">Status</th>
                                <th scope="col" class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-nowrap">1</td>
                                <td class="text-nowrap">V03166</td>
                                <td class="text-nowrap">DITAMA NASTARI GEMILANG. CV</td>
                                <td class="text-nowrap">812605434432000</td>
                                <td class="text-nowrap">Rezza Prawiratama</td>
                                <td class="text-nowrap"></td>
                                <td class="text-nowrap">Expro Mandiri</td>
                                <td class="text-nowrap">30-12-2022</td>
                                <td class="text-nowrap"><a href="#" class="btn btn-link">Download</a></td>
                                <td class="text-nowrap">LOLOS CSMS</td>
                                <td class="text-nowrap">
                                    <a href="{{route('user.license.edit')}}" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
         
            </div> <!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div> <!-- end row -->
@endsection

