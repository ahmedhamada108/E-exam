@extends('layouts.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              @include('layouts.errors')
              @include('layouts.sessions_messages')
              <div class="row mb-2">
                  <div class="col-sm-6">
                  <h1>Exam</h1>
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
                      <h3 class="card-title">Exam</h3>
                  </div>
                  
                  <!-- /.card-header -->
                  <form action="{{ route('post_exam',$exam_id) }}" method="post">
                      @csrf
                    @foreach($questions_exam as $question)
                        <div class="card-body">
                          <label class="mt-3">{{ $question->mcq->question_name }}</label>

                          <?php
                            $options =App\Models\answer::where('mcq_id',$question->mcq->id)->inRandomOrder()->limit(4)->get();
                          ?>
                          @foreach($options as $option)
                              <div class="input-group d-flex align-items-center mb-2">
                                <div class="input-group-prepend">
                                    <span style="padding: 11px;" class="input-group-text">
                                    <input class="correct" name="{{$question->mcq->id}}" type="radio"></span>
                                </div>
                                <input type="text"  id="answer1" value="{{$option->answer}}" class="form-control">
                            </div>
                             <!-- /input-group -->
                          @endforeach
                          <input type="text" style="display: none"  name="mcq_id[]" value="{{$question->mcq->id}}" class="form-control">
                        </div>
                        <div  class="form-group mt-4">
                            <label for="exampleInputEmail1">Correct Answer:</label>
                            <input disabled id="correct" name="student_answer[]" type="text" class="form-control" id="exampleInputEmail1">
                        </div>

                    @endforeach      

                      <!-- /.card-body -->
                      <div class="card-footer">
                          <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                  </form>

              </div>
              <!-- /.card -->
          </div>
          <!-- /.container-fluid -->
      </section>
    <!-- /.content -->

  </div>

  <!-- /.content-wrapper -->
@endsection