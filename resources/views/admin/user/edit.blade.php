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
                <form action="{{route('admin.user.update',['id'=>$user->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group pb-3 col-md-6">
                        <label class="form-label" for="email-id">NPWP</label>
                        <input type="text" required class="form-control mb-0" id="text-id" placeholder="Masukan NPWP" name="number" required value="{{$user->number}}">
                    </div>
                    <div class="form-group pb-3 col-md-6">
                        <label class="form-label" for="email-id">Nama</label>
                        <input type="text" required class="form-control mb-0" id="text-id" placeholder="Masukan Nama" name="name" required value="{{$user->name}}">
                    </div>
                    <div class="form-group pb-3 col-md-6">
                        <label class="form-label" for="email-id">Alamat</label>
                        <input type="text" required class="form-control mb-0" id="text-id" placeholder="Masukan Alamat" name="address" required value="{{$user->address}}">
                    </div>
                    <div class="form-group pb-3 col-md-6">
                        <label class="form-label" for="email-id">Email</label>
                        <input type="email" class="form-control mb-0" id="email-id" placeholder="Masukan Email" name="email" required value="{{$user->email}}">
                    </div>
                    <div class="form-group pb-3 col-md-6">
                        <label class="form-label" for="email-id">Nomor Handphone</label>
                        <input type="text" required class="form-control mb-0" id="text-id" placeholder="Masukan NomorHandphone" name="phone_number" required value="{{$user->phone_number}}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="example-select" class="form-label">Status</label>
                        <select class="form-select" id="example-select" name="is_actived">
                            <option value="">Pilih Status</option>
                            <option value="0" {{ $user->is_actived == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                            <option value="1" {{ $user->is_actived == 1 ? 'selected' : '' }}>Aktif</option>
                        </select>
                        @if($errors->has('is_actived'))
                            <div class="error text-danger">{{ $errors->first('is_actived') }}</div>
                        @endif
                    </div> 
                    <div class="form-group pb-3 col-md-6">
                        <label class="form-label" for="email-id">Password</label>
                        <input type="password" class="form-control mb-0" id="email-id" name="password">
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

