<x-admin-master>

    @section('content')

    <center>
        <h1>
            User Profile Info
        </h1>
        <h5>Roles: 
            @foreach($user->roles as $role)
            <span class="badge badge-primary"> {{ $role->name }} </span>
            @endforeach
        </h5>
    </center>


    <div class="row">
        <div class="col-sm-6 m-auto">
            <div class="my-4 text-center">
                <div class="profile-pic-div">
                    <img class="img-profile rounded-circle shadow-4-strong" src="{{ $user->avatar }}" style="width:100px;height:100px;object-fit:cover;" id="show">
                </div>
            </div>
            <div class="form-group">
                <label for="username">User Name</label>
                <input type="text" name="username" class="form-control " id="username" value="{{ $user->username }}" readonly>

            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" readonly>

            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
            </div>
            <div class="my-4 text-center">   
                <a href="{{ url()->previous() }}" class="btn btn-outline-primary">Back</a>
            </div>
        </div>
    </div>

    @endsection

</x-admin-master>