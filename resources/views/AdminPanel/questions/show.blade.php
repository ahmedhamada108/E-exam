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
                    <h1>@lang('panel.questions.mcq_questions')</h1>
                    </div>
                    <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('panel.questions.home')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('chapters.index',[$subject_id] ) }}">@lang('panel.questions.chapters')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('questions.index',[$subject_id,$chapter_id] ) }}">@lang('panel.questions.questions')</a></li>
                        <li class="breadcrumb-item active">@lang('panel.questions.mcq_questions')</li>
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
                        <h3 class="card-title">@lang('panel.questions.add_new_question')</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ route('questions.update',[$question->id,$subject_id,$chapter_id]) }}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="put" />
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">@lang('panel.questions.questions_name'):</label>
                                <input value="{{$question->question_name}}" type="text" name="question_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Question">
                                <span id="exampleInputEmail1" style="padding: 4px;color: #ff0000ad;position: absolute;" class="feedback">
                                    @lang('panel.questions.Please_Determine_The_Correct_Answer_By_The_Check_Button')
                                </span>
                            </div><br>
                            <?php
                                $options =App\Models\answer::where('mcq_id',$question->id)->inRandomOrder()->limit(4)->get();
                            ?>
                            <!-- /.form-group -->
                            <label class="mt-3">@lang('panel.questions.add_answers'):</label>
                            @foreach($options as $option)
                                <div class="input-group d-flex align-items-center mb-2">
                                    <div class="input-group-prepend">
                                        <span style="padding: 11px;" class="input-group-text">
                                        <input {{ ($question->correct_answer == $option->answer)? "checked" : ""}} class="correct" name="correct" type="radio"></span>
                                    </div>
                                    <input type="text" id="answer1" value="{{ $option->answer }}" name="answer[]" class="form-control">
                                </div>
                            @endforeach
                            <div style="display:none" class="form-group mt-4">
                                <label for="exampleInputEmail1">Correct Answer:</label>
                                <input style="display:none" id="correct" name="correct_answer" value="{{ $question->correct_answer }}" type="text" class="form-control" id="exampleInputEmail1" >
                            </div>
                            <!-- /options-group -->
                            <div class="form-group">
                                <label>@lang('panel.questions.select_models')</label>
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
                            <button type="submit" class="btn btn-success">@lang('panel.questions.submit')</button>
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