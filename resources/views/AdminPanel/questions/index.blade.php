@extends('layouts.app')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Questions List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('chapters.index',[$subject_id] ) }}">Chapters</a></li>
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
                <a class="btn btn-success mb-4 text-bold" href="{{ route('questions.create',[$subject_id,$chapter_id]) }}">Add New Question +</a>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Questions</th>
                    <th>Type</th>
                    <th>Model</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($questions as $question)  
                  <tr id="{{ $question->id }}">
                    <td>{{ $question->id}}</td>
                    <td>{{ $question->question_name}}</td>
                  @if($question->Is_TrueFalse==0)
                  <td>Multi Choices</td>
                  @else  
                    <td>True & False</td>
                  @endif  
                        @foreach($question['model_type'] as $question_model)
                            <td>{{ $question_model->type}}</td>
                        @endforeach
                    <td id="{{ $question->id }}">
                      <div class="btn-group">
                        <button type="button" class="btn btn-info">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu" style="">
                        <a class="dropdown-item" href="{{ route('questions.edit',[$subject_id,$chapter_id,$question->id]) }}">Edit</a>
                        <form method="post" action="{{ route('chapters.destroy',[$subject_id,$question->id]) }}">
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