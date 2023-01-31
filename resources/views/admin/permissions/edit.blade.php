<x-admin-master>
    @section('content')

    <h1>Edit Permission</h1>

    <div class="row">
        <div class="col-sm-6">
            <form action="{{ route('permissions.update', $permissions->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" name="name" id="name" value="{{$permissions->name}}" class="form-control">
                </div>

                <button class="btn btn-outline-primary mr-2">Update</button>

                <a href="{{ url()->previous() }}" class="btn btn-outline-primary">Back</a>
            </form>
        </div>
    </div>
    @endsection
</x-admin-master>