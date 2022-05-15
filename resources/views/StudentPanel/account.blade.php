@extends('layouts.student')
@section('content')
    <!-- ---------------------------------- -->
    <!-- account Start -->
    @include('layouts.errors')
    @include('layouts.sessions_messages')
    <div class="profile">
        <div class="container">
            <div class="mt-5 mb-5">
                <div class="card">
                    <div class="card-header">
                      My Account
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered table-hover table-responsive-md">
                            <thead>
                                <tr>
                                    <th scope="col">Exam Name</th>
                                    <th scope="col">Subject Name</th>
                                    <th scope="col">Doctor Name</th>
                                    <th scope="col">degree</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Actions</th>
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
                                    <td><a href="#" class="view">View Exam</a></td>
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