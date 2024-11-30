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
        <h4 class="fs-18 fw-semibold m-0">User</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="{{route('admin.home.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Tambah Data User</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.user.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group pb-3 col-md-6">
                        <label class="form-label" for="email-id">NPWP</label>
                        <input type="text" required class="form-control mb-0" id="text-id" placeholder="Masukan Nomor NPWP" name="number" required value="{{old('number')}}">
                        @if($errors->has('number'))
                            <div class="error text-danger">{{ $errors->first('number') }}</div>
                        @endif
                    </div>
                    <div class="form-group pb-3 col-md-6">
                        <label class="form-label" for="email-id">Nama</label>
                        <input type="text" required class="form-control mb-0" id="text-id" placeholder="Masukan Nama" name="name" required value="{{old('name')}}">
                        @if($errors->has('name'))
                            <div class="error text-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <div class="form-group pb-3 col-md-6">
                        <label class="form-label" for="email-id">Alamat</label>
                        <input type="text" class="form-control mb-0" id="email-id" placeholder="Masukan Alamat" name="address" required value="{{old('address')}}">
                        @if($errors->has('address'))
                            <div class="error text-danger">{{ $errors->first('address') }}</div>
                        @endif
                    </div>
                    <div class="form-group pb-3 col-md-6">
                        <label class="form-label" for="email-id">Email</label>
                        <input type="email" class="form-control mb-0" id="email-id" placeholder="Masukan Email" name="email" required value="{{old('email')}}">
                        @if($errors->has('email'))
                            <div class="error text-danger">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <div class="form-group pb-3 col-md-6">
                        <label class="form-label" for="email-id">Nomor Handphone</label>
                        <input type="text" class="form-control mb-0" id="email-id" placeholder="Masukan Nomor Handphone" name="phone_number" required value="{{old('phone_number')}}">
                        @if($errors->has('phone_number'))
                            <div class="error text-danger">{{ $errors->first('phone_number') }}</div>
                        @endif
                    </div>
                    <div class="text-center pb-3">
                        <a href="{{route('admin.user.index')}}" class="btn btn-danger">Back</a>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
         
            </div> <!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div> <!-- end row -->

@endsection
@section('scripts')

@endsection

