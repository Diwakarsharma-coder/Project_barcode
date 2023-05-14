 @extends('Layouts.app')

@section('title','Register')
@section('content')
        
       


    <div class="container d-flex align-items-center justify-content-center mt-5">

        <div>
            <h4>Edit Profile Bar Code</h4>    
            {!! DNS2D::getBarcodeHTML( route('edit', ['id'=>Auth::user()->id]), 'QRCODE') !!}
            
        </div>
    </div>


@endsection