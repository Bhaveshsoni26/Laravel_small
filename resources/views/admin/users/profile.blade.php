<x-admin-master>

    @section('content')
    <h1>
        Profile
    </h1>

    <div class="row">
        <div class="col-sm-6">
            <form action="{{ route('user.profile.update', $user) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <div class="profile-pic-div">
                        <img class="img-profile rounded-circle shadow-4-strong" src="{{ $user->avatar }}" style="width:100px;height:100px;object-fit:cover;" id="show">
                        <input type="file" name="avatar" id="avatar_img" onchange="previewImg();">
                        <label for="avatar_img" id="uploadBtn">Choose Photo</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username">User Name</label>
                    <input type="text" 
                           name="username" 
                           class="form-control @error('username') is-invalid @enderror" 
                           id="username" 
                           value="{{ $user->username }}">
                        @error('username')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" 
                           name="name" 
                           class="form-control" 
                           id="name" 
                           value="{{ $user->name }}">
                        @error('name')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" 
                           name="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           value="{{ $user->email }}">
                        @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="password">Change Password</label>
                    <div class="password-container">
                        <input type="password" 
                               name="password"  
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password">
                               @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        <i class="fa-regular fa-eye" id="show-password"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <div class="password-container">
                    <input id="confirm-password" 
                           type="password" 
                           class="form-control @error('confirm-password') is-invalid @enderror" 
                           name="confirm-password">
                        @error('confirm-password')
                            <div class="invalid-feedbacksk">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    @endsection
    @section('style')
    <style>
        .password-container{
            width: 400px;
            position: relative;
        }

        .password-container input[type="password"],
        .password-container input[type="text"]{
            width: 100%;
            padding: 12px 36px 12px 12px;
            box-sizing: border-box;
        }
        #show-password{
            position: absolute;
            top: 28%;
            right: 4%;
            cursor: pointer;
            color: lightgray;
        }
        #avatar_img{
            display: none;
        }
        #uploadBtn{
            width: 100%;
            position: absolute;
            left: 0;
            bottom: 0;
            text-align: center;
            background: rgba(0, 0, 0, 0.7);
            color: wheat;
            padding: 10px 0;
            font-family: sans-serif;
            font-size: 10px;
            cursor: pointer;
            margin: 0;
            transition: all 0.2s ease;
            transform: translateY(140%);
        }

        .profile-pic-div{
            height: 100px;
            width: 100px;
            position: relative;
            border-radius: 50%;
            overflow: hidden;
            border: 1px solid black;
            object-fit:cover;
        }
        .profile-pic-div:hover #uploadBtn{
            transform: translateY(0);
        }
        </style>
    @endsection
    @section('script')
        <!-- <script>
            const showPassword = document.querySelector("#show-password");
            const passwordFeild = document.querySelector("#password");

            showPassword.addEventListener("click", function(){
                this.classList.toggle("fa-sharp fa-solid fa-eye-slash");
                const type = passwordFeild.getAttribute("type") === "password" ? "text" : "password";
                passwordFeild.setAttribute("type", type);
            })
        </script> -->
        <script>
            $(document).ready(function(){
                $('#show-password').on('click',function(){
                    $(this).toggleClass('showpass')
                    if ($(this).hasClass('showpass')) {
                        $(this).addClass('fa-eye-slash').removeClass('fa-eye')
                        $('#password').attr('type','text')
                    }
                    else{
                        $(this).removeClass('fa-eye-slash').addClass('fa-eye')
                        $('#password').attr('type','password')
                    }

                })  
            })
        </script>
        <script>
            // const imgDiv = document.querySelector('profile-pic-div');
            // const UploadBtn = document.querySelector('#uploadBtn');

            // imgDiv.addEventListener('mouseenter', function(){
            //     UploadBtn.style.display = "block";
            // });

            // imgDiv.addEventListener('mouseleave', function(){
            //     UploadBtn.style.display = "none";
            // });

            function previewImg() {
            var file = document.getElementById("avatar_img").files;
            if (file.length > 0) {
                var fileReader = new FileReader();

                fileReader.onload = function(){
                    document.getElementById("show").setAttribute("src", event.target.result)
                };

                fileReader.readAsDataURL(file[0]);
            }
        }
        </script>

    @endsection

    
</x-admin-master>