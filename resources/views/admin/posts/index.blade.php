<x-admin-master>

  @section('content')

  <h1>All Post</h1>
  @if(Session::has('message'))

  <div class="alert alert-danger">{{ session('message') }}</div>

  @elseif(session('post-created-message'))

  <div class=" alert alert-success">{{ session('post-created-message') }}</div>

  @elseif(session('post-updated-message'))

  <div class="alert alert-success">{{ session('post-updated-message') }}</div>

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
              <th>Owner</th>
              <th>Title</th>
              <th>Image</th>
              <th>Created_At</th>
              <th>Updated_At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($posts as $post)
            <tr>
              <td>{{ $post->id }}</td>
              <td>{{ $post->user->name }}</td>
              <td><a href="{{ route('post', $post->id) }}">{{ $post->title }}</a></td>
              <td>
                <img height="40px" src="{{ $post->post_image }}" alt="">
              </td>
              <td>{{ $post->created_at->diffForHumans() }}</td>
              <td>{{ $post->updated_at->diffForHumans() }}</td>
              <td>
                <div class="d-flex">


                  <form action="{{ route('post.destroy', $post->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm mr-2">
                      <i class="fa fa-trash"></i>
                    </button>
                  </form>
                  <a href="{{ route('post.edit', $post->id) }}" class="btn btn-success btn-sm">
                    <i class="fa fa-pencil"></i>
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
      {{ $posts->links() }}
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