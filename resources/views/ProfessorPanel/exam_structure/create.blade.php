@extends('layouts.app')
@section('content')

<div class="content-wrapper" style="min-height: 328.4px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Exam Structures</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('professor.exams.index')}}">Exams</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('professor.exam_structure.index',$exam_id) }}">Exam Structure</a></li>
                </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @include('layouts.errors')
            @include('layouts.sessions_messages')
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header bg-success">
                    <h3 class="card-title">Add New Structure for the Exam</h3>
                </div>
                <!-- /.card-header -->
                <form action="{{ route('professor.exam_structure.store',$exam_id) }}" method="post" >
                    @csrf
                    <div class="card-body">  
                        <div class="form-group">
                            <label>Select Chapter</label>
                            <select name="chapter_id" class="form-control select2" style="width: 100%;">
                                @foreach($chapters as $chapter)    
                                    <option value="{{ $chapter->id }}">{{$chapter->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select The Model</label>
                            <select name="model_type_id" class="form-control select2" style="width: 100%;">
                                @foreach($models_type as $model_type)
                                    <option value="{{ $model_type->id }}">{{$model_type->type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Is the question is true & false or multi choices?</label>
                            <select id="trueOrfalse" name="Is_TrueFalse" class="form-control">
                                <option value="1" selected>True & False</option>
                                <option value="0">Multi Choices</option>
                              </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">Number Questions</label>
                            <input value="" type="number" name="number_quest" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>    
                  </form>

            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
  <!-- /.content -->

</div>
@endsection