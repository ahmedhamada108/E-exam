@extends('layouts.student')
@section('content')
    <!-- Exam Start -->
    <section class="exam"  ondragstart="return false;" onselectstart="return false;"  oncontextmenu="return false;" onload="clearData();" onblur="clearData();">
        <div class="container">
            <?php
                $end_at= \Carbon\Carbon::parse($questions_exam[0]->exam->end_at);
                $current_time = \Carbon\Carbon::now();
                $exam_duration= $current_time->diffInMinutes($end_at);
            ?>
            <div 
            style="font-size: 20px;
            font-weight: bold;
            background: #f5f5dc;
            padding: 5px 0;
            margin-bottom: 49px;
            margin-top: -25px;" 
            class="time text-center mb-5">Time: <span style="color: #ff4c3b;" id="timer">{{ $exam_duration }}</span> Minutes
        </div>
        <form action="{{ route('post_exam',$exam_id) }}" method="post">
            @csrf
        @foreach($questions_exam as $question)    
            <!-- Question -->
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Q: </strong> {{ $question->mcq->question_name }} ? 
                </div>
                <div class="card-body">
                    <?php
                        $options =App\Models\answer::where('mcq_id',$question->mcq->id)->inRandomOrder()->limit(4)->get();
                    ?>
                    @foreach($options as $option)
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <input name="{{$question->mcq->id}}" type="radio" aria-label="Radio button for following text input" class="select_answer">
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

            <div class="card mt-4">
                <input style="border-radius: 4px; border: none; font-size: 19px; cursor: pointer;" class="w-100 p-2 bg-success text-white submit" type="submit" value="Submit">            </div>
        </form>   
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
<!-- Function Count Down Time By Minutes -->
<script>
    var interval = setInterval(function() {
        var time = $("#timer").text();
        if (time >= 2) {
            time --;
        }
        else {
            $(".exam .submit").click();
        }
        $("#timer").html(time);
    }, 60000);
</script>

<script>
    new WOW().init();
</script>

@endsection