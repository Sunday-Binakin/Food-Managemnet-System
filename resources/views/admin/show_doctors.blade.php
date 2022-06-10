<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
   @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
    @include('admin.upper_body')
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.navbar')
        <!-- partial -->
     <div class="container-fluid page-body-wrapper">
        <div class="main-panel" style="padding-top: 50px">
            <table class="table  table table-striped" >
                <thead>
                  <tr align="center" style="background-color: black">
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Speciality</th>
                    <th scope="col">Room</th>
                    <th scope="col">Image</th> 
                    <th scope="col">Delete</th>  
                    <th scope="col">Update</th> 
                  </tr>
                </thead>
                <tbody>
                
                    @foreach ($data as $doctor)
                
                    <tr align="center" style="background-color: skyblue">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $doctor->name }}</td>
                        <td>{{ $doctor->phone }}</td>
                        <td>{{ $doctor->speciality }}</td>
                        <td>{{ $doctor->room }}</td>
                        <td><img height="100px" width="100px"  src="doctorImage/{{ $doctor->image }}"></td> 
                        <td><a onclick="return confirm('are you sure?')" class="btn btn-danger" href="{{ url('delete_doctor',$doctor->id) }}">Delete</a></td>
                        <td><a class="btn btn-primary" href="{{ url('update_doctor',$doctor->id) }}">Update</a></td>
                    </tr>
                    @endforeach
                </tbody>
     </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>