 @extends('Layouts.app')

@section('title','Register')
@section('content')
<style>
    .error {
      color: red;
   }
</style>
 <div class="container">
        <h2>Registration Form</h2>
         @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            <span>{{ $message }}</span>
                        </div>
                    @endif
                    
                    <p id="allError"></p>

        <form  method="POST"  id="registerForm" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="firstName">First Name*</label>
                <input type="text" class="form-control" id="firstName"  value="{{ old('firstName') }}" name="firstName"  placeholder="Enter First Name">
                <span></span>
                @if ($errors->has('firstName'))
                        <div class="error">{{ $errors->first('firstName') }}</div>
                @endif
                          
            </div>
            
            <div class="form-group">
                <label for="lastName">Last Name*</label>
                <input type="text" class="form-control" id="lastName"  value="{{ old('lastName') }}" name="lastName" placeholder="Enter Last Name">
                <span></span>
                @if ($errors->has('lastName'))
                        <div class="error">{{ $errors->first('lastName') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Email*</label>
                <input type="email" class="form-control" id="email"  value="{{ old('email') }}" name="email" placeholder="Enter Email">
                <span></span>
                 @if ($errors->has('email'))
                        <div class="error" id="email_error">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="password">Password*</label>
                <input type="password" class="form-control"   id="password"  value="{{ old('password') }}" name="password" placeholder="Enter Password">
                <span id="password-strength-status"></span>
                 @if ($errors->has('password'))
                        <div class="error">{{ $errors->first('password') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password*</label>
                <input type="password" class="form-control" id="confirmPassword"  value="{{ old('confirmPassword') }}" name="confirmPassword" placeholder="Enter Password Again">
                <span></span>
                 @if ($errors->has('confirmPassword'))
                        <div class="error">{{ $errors->first('confirmPassword') }}</div>
                @endif
            </div>
           
            
           
            <button type="submit" class="btn btn-primary">Submit</button>
              <a href="{{ route('welcome') }}" class="btn btn-primary">Back</a>
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

          // $.ajaxSetup({
          //       headers: {
          //           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          //       }
          //   });

        $("#registerForm").validate({
            ignore: [],
            rules: {
                firstName: "required",
                lastName: "required",
                password:{
                        required:true,
                        minlength:8,
                       
                        },
                confirmPassword:{
                        required:true,
                        minlength:8,
                        equalTo :'#password'
                        },
              
                // email: {
                //     required: true,
                //     email: true
                // },
              
               
            },
            messages: {
                firstName: "Please enter first name",
                lastName: "Please enter last name",
                password: "Please enter password",
                confirmPassword: "Please enter confirm password ",
              
                // email: {
                //     required: "Please enter email",
                //     email: "Please enter valid email"
                // },
               
               

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
                   url:"{{  route('registerData') }}",
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
                            window.location = "{{  route('editProfile') }}";
                        }
                    
                   }

                }); 
    
            }

        });


        // action="{{ route('registerData') }}"
            
    </script>

@endsection