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
        <h4 class="fs-18 fw-semibold m-0">Inspeksi</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="{{route('admin.home.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Data Inspeksi</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.inspection.update',['id'=>$inspection->id])}}" class="my-4" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PATCH')
                    <!-- Formulir Pendaftaran -->
                    <div class="col-xl-12">
                        <div class="form-group mb-3 col-md-6">
                            <label for="username" class="form-label">Nomor Form</label>
                            <input class="form-control" name="number_inspection" type="text" id="username" required="" placeholder="Masukan nomor form" value="{{$inspection->number_inspection}}">
                            @if($errors->has('number_inspection'))
                                <div class="error text-danger">{{ $errors->first('number_inspection') }}</div>
                            @endif
                        </div>
                        <div class="mb-3 col-md-6 user-select">
                            <label for="example-select" class="form-label">Pilih User</label>
                            <select class="form-select select-2" id="example-select" name="user_id">
                                <option value="">Pilih User</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}" {{$inspection->user_id == $user->id ? 'selected' : ''}}>{{$user->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user_id'))
                                <div class="error text-danger">{{ $errors->first('user_id') }}</div>
                            @endif
                        </div>    
                        <div class="form-group mb-3 col-md-6">
                            <label for="objectName" class="form-label">Jenis Objek yang diuji</label>
                            <input class="form-control" type="text" id="objectName" required="" placeholder="Masukan jenis objek yang diuji" name="object_name" value="{{$inspection->object_name}}">
                            @if($errors->has('object_name'))
                                <div class="error text-danger">{{ $errors->first('object_name') }}</div>
                            @endif  
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label for="objectPlace" class="form-label">Lokasi Objek yang diuji</label>
                            <input class="form-control" type="text" id="objectPlace" required="" placeholder="Masukan lokasi objek yang diuji" name="object_location" value="{{$inspection->object_location}}">
                            @if($errors->has('object_location'))
                                <div class="error text-danger">{{ $errors->first('object_location') }}</div>
                            @endif
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label for="inputPDF" class="form-label">Tanggal Inspeksi</label>
                            <input type="date" class="form-control" name="inspection_date" value="{{$inspection->inspection_date}}">
                            @if($errors->has('inspection_date'))
                                <div class="error text-danger">{{ $errors->first('inspection_date') }}</div>
                            @endif
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label for="inputPDF" class="form-label">Tanggal Tes Berikutnya</label>
                            <input type="date" class="form-control" name="next_test_date" value="{{$inspection->next_test_date}}">
                            @if($errors->has('next_test_date'))
                                <div class="error text-danger">{{ $errors->first('next_test_date') }}</div>
                            @endif
                        </div>
                        <div class="mb-3 col-md-6 user-select">
                            <label for="example-select" class="form-label">Status</label>
                            <select class="form-select" id="example-select" name="status_level">
                                <option value="">Pilih Status</option>
                                <option value="1" {{ $inspection->status_level == 1 ? 'selected' : '' }}>Diproses</option>
                                <option value="2" {{ $inspection->status_level == 2 ? 'selected' : '' }}>Disetujui</option>
                                <option value="3" {{ $inspection->status_level == 3 ? 'selected' : '' }}>Revisi</option>
                                <option value="4" {{ $inspection->status_level == 4 ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            @if($errors->has('status_level'))
                                <div class="error text-danger">{{ $errors->first('status_level') }}</div>
                            @endif
                        </div> 
                        <div class="form-group mb-3 col-md-6">
                            <label for="objectPlace" class="form-label">Keterangan Status</label>
                            <input class="form-control" type="text" id="objectPlace" required="" placeholder="Masukan keterangan status" name="status" value="{{$inspection->status}}">
                            @if($errors->has('status'))
                                <div class="error text-danger">{{ $errors->first('status') }}</div>
                            @endif
                        </div>  
                        <div class="form-group mb-3 col-md-6">
                            <label for="inputPDF" class="form-label">File Inspeksi</label>
                            <input type="file" class="form-control" id="inputGroupFile01" accept=".pdf" name="inspection_file">
                            @if($errors->has('inspection_file'))
                                <div class="error text-danger">{{ $errors->first('inspection_file') }}</div>
                            @endif
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label for="objectPlace" class="form-label">Catatan</label>
                            <input class="form-control" type="text" placeholder="Masukan catatan" name="note" value="{{$inspection->note}}">
                        </div>  
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="d-flex gap-3 justify-content-end">

                                    <a href="{{route('admin.inspection.index')}}" class="btn btn-danger"> Back</a>
                                    <button class="btn btn-primary" type="submit"> Ubah</button>
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

