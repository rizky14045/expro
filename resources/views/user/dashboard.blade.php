@extends('user.layout.app')
@section('styles')
@stop
@section('content')
    
<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">Dashboard</h4>
    </div>
</div>

<!-- start row -->
<div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="row g-3">
            <div class="col-md-6 col-xl-6">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="fs-14 mb-1">Jumlah Inspeksi</div>
                        </div>
                        <div class="d-flex align-items-baseline mb-2">
                            <div class="fs-22 mb-0 me-2 fw-semibold">{{number_format($inspection)}}</div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div> <!-- end sales -->
    <hr>
    <h5>Data Inspeksi</h5>
    <div class="col-md-12 col-xl-12">
        <div class="row g-3">
            <div class="col-md-6 col-xl-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="fs-14 mb-1">Disetujui</div>
                        </div>
                        <div class="d-flex align-items-baseline mb-2">
                            <div class="fs-22 mb-0 me-2 fw-semibold">{{number_format($inspection_accept)}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="fs-14 mb-1">Diproses</div>
                        </div>
                        <div class="d-flex align-items-baseline mb-2">
                            <div class="fs-22 mb-0 me-2 fw-semibold">{{number_format($inspection_process)}}</div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-md-6 col-xl-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="fs-14 mb-1">Revisi</div>
                        </div>
                        <div class="d-flex align-items-baseline mb-2">
                            <div class="fs-22 mb-0 me-2 fw-semibold">{{number_format($inspection_revision)}}</div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-md-6 col-xl-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="fs-14 mb-1">Ditolak</div>
                        </div>
                        <div class="d-flex align-items-baseline mb-2">
                            <div class="fs-22 mb-0 me-2 fw-semibold">{{number_format($inspection_reject)}}</div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div> <!-- end sales -->
</div> <!-- end row -->
@endsection

