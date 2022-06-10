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
      {{-- <div class="container mb-5 mt-5"> --}}
      {{-- <div class="parent container"> --}}
        {{-- <div class="col-md-6"> --}}
      {{-- <div class="d-flex flex-wrap"> --}}
        <table class="table  table table-striped" style="100%">
            <thead>
              <tr align="center" style="background-color: black">
                <th scope="col">No.</th>
                <th scope="co">Custlomer's Name</th>
                <th scope="col">Email</th>
                {{-- <th scope="col">Phone</th> --}}
                <th scope="col">Doctor's Name</th>
                {{-- <th scope="col">Date</th> --}}
                <th scope="col">Message</th>
                <th scope="col">Status</th>
                <th scope="col">Approve</th>
                <th scope="col">Cancel</th>
                <th scope="col">Send Email📧</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $appoint)
                  
                 
              <tr align="center" style="background-color: skyblue">
                <td>{{ $appoint->id }}</td> 
                <td>{{ $appoint->name }}</td>
                <td>{{ $appoint->email }}</td>
                {{-- <td>{{ $appoint->phone}}</td> --}}
                <td>{{ $appoint->doctor }}</td> 
                {{-- <td>{{ $appoint->date }}</td> --}}
                {{-- <td>{{ $appoint->name }}</td> --}}
                <td>{{ $appoint->message }}</td>
                <td>{{ $appoint->status}}</td>
                <td>
                    <a class="btn btn-success" href="{{ url('approved',$appoint->id) }}">Approve</a>
                </td>
                <td>
                    <a class="btn btn-danger" href="{{ url('cancelled',$appoint->id) }}">Cancel</a>
                </td>
                <td>
                  <a class="btn btn-primary" href="{{ url('email_view',$appoint->id) }}">Send Mail</a>
              </td>
              </tr>
              @endforeach 
            </tbody>
          </table>
    <div>
    {{-- </div> --}}
    </div>
    </div>
    </div>   
    </div>
    </div>
    </div>
    {{-- </div> --}}
  
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
    </div>
  </body>
</html>