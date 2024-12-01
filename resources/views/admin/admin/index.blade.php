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
        <h4 class="fs-18 fw-semibold m-0">Admin</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="{{route('admin.home.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Admin</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="d-flex justify-content-end pe-3 pt-3">
                <a href="{{route('admin.admin.create')}}" class="btn btn-success">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mb-3 w-100" id="admins-table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-nowrap">No</th>
                                <th scope="col" class="text-nowrap">Nama</th>
                                <th scope="col" class="text-nowrap">Email</th>
                                <th scope="col" class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
         
            </div> <!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div> <!-- end row -->
@endsection
@section('scripts')
<script>
    function deleteItem(e){
              // console.log(form);
              Swal.fire({
                  title: 'Hapus Data',
                  text: "Apakah kamu ingin menghapus data ?",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Iya !'
              }).then((result) => {
                  if (result.isConfirmed) {
                      $(e).parent().submit();
                  }
              })
          }
  
  </script>
   <script>
    $(document).ready(function () {
        $('#admins-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.admin.index') }}", // Route ke method index
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection
