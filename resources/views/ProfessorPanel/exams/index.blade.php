@extends('layouts.app')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Exams List</h1>
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
                <a class="btn btn-success mb-4 text-bold" href="{{ route('professor.exams.create') }}">Add New + </a>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Subject name</th>
                    <th>Professor Name</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($exams as $exam)  
                  <tr>
                    <td>{{ $exam->id}}</td>
                    <td>{{ $exam->exam_name}}</td>
                    <td>{{ $exam['subjects']->name}}</td>
                    <td>{{ $exam['professors']->name}}</td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-info">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu" style="">
                        <a class="dropdown-item" href="{{ route('professor.exam_structure.index',$exam->id) }}">Exam Structure</a>
                        <a class="dropdown-item" href="{{ route('professor.studnets.grades',$exam->id) }}">View Students Grades</a>
                        <a class="dropdown-item" href="{{ route('professor.exams.edit',$exam->id) }}">Edit</a>
                        <form method="post" action="{{ route('professor.exams.destroy',$exam->id) }}">
                          @method('delete')
                          @csrf
                          <button class="dropdown-item">Delete</button>
                        </form>
                        </div>
                        </div>
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