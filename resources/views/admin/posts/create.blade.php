<x-admin-master>

    @section('content')

        <h1>Create</h1>

        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title" class="">Title</label>
                <input type="text" 
                       class="form-control"
                       id="title" 
                       name="title" 
                       aria-describedby="" 
                       placeholder="Enter title">
            </div>
            <div class="form-group">
            <div><img height="150px" src="" alt="" id="preview"></div>
                <label for="file">File</label>
                <input type="file" 
                       class="form-control-file" 
                       name="post_image" 
                       id="post_image"
                       onchange="previewImage();">
            </div>
            <div class="form-group">
                <textarea name="body" id="body" class="form-control" cols="30" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    @endsection

    @section('script')

    <script>
        function previewImage() {
            var file = document.getElementById("post_image").files;
            if (file.length > 0) {
                var fileReader = new FileReader();

                fileReader.onload = function(){
                    document.getElementById("preview").setAttribute("src", event.target.result)
                };

                fileReader.readAsDataURL(file[0]);
            }
        }
    </script>    

    @endsection

</x-admin-master>