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
                            $exam =App\Models\exam::where('subject_id',$subject->id)->get();
                        ?>
                        @if($exam->count()==0)
                            <div class="card-footer">
                                <a class="start" href="#">There is no exam for this subject</a>
                            </div>
                        @else
                            @foreach($exam as $exam_check)
                                <div class="card-footer">
                                    <a class="start" href="{{ route('student.exam',[$exam_check->id,$subject->id]) }}">Start Exam Now</a>
                                </div>
                            @endforeach
                        @endif
                                </div>
                            </div>
            @endforeach
            </div>
        </div>
    </section>
    <!-- Subjects End -->
    <!-- ---------------------------------- -->

@endsection