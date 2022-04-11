@extends('layouts.app')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>The Structure of the exam</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('exams.index')}}">Exams</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('exam_structure.index',$exam_id) }}">Exam Structure</a></li>
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
                  <a class="btn btn-success mb-4 text-bold" href="{{ route('exam_structure.create',$exam_id) }}">Add New + </a>                 
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Exam Name</th>
                    <th>Chapter Name</th>
                    <th>Model type</th>
                    <th>Questions Number</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($exam_structures as $exam_structure)  
                  <tr>
                    <td>{{ $exam_structure['exam']->exam_name}}</td>
                    <td>{{ $exam_structure['chapter']->name}}</td>
                    <td>{{ $exam_structure['model_type']->type}}</td>
                    <td>{{ $exam_structure->number_quest}}</td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-info">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu" style="">
                        <a class="dropdown-item" href="{{ route('exam_structure.edit',[$exam_id,$exam_structure->id]) }}">Edit</a>
                        <form method="post" action="{{ route('exam_structure.destroy',[$exam_id,$exam_structure->id]) }}">
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