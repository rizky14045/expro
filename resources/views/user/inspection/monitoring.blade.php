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
            <li class="breadcrumb-item active">Monitoring Status Inspeksi</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <!-- Formulir Pendaftaran -->
                <div class="col-xl-12">
                    <div class="form-group mb-3 col-md-6">
                        <label for="username" class="form-label">Nomor Form</label>
                        <input class="form-control" type="text" id="username" disabled="" placeholder="Masukan nomor form" value="{{$inspection->number_inspection}}">
                    </div>
                    <div class="mb-3 col-md-6 user-select">
                        <label for="example-select" class="form-label">Pilih User</label>
                        <select class="form-select select-2" id="example-select" disabled>
                            <option value="">Pilih User</option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}" {{$inspection->user_id == $user->id ? 'selected' : ''}}>{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>    
                    <div class="form-group mb-3 col-md-6">
                        <label for="objectName" class="form-label">Jenis Objek yang diuji</label>
                        <input class="form-control" type="text" id="objectName" disabled="" placeholder="Masukan jenis objek yang diuji" value="{{$inspection->object_name}}">
                    </div>
                    <div class="form-group mb-3 col-md-6">
                        <label for="objectPlace" class="form-label">Lokasi Objek yang diuji</label>
                        <input class="form-control" type="text" id="objectPlace" disabled="" placeholder="Masukan lokasi objek yang diuji" value="{{$inspection->object_location}}">
                    </div>
                    <div class="form-group mb-3 col-md-6">
                        <label for="inputPDF" class="form-label">Tanggal Inspeksi</label>
                        <input type="date" class="form-control" name="inspection_date" value="{{$inspection->inspection_date}}" disabled>
                    </div>
                    <hr>
                    <h5>Monitoring Inspeksi</h5>
                    <div class="row">
                        <div class="timeline-page position-relative">
                            <div class="timeline-section mt-4">
                                @foreach ($details as $detail) 
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">                                            
                                            <div class="duration label-left fs-16 fw-medium position-relative p-2 px-4 fst-italic rounded-2">{{$detail->created_at->format('d F Y')}}</div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="card description-right border-0 overflow-hidden float-start">
                                                <div class="card-body">
                                                    <h6 class="title mb-1 text-capitalize">
                                                        @if ($detail->status_level == 1)
                                                            Diproses
                                                        @endif
                                                        @if ($detail->status_level == 2)
                                                            Disetujui
                                                        @endif
                                                        @if ($detail->status_level == 3)
                                                            Direvisi
                                                        @endif
                                                        @if ($detail->status_level == 4)
                                                            Ditolak
                                                        @endif
                                                    </h6>
                                                    <p class="timeline-subtitle mt-3 mb-0 text-muted">
                                                      {{$detail->status}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="d-flex gap-3 justify-content-end">
                                <a href="{{route('user.inspection.index')}}" class="btn btn-danger"> Back</a>
                            </div>
                        </div>
                    </div>
                </div>         
            </div> <!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div> <!-- end row -->
@endsection
