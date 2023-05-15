@extends('Layouts.app')
@section('title','Home')

@section('content')

 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" type="text/css" />

     <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />



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
                  <th scope="col">Image</th>
                  <th scope="col">Action</th>
             
                </tr>
              </thead>
              <tbody id="fabricatorTable">
               
              </tbody>
            </table>

        </div>
        
    </div>
  </div>


    <!--Data Table-->
    <script type="text/javascript"  src=" https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript"  src=" https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
     

 {{-- <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> --}}

    <script>
    

//    $(document).ready(function () {
   
//     $('#UserTable').DataTable();
// });


     $(function() {
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
           load_data();
           function load_data()
           {

              var action_url = "{!!  route('users.data') !!} ";

               $('#UserTable').DataTable({
                   processing: true,
                   serverSide: true,
                   responsive: true,
                   ordering: true,
                   columnDefs: [{
                       'bSortable': false,
                       'aTargets': [4,5]
                   }],
                   ajax: {
                       url : action_url,
                       type: 'POST',
                   },
                   columns: [
            // { data: 'checkbox'},
            { data: 'id', name: 'id' ,visible : true },
            { data: 'first_name', name: 'first_name' },
            { data: 'last_name', name: 'last_name' },
            { data: 'email', name: 'email' },
            { data: 'image', name: 'image' },
            { data: 'action' }],
                   order: []
               });
           }

        });

</script>
@endsection
