 @extends('Layouts.app')

@section('title','Register')
@section('content')
<style>
    span{
        color: red !important;
    }
</style>
 <div class="container">
        <h2>User Derails</h2>
  
                    
        <form method="post"  id="registerForm" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName"  value="{{ $data->first_name }}" name="firstName"  disabled>
            </div>
          
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName"  value="{{ $data->last_name }}" name="lastName" disabled >
              
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email"  value="{{ $data->email }}" name="email" disabled >
               
            </div>
           
            
            <div class="form-group">
                @if($data->image != "")
                    <img width="200px" style="border: 1px solid #ccc; margin: 5px" height="200px" src="{{ asset('uploads/'.$data->image) }}">
                @else

                    <img width="200px" style="border: 1px solid #ccc; margin: 5px" height="200px" src="{{ asset('uploads/download.png') }}">
                @endif
                   
                   
            </div>
            <a href="{{ route('welcome') }}" class="btn btn-primary">Back</a>
        </form>
    </div>
 

@endsection