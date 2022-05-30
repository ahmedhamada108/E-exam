@extends('layouts.student')
@section('content')
    <!-- ---------------------------------- -->
    <!-- Subjects Start -->
    @include('layouts.errors')
    @include('layouts.sessions_messages')
    <section class="subjects">
        <div class="container">
            <div class="row">
            @foreach($subjects as $subject)
                <!-- Card -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card">
                        <img src="{{ $subject->subject_image}}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-center">
                              <div class="img-box">
                                  <img class="w-100 h-100" src="{{ asset('assets_web/images/doctors/2.jpg') }}" alt="">
                              </div>
                              <div class="title">{{ $subject['professors']->name }}</div>
                          </div>
                          <p class="card-text">
                              </p><div class="name">{{ $subject->name }}</div>
                              <div class="info">{{ $subject['levels']->name }}, {{ $subject['departments']->name }}</div>
                          <p></p>
                        </div>
                        <?php
                            $exam =App\Models\exam::where([['subject_id','=',$subject->id]])->get();
                            $opening_exam =App\Models\exam::where([['subject_id','=',$subject->id],['Is_available','=',1]])->get();
                            $pending_exam =App\Models\exam::where([['subject_id','=',$subject->id],['Is_available','=',0]])->get();
                        ?>
                        @if($exam->count()==0)
                            <div class="card-footer">
                                <a class="start" href="#">@lang('student.subjects.There_is_no_exam_for_this_subject')</a>
                            </div>
                        @endif
                        {{-- handle not exists exam for this subject     --}}
                        @if(
                        $opening_exam->count() >=1 and
                        $opening_exam[0]->start_at <= \Carbon\Carbon::now()->timestamp 
                        ) 
                            @foreach($opening_exam as $exam_check)
                                <div class="card-footer">
                                    <a class="start" href="{{ route('student.exam',[$exam_check->id,$subject->id]) }}">@lang('student.subjects.Start_the_exam_now')</a>
                                </div>
                            @endforeach
                        @endif
                        {{-- handle the exam is opening --}}
                        
                        @if($pending_exam->count() == 1 &&
                        \Carbon\Carbon::parse($pending_exam[0]->end_at)->timestamp <= \Carbon\Carbon::now()->timestamp
                        )
                            <div class="card-footer">
                                <a class="start" href="#">@lang('student.subjects.There_is_no_exam_for_this_subject') finish</a>
                            </div>
                        @endif
                        {{-- handle the exam is finished --}}

                        @if($pending_exam->count() == 1 &&
                        $pending_exam[0]->start_at >= \Carbon\Carbon::now()->timestamp
                        )
                            <div class="card-footer">
                                <a class="start" href="#">@lang('student.subjects.Will_start_in'): <br>{{date("Y-m-d g:i A",$pending_exam[0]->start_at)}}</a>
                            </div>
                        @endif
                        {{-- handle the exam is comming --}}
                                </div>
                            </div>
            @endforeach
            </div>
        </div>
    </section>
    <!-- Subjects End -->
    <!-- ---------------------------------- -->

@endsection