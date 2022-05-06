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
                        <li class="breadcrumb-item"><a href="{{ route('professor.chapters.index',[$subject_id] ) }}">Chapters</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('professor.questions.index',[$subject_id,$chapter_id] ) }}">Questions</a></li>
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
                        <h3 class="card-title">Add New Question</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ route('professor.questions.store',[$subject_id,$chapter_id]) }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Question Name:</label>
                                <input value="{{ old('question_name') }}" type="text" name="question_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Question">
                                <span id="exampleInputEmail1" style="padding: 4px;color: #ff0000ad;position: absolute;" class="feedback">
                                    Please Determine The Correct Answer By The Check Button
                                </span>
                            </div><br>
                            <div class="form-group">
                                <label>Is the question is true & false or multi choices?</label>
                                <select id="trueOrfalse" name="Is_TrueFalse" class="form-control">
                                    <option value="1" selected>True & False</option>
                                    <option value="0">Multi Choices</option>
                                  </select>
                            </div>
                            <!-- /.form-group -->
                            <label class="mt-3">Add Answers:</label>

                            <div class="input-group d-flex align-items-center mb-2">
                                <strong class="mr-2">A: </strong>
                                <div class="input-group-prepend">
                                    <span style="padding: 11px;" class="input-group-text">
                                    <input class="correct" name="correct" type="radio"></span>
                                </div>
                                <input type="text" id="answer1" name="answer[]" class="form-control">
                            </div>
                            <!-- /input-group -->
                            <div class="input-group d-flex align-items-center mb-2">
                                <strong class="mr-2">B: </strong>
                                <div class="input-group-prepend">
                                    <span style="padding: 11px;" class="input-group-text">
                                    <input class="correct" name="correct" type="radio"></span>
                                </div>
                                <input type="text" id="answer2" name="answer[]" class="form-control">
                            </div>
                            <!-- /input-group -->
                        <div class="hide" id="hide1">   
                            <div class="input-group d-flex align-items-center mb-2">
                                <strong class="mr-2">C: </strong>
                                <div class="input-group-prepend">
                                    <span style="padding: 11px;" class="input-group-text">
                                    <input class="correct" name="correct" type="radio"></span>
                                </div>
                                <input type="text" name="answer[]" class="form-control">
                            </div>
                            <!-- /input-group -->
                            <div class="input-group d-flex align-items-center mb-2" >
                                <strong class="mr-2">D: </strong>
                                <div class="input-group-prepend">
                                    <span style="padding: 11px;" class="input-group-text">
                                    <input class="correct" name="correct" type="radio"></span>
                                </div>
                                <input type="text" name="answer[]" class="form-control">
                            </div>
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