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
            <li class="breadcrumb-item active">Tambah Data Lisensi</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.license.store')}}" class="my-4" enctype="multipart/form-data" method="POST">
                    @csrf
                    <!-- Formulir Pendaftaran -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="username" class="form-label">Nomor Lisensi</label>
                                <input class="form-control" name="number_license" type="text" required="" placeholder="Masukan nomor lisensi" value="{{old('number_license')}}">
                                @if($errors->has('number_license'))
                                    <div class="error text-danger">{{ $errors->first('number_license') }}</div>
                                @endif
                            </div>
                            <div class="mb-3 user-select">
                                <label for="example-select" class="form-label">Pilih User</label>
                                <select class="form-select select-2" id="example-select" name="user_id">
                                    <option value="">Pilih User</option>
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}" {{old('user_id') == $user->id ? 'selected' : ''}}>{{$user->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('user_id'))
                                    <div class="error text-danger">{{ $errors->first('user_id') }}</div>
                                @endif
                            </div>    
                            <div class="form-group mb-3">
                                <label for="objectName" class="form-label">Nama Lisensi</label>
                                <input class="form-control" type="text" id="objectName" required="" placeholder="Masukan nama lisensi" name="license_name" value="{{old('license_name')}}">
                                @if($errors->has('license_name'))
                                    <div class="error text-danger">{{ $errors->first('license_name') }}</div>
                                @endif  
                            </div>
                            <div class="form-group mb-3">
                                <label for="objectName" class="form-label">Jenis Personil</label>
                                <input class="form-control" type="text" id="objectName" required="" placeholder="Masukan jenis personil" name="personel_type" value="{{old('personil_type')}}">
                                @if($errors->has('personil_type'))
                                    <div class="error text-danger">{{ $errors->first('personil_type') }}</div>
                                @endif  
                            </div>
                            <div class="form-group mb-3">
                                <label for="objectName" class="form-label">Bidang Jasa</label>
                                <input class="form-control" type="text" id="objectName" required="" placeholder="Masukan bidang jasa" name="service_sector" value="{{old('service_sector')}}">
                                @if($errors->has('service_sector'))
                                    <div class="error text-danger">{{ $errors->first('service_sector') }}</div>
                                @endif  
                            </div>
                            <div class="form-group mb-3">
                                <label for="objectName" class="form-label">Jenis Alat</label>
                                <input class="form-control" type="text" id="objectName" required="" placeholder="Masukan jenis alat" name="tool_type" value="{{old('tool_type')}}">
                                @if($errors->has('tool_type'))
                                    <div class="error text-danger">{{ $errors->first('tool_type') }}</div>
                                @endif  
                            </div>
                           
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="objectName" class="form-label">Klasifikasi</label>
                                <input class="form-control" type="text" id="objectName" required="" placeholder="Masukan klasifikasi" name="clasification" value="{{old('clasification')}}">
                                @if($errors->has('clasification'))
                                    <div class="error text-danger">{{ $errors->first('clasification') }}</div>
                                @endif  
                            </div>
                            <div class="form-group mb-3">
                                <label for="objectName" class="form-label">Kelas</label>
                                <input class="form-control" type="text" id="objectName" required="" placeholder="Masukan kelas" name="class" value="{{old('class')}}">
                                @if($errors->has('class'))
                                    <div class="error text-danger">{{ $errors->first('class') }}</div>
                                @endif  
                            </div>
                            <div class="form-group mb-3">
                                <label for="inputPDF" class="form-label">Tanggal Expired</label>
                                <input type="date" class="form-control" name="expired_date" value="{{old('expired_date')}}">
                                @if($errors->has('expired_date'))
                                    <div class="error text-danger">{{ $errors->first('expired_date') }}</div>
                                @endif
                            </div>
                            <div class="mb-3 user-select">
                                <label for="example-select" class="form-label">Status</label>
                                <select class="form-select" id="example-select" name="status_level">
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
                                <input class="form-control" type="text" id="objectPlace" required="" placeholder="Masukan keterangan status" name="status" value="{{old('status')}}">
                                @if($errors->has('status'))
                                    <div class="error text-danger">{{ $errors->first('status') }}</div>
                                @endif
                            </div>  
                            <input type="hidden" name="key" value="{{$key}}">
                            <div class="form-group mb-3">
                                <label for="inputPDF" class="form-label">File Lisensi</label>
                                <input type="file" class="form-control" id="inputGroupFile01" accept=".pdf" name="license_file">
                                @if($errors->has('license_file'))
                                    <div class="error text-danger">{{ $errors->first('license_file') }}</div>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="objectPlace" class="form-label">Catatan</label>
                                <input class="form-control" type="text" placeholder="Masukan catatan" name="note" value="{{old('note')}}">
                            </div>  
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="d-flex gap-3 justify-content-end">

                                    <a href="{{route('admin.license.index')}}" class="btn btn-danger"> Back</a>
                                    <button class="btn btn-primary" type="submit"> Tambah</button>
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

