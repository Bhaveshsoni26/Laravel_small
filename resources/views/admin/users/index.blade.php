<x-admin-master>
    @section('content')

    <h1>Users</h1>

    @if(session('user-deleted'))

        <div class="alert alert-danger">{{ session('user-deleted') }}</div>

    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>UserName</th>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Register_at</th>
                            <th>Updated_At</th>
                            <th style="width: 100px;">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                <img height="50px" src="{{ $user->avatar }}" alt="">
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td>{{ $user->updated_at->diffForHumans() }}</td>
                            <td>
                                <div class="d-flex">

                                    <form action="{{ route('users.destroy', $user->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mr-2">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('users.info', $user->id) }}" class="btn btn-success btn-sm ml-1">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="d-flex">
        <div class="mx-auto">
            {{ $users->links() }}
        </div>
    </div>

    @endsection

    @section('script')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="{{ asset('js/demo/datatables-demo.js') }}"></script> -->

    @endsection
</x-admin-master>