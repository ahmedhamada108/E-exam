@extends('layouts.app')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Students List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Table</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @include('layouts.errors')
            @include('layouts.sessions_messages')
            <!--Table -->
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <div class="dropdown" style="float: right;">
                  <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false">
                      Sort by:
                      @if(Request::get('sort')=="pending_status")
                        Status: Pending Students
                      @elseif(Request::get('sort')=="accepted_status")
                        Status: Accepted Student 
                      @elseif(Request::get('sort')== null)
                          All Students
                      @endif
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                      <a href="{{url()->current()."?sort=pending_status"}}" class="dropdown-item" >Status: Pending Students</a>
                      <a href="{{url()->current()."?sort=accepted_status"}}" class="dropdown-item" >Status: Accepted Students</a>
                  </div>
                </div>

                <a class="btn btn-success mb-4 text-bold" href="{{route('students.create')}}">Add New + </a>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($students as $student)  
                  <tr>
                    <td>{{ $student->id}}</td>
                    <td>{{ $student->name}}</td> 
                    <td>{{ $student->email}}</td> 
                    @if($student->Is_active==1)
                      <td>Accepted</td>
                    @else 
                      <td>Pending</td>
                    @endif
                    <td>
                        <a style="float: left;" class="btn btn-primary" href="{{ route('students.edit', $student->id ) }}">Edit</a>
                        <form method="post" action="{{ route('students.destroy',$student->id) }}">
                          @method('delete')
                          @csrf
                          <button class="btn btn-danger">Delete</button>

                      </form>
                    </td>
                  </tr>
                  </tbody>
                @endforeach
      
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
    <!-- /.content-wrapper -->
@endsection