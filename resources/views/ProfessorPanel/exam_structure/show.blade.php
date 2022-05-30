@extends('layouts.app')
@section('content')

<div class="content-wrapper" style="min-height: 328.4px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>The Structure of the exam</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
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
                    <h3 class="card-title">Edit the Exam Structure</h3>
                </div>
                <!-- /.card-header -->    
                <form action="{{  route('professor.exam_structure.update',[$exam_id,$exam_structure->id])}}" method="POST" >
                    @csrf
                    <input type="hidden" name="_method" value="put" />
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
                                    <option value="{{ $model_type->id }}" {{$model_type->id==$exam_structure['model_type']->id ? 'selected' : ''}}>{{$model_type->type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Is the question is true & false or multi choices?</label>
                            <select id="trueOrfalse" name="Is_TrueFalse" class="form-control">
                                <option value="1"  {{1 ==$exam_structure->Is_TrueFalse ? 'selected' : ''}} >True & False</option>
                                <option value="0"  {{0 ==$exam_structure->Is_TrueFalse ? 'selected' : ''}}>Multi Choices</option>
                              </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">Number Questions</label>
                            <input value="{{ $exam_structure->number_quest }}" type="number" name="number_quest" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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