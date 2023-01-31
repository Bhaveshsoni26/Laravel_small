<x-admin-master>
    @section('content')

        <h1>Permissions</h1>

        <div class="row">
        <div class="col-sm-3">
            <form action="{{ route('permissions.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                        @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                </div>
                <button class="btn btn-primary btn-block">Create</button>
            </form>
        </div>
        <div class="col-sm-9">
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th width="20%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->slug }}</td>
                        <td>
                        <div class="d-flex">
                        <form action="{{ route('permissions.destroy',$permission->id) }}" method="post">
                        @csrf
                        @method('DELETE')

                            <input type="hidden" name="role" value="{{ $permission->id }}">

                            <button type="submit" class="btn btn-danger btn-sm mr-1">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                        <a href="{{route('permissions.edit', $permission->id)}}" class="btn btn-primary btn-sm mr-1">
                            <i class="fa-solid fa-pencil"></i>
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
        </div>
        </div>

    @endsection
</x-admin-master>