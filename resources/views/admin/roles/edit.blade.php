<x-admin-master>
    @section('content')

        <h1>Edit Page</h1>

        <div class="col-sm-6">
            <form action="{{ route('roles.update', $role->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" name="name" id="name" value="{{$role->name}}" class="form-control">
                </div>

                <button class="btn btn-primary">Update</button>

            </form>
        </div>

    @endsection
</x-admin-master>