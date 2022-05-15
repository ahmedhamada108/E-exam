@extends('layouts.app')
@section('content')

<div class="content-wrapper" style="min-height: 328.4px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Chapters</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('exams.index') }}" >Exams</a></li>
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
                    <h3 class="card-title">Edit the Exam</h3>
                </div>
                <!-- /.card-header -->
                <form action="{{ route('exams.update',$exam->id) }}" method="POST" >
                    @csrf
                    <input type="hidden" name="_method" value="put" />
                    <div class="card-body">  
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">Exam Name</label>
                            <input value="{{ $exam->exam_name }}" type="text" name="exam_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label>Select Subject</label>
                            <select name="subject_id" class="form-control select2" style="width: 100%;">
                                @foreach($subjects as $subject)    
                                    <option value="{{ $subject->id }}" {{$subject->id==$exam->subject_id ? 'selected' : ''}}>{{$subject->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Professor</label>
                            <select name="prof_id" class="form-control select2" style="width: 100%;">
                                @foreach($professors as $professor)    
                                    <option value="{{ $professor->id }}" {{$professor->id==$exam->prof_id ? 'selected' : ''}}>{{$professor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">Start At:</label>
                            <input value="{{ \Carbon\Carbon::parse($exam->start_at)->format('Y-m-d\TH:i') }}" type="datetime-local" name="start_at" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">End After:</label>
                            <input  type="number" value="{{ $exam->duration }}" name="end_at" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            <span id="exampleInputEmail1" style="padding: 4px;color: #ff0000ad;position: absolute;" class="feedback">
                                Please Determine The time by Minutes only
                            </span>
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