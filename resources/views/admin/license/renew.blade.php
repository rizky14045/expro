@extends('admin.layout.app')
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
        <h4 class="fs-18 fw-semibold m-0">Lisensi</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="{{route('admin.home.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Perpanjang Lisensi</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.license.renewUpdate',['id'=>$license->id])}}" class="my-4" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PATCH')
                    <!-- Formulir Pendaftaran -->
                    <div class="col-xl-12">
                        <div class="form-group mb-3 col-md-6">
                            <label for="username" class="form-label">Nomor Lisensi</label>
                            <input class="form-control" type="text" disabled placeholder="Masukan nomor lisensi" value="{{$license->number_license}}">
                        </div>
                        <div class="mb-3 col-md-6 user-select">
                            <label for="example-select" class="form-label">Pilih User</label>
                            <select class="form-select select-2" id="example-select" disabled>
                                <option value="">Pilih User</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}" {{$license->user_id == $user->id ? 'selected' : ''}}>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>    
                        <div class="form-group mb-3 col-md-6">
                            <label for="objectName" class="form-label">Nama Lisensi</label>
                            <input class="form-control" type="text" id="objectName" disabled placeholder="Masukan nama lisensi" value="{{$license->license_name}}"> 
                        </div>
                        <hr>
                        <h5>Ubah Status Lisensi</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 user-select">
                                    <label for="example-select" class="form-label">Status Sebelumnya</label>
                                    <select class="form-select" id="example-select" disabled>
                                        <option value="">Pilih Status</option>
                                        <option value="1" {{ $license->status_level == 1 ? 'selected' : '' }}>Diproses</option>
                                        <option value="2" {{ $license->status_level == 2 ? 'selected' : '' }}>Disetujui</option>
                                        <option value="3" {{ $license->status_level == 3 ? 'selected' : '' }}>Revisi</option>
                                        <option value="4" {{ $license->status_level == 4 ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                </div> 
                                <div class="form-group mb-3">
                                    <label for="objectPlace" class="form-label">Keterangan Status</label>
                                    <input class="form-control" type="text" id="objectPlace" required="" placeholder="Masukan keterangan status" value="{{$license->status}}" disabled>
                                </div>  
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 user-select">
                                    <label for="example-select" class="form-label">Status</label>
                                    <select class="form-select" id="example-select" name="status_level" required>
                                        <option value="">Pilih Status</option>
                                        <option value="1" {{ old('status_level') == 1 ? 'selected' : '' }}>Diproses</option>
                                        <option value="2" {{ old('status_level') == 2 ? 'selected' : '' }}>Disetujui</option>
                                        <option value="3" {{ old('status_level') == 3 ? 'selected' : '' }}>Revisi</option>
                                        <option value="4" {{ old('status_level') == 4 ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    @if($errors->has('status_level'))
                                        <div class="error text-danger">{{ $errors->first('status_level') }}</div>
                                    @endif
                                </div> 
                                <div class="form-group mb-3">
                                    <label for="objectPlace" class="form-label">Keterangan Status</label>
                                    <input class="form-control" type="text" id="objectPlace" required="" placeholder="Masukan keterangan status" name="status" value="{{ old('status')}}">
                                    @if($errors->has('status'))
                                        <div class="error text-danger">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>  
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-md-6">
                                <label for="inputPDF" class="form-label">Tanggal Expired</label>
                                <input type="date" class="form-control" value="{{$license->expired_date}}" disabled>
                            </div>
                            <div class="form-group mb-3 col-md-6">
                                <label for="inputPDF" class="form-label">Tanggal Baru ( Opsional )</label>
                                <input type="date" class="form-control" name="new_date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="d-flex gap-3 justify-content-end">

                                    <a href="{{route('admin.license.index')}}" class="btn btn-danger"> Back</a>
                                    <button class="btn btn-primary" type="submit"> Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
         
            </div> <!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div> <!-- end row -->
@endsection

