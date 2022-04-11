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
                    <h1>MCQ Question</h1>
                    </div>
                    <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('chapters.index',[$subject_id] ) }}">Chapters</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('questions.index',[$subject_id,$chapter_id] ) }}">Questions</a></li>
                        <li class="breadcrumb-item active">MCQ Question</li>
                    </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header bg-success">
                        <h3 class="card-title">Edit New Question</h3>
                    </div>
                   @if($question->Is_TrueFalse==1)
                   <form action="{{ route('questions.update',[$subject_id,$chapter_id,$question->id]) }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Question Name:</label>
                            <input value="{{ $question->question_name }}" type="text" name="question_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Question">
                            <span id="exampleInputEmail1" style="padding: 4px;color: #ff0000ad;position: absolute;" class="feedback">
                                Please Determine The Correct Answer By The Check Button
                            </span>
                        </div><br>
                        <div class="form-group">
                            <label>Is the question is true & false or multi choices?</label>
                            <select id="trueOrfalse" name="Is_TrueFalse" class="form-control">
                                <option value="1" {{1 ==$question->Is_TrueFalse ? 'selected' : ''}}>True & False</option>
                                <option value="0" {{0 ==$question->Is_TrueFalse ? 'selected' : ''}}>Multi Choices</option>
                              </select>
                        </div>
                        <!-- /.form-group -->
                        <label class="mt-3">Add Answers:</label>
                        <!-- /input-group -->
                        <div class="custom-control custom-radio mb-2">
                            <input class="custom-control-input" type="radio" id="customRadio21" name="customRadio" checked="">
                            <label for="customRadio21" class="custom-control-label">True</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio">
                            <label for="customRadio2" class="custom-control-label">False</label>
                        </div>
                        <!-- /input-group -->
                        <div style="display: none" class="form-group mt-4">
                            <label for="exampleInputEmail1">Correct Answer:</label>
                            <input id="correct" name="correct_answer" type="text" class="form-control" id="exampleInputEmail1" style="display: none">
                        </div>
                        <!-- /options-group -->
                        <div class="form-group">
                            <label>Select Models</label>
                            <select name="model_type_id" class="form-control select2" style="width: 100%;">
                                <option value="1">A</option>
                                <option value="2">B</option>
                                <option value="3">C</option>
                            </select>
                        </div> 
                        <!-- /.form-group -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>  
                   @else 
                    <!-- /.card-header -->
                    
                    @endif
                </div>
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
        </section>
      <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->
    <script>
        window.addEventListener("load", () => { // when the page loads
        document.getElementById("trueOrfalse").addEventListener("change", function() {
        document.getElementById("hide1").classList.toggle("hide", this.value === "1")
            })
        })
     </script>
@endsection