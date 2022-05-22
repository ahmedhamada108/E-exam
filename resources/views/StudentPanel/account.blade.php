@extends('layouts.student')
@section('content')
    <!-- ---------------------------------- -->
    <!-- account Start -->

    <div class="profile">
        <div class="container">
            <div class="mt-5 mb-5">
                <div class="card">
                    <div class="card-header">
                      @lang('student.account.My_Account')
                    </div>
                    @include('layouts.errors')
                    @include('layouts.sessions_messages')
                    <div class="card-body">
                        <table class="table table-striped table-bordered table-hover table-responsive-md">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('student.account.Exam_Name')</th>
                                    <th scope="col">@lang('student.account.Subject_Name')</th>
                                    <th scope="col">@lang('student.account.Doctor_Name')</th>
                                    <th scope="col">@lang('student.account.degree')</th>
                                    <th scope="col">@lang('student.account.Date')</th>
                                    <th scope="col">@lang('student.account.Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($student_exams as $student_exam)
                                <tr>
                                    <td>{{ $student_exam['exam']->exam_name }}</td>
                                    <td>{{ $student_exam['exam']->subjects->subject_name }}</td>
                                    <td>{{ $student_exam['exam']->professors->name }}</td>
                                    <td>{{ $student_exam->student_grade }}/<span>{{ $student_exam->exam_grade }}</span></td>
                                    <td>{{ $student_exam->created_at->toDayDateTimeString() }}</td>
                                    <td><a href="{{ route('student.account.viewexam',$student_exam->exam_id) }}" class="view">@lang('student.account.View_Exam')</a></td>
                                </tr>
                            @endforeach    
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- account End -->
    <!-- ---------------------------------- -->

@endsection