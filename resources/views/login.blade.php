 @extends('Layouts.app')

@section('title','Login')
@section('content')
<style>
    .error {
      color: red;
   }
</style>

 <div class="container">
        <h2>Login Form</h2>
            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    <span>{{ $message }}</span>
                </div>
            @endif
                    
                    <div id="loginError">
                        
                    </div>
               

{{-- 
            @if ($mes = Session::get('errors'))
                <div class="alert alert-danger" role="alert">
                    <span>{{ $mes }}</span>
                </div>
            @endif --}}

                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <span>{{ $error }}</span>
                    </div>
                @endforeach


        <form   method="POST"  enctype="multipart/form-data"  id="loginForm">
            @csrf
            <div class="form-group">
                <label for="email">User Name*</label>
                <input type="text" class="form-control" id="email"  value="{{ old('email') }}" name="email"  placeholder="Enter First Name">
                <span></span>
               {{--  @if ($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                @endif --}}
                          
            </div>
           
            <div class="form-group">
                <label for="password">Password*</label>
                <input type="password" class="form-control"  onkeyup="checkPasswordStrength();" id="password"  value="{{ old('password') }}" name="password" placeholder="Enter Password">
                <span id="password-strength-status"></span>
                {{--  @if ($errors->has('password'))
                        <div class="error">{{ $errors->first('password') }}</div>
                @endif --}}
            </div>
           
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    {{-- <div class="container verify">
            <div class="row">
                    <div class="col-6">
                        <form>
                             <div class="form-group">
                                <label for="code_verify">Code*</label>
                                <input type="text" class="form-control"   id="code_verify"  name="code_verify" placeholder="Enter code_verify">
                                 @if ($errors->has('code_verify'))
                                        <div class="error">{{ $errors->first('code_verify') }}</div>
                                @endif
                            </div>

                        </form>         
                    </div>
            </div>
    </div> --}}


 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
      <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

 <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>

      <script>


        $("#loginForm").validate({
           ignore: [],
            rules: {
                email: "required",
                
                password:{
                        required:true,
                        },
                
               
            },
            messages: {
                email: "Please enter user name",
                 password: "Please enter passsword ",

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
                let myform = document.getElementById("loginForm");
                let fd = new FormData(myform );

                 $.ajax({
                   url:"{{  route('Datalogin') }}",
                   type:'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                   data: fd,
                    cache: false,
                    processData: false,
                    contentType: false,
                   success:function(data){
                       
                        if(data.success)
                        {
                            window.location = "{{  route('editProfile') }}";
                        }
                        else
                        {
                            var error = '<div class="alert alert-danger" role="alert">'+
                                '<span>Oppes! You have entered invalid credentials</span>'+
                            '</div>'
                                $('#loginError').html(error);
                        }

                    
                   }

                }); 
    
            }

        });


       
    </script>

@endsection