@extends('layouts.student')
@section('content')
    <!-- Exam Start -->
    <section class="exam"  ondragstart="return false;" onselectstart="return false;"  oncontextmenu="return false;" onload="clearData();" onblur="clearData();">
        <div class="container">
            @csrf
        @foreach($questions_exam as $question)    
            <!-- Question -->
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Q: </strong> {{ $question->mcq->question_name }} ?
                </div>
                <div class="card-body">
                    @if($question->student_answer== $question->correct_answer)
                    <label>Your Answer for this Question</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input disabled type="radio" aria-label="Radio button for following text input" class="select_answer">
                            </div>
                            <div class="form-control" aria-label="Text input with radio button">✔️ {{ $question->student_answer }}</div>            
                        </div>
                    </div>
                    <hr> 
                @else
                    <label>Your Answer for this Question</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input disabled type="radio" aria-label="Radio button for following text input" class="select_answer">
                            </div>
                            <div class="form-control" aria-label="Text input with radio button">❌ {{ $question->student_answer }}</div>            
                        </div>
                    </div>
                    <hr> 
                @endif         
                    <?php
                        $options =App\Models\answer::where('mcq_id',$question->mcq->id)->inRandomOrder()->limit(4)->get();
                    ?>
                    @foreach($options as $option)
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            @if($question->student_answer== $question->correct_answer)
                            <input disabled {{ ($question->student_answer == $option->answer)? "checked" : "" }}  type="radio" aria-label="Radio button for following text input" class="select_answer">
                            @else
                            <input disabled {{ ($question->correct_answer == $option->answer)? "checked" : ""}}   type="radio" aria-label="Radio button for following text input" class="select_answer">
                            @endif
                          </div>
                        </div>
                        <div class="form-control" aria-label="Text input with radio button"> {{$option->answer}}</div>
                    </div>
                    @endforeach
                    <input type="text" style="display: none" name="mcq_id[]" value="{{$question->mcq->id}}" class="form-control">
                    <!-- hidden Input -->
                    <input type="text" style="display: none" name="student_answer[]" class="answer w-100">
                </div>
            </div>
        @endforeach    
        </div>
    </section>
    <!-- Exam End -->
<script>
        document.onkeydown = function(e) {
    if(event.keyCode == 123) {
        return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
        return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
        return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
        return false;
    }
    if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
        return false;
    }
    }
    function clearData(){
        window.clipboardData.setData('text','') 
    }
    function cldata(){
        if(clipboardData){
            clipboardData.clearData();
        }
    }
    setInterval("cldata();", 1000);
</script>
@endsection