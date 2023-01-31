<x-admin-master>
    @section('content')

    <h1>Edit Page</h1>

    <div class="row">
        <div class="col-sm-6">
            <form action="{{ route('roles.update', $role->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" name="name" id="name" value="{{$role->name}}" class="form-control">
                </div>

            </form>
        </div>
    </div>

    <div class="row p-5">
        <div class="col-lg-12">
            @if($permissions->isNotEmpty())
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Permission's</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Option</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)

                                <tr>
                                    <td><input type="checkbox" @foreach($role->permission as $role_permission)
                                        @if($role_permission->slug == $permission->slug)
                                        checked
                                        @endif
                                        @endforeach>
                                    </td>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->slug }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <form action="{{ route('role.permission.attach',$role) }}" method="post">
                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" name="permission" value="{{ $permission->id }}">

                                                <button type="submit" class="btn btn-primary btn-sm mr-1" @if($role->permission->contains($permission))
                                                    disabled
                                                    @endif>
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                            </form>

                                            <form action="{{ route('role.permission.detach',$role) }}" method="post">
                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" name="permission" value="{{ $permission->id }}">

                                                <button type="submit" class="btn btn-danger btn-sm mr-1" @if(!$role->permission->contains($permission))
                                                    disabled
                                                    @endif
                                                    >
                                                    <i class="fa-solid fa-minus"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <!-- <button type="submit" class="btn btn-danger btn-sm ml-1">
                            <i class="fa-solid fa-minus"></i>
                        </button>   -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="my-4 text-center">
        <button class="btn btn-outline-primary mr-3">Update</button>
        <a href="{{ url()->previous() }}" class="btn btn-outline-primary">Back</a>
    </div>
    @endsection
</x-admin-master>