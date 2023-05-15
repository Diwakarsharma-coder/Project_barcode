@extends('Layouts.app')
@section('title','List')

@section('content')

   {{-- {{ $data }} --}}

<div class="container"> 
    <div class="row">
        <div class="col-lg-12 col-md-6 col-sm-4">
             {{-- @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            <span>{{ $message }}</span>
                        </div>
                    @endif --}}
                    
            <table class="table" id="UserTable">
              <thead>
                <tr class="table-dark">
                  <th scope="col">#</th>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Action</th>
             
                </tr>
              </thead>
              <tbody id="fabricatorTable">
                 @foreach($data as $value)
                    <tr>
                      <th scope="row">{{ $value->id }}</th>
                      <td>{{ $value->first_name }}</td>
                      <td>{{ $value->last_name }}</td>
                      <td>{{ $value->email }}</td>
                      <td>
                          <a href="{{ route('view', ['id'=>$value->id] ) }}" title="View"><i class="fa-solid fa-eye"></i></a> 
                       
                      </td>
                    </tr>
                @endforeach 
                
               
              </tbody>
            </table>

        </div>
        
    </div>
  </div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection
