 @extends('Layouts.app')

@section('title','Edit Profile')
@section('content')
<style>
    .error {
      color: red;
   }
</style>
 <div class="container">
        <h2>Registration Form</h2>
         {{-- @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            <span>{{ $message }}</span>
                        </div>
                    @endif --}}
                    
                    
        <form method="post"   id="registerForm" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="firstName">First Name*</label>
                <input type="text" class="form-control" id="firstName"  value="{{ $data->first_name }}" name="firstName"  placeholder="Enter First Name">
                <span></span>
                @if ($errors->has('firstName'))
                        <div class="error">{{ $errors->first('firstName') }}</div>
                @endif
                          
            </div>
            
            <div class="form-group">
                <label for="lastName">Last Name*</label>
                <input type="text" class="form-control" id="lastName"  value="{{ $data->last_name }}" name="lastName" placeholder="Enter Last Name">
                <span></span>
                @if ($errors->has('lastName'))
                        <div class="error">{{ $errors->first('lastName') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Email*</label>
                <input type="email" class="form-control" id="email"  value="{{ $data->email }}" name="email" disabled placeholder="Enter Email">
                <span></span>
                 @if ($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                @endif
            </div>
            
          
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image"  accept="image/*">
                 @if ($errors->has('image'))
                        <div class="error">{{ $errors->first('image') }}</div>
                 @endif

               
            </div>
            <div class="form-group">
                        <input type="hidden" name="old_image" value="{{ $data->image }}">        
                        @if($data->image != "")
                            <img width="200px" style="border: 1px solid #ccc; margin: 5px" height="200px" src="{{ asset('uploads/'.$data->image) }}">
                        @else

                            <img width="200px" style="border: 1px solid #ccc; margin: 5px" height="200px" src="{{ asset('uploads/download.png') }}">
                        @endif
                   
                   
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('dashboard') }}" class="btn btn-info">Back</a>
        </form>
    </div>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
      <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 
 <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>

      <script>

       

        $("#registerForm").validate({
            ignore: [],
            rules: {
                firstName: "required",
                lastName: "required",
                email: {
                    required: true,
                    email: true
                },
                // phone: "required",
                image: {
                    required: false,
                    accept:"jpg,png,jpeg,gif"
                    
                },
               
            },
            messages: {
                firstName: "Please enter first name",
                lastName: "Please enter last name",
                
                email: {
                    required: "Please enter email",
                    email: "Please enter valid email"
                },
                
                image: {
                    required: "Please select image",
                    accept: "Only image type jpg/png/jpeg is allowed"
                },

            },
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
               let myform = document.getElementById("registerForm");
                 let fd = new FormData(myform );

                 $.ajax({
                   url:"{{  route('updateData',['id'=>$data->id]) }}",
                   type:'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                   data: fd,
                    cache: false,
                    processData: false,
                    contentType: false,
                   success:function(data){
                        console.log(data)
                        if(data.success)
                        {
                            window.location = "{{  route('dashboard') }}";
                        }
                    
                   }

                }); 
    
            }


        });


            
    </script>

@endsection