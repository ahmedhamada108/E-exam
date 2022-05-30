@extends('layouts.app')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>The Students Grades</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('exams.index')}}">Exams</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('studnets.grades',$exam_id) }}">Students Grades</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @include('layouts.errors')
            @include('layouts.sessions_messages')
            <!--Table -->
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Student Name</th>
                    <th>Student Email</th>
                    <th>Total Exam Marks</th>
                    <th>Total Student Marks</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($student_grades as $student_grade)  
                  <tr>
                    <td>{{ $student_grade['student']->name}}</td>
                    <td>{{ $student_grade['student']->email}}</td>
                    <td>{{ $student_grade->exam_grade}}</td>
                    <td>{{ $student_grade->student_grade}}</td>
                  </tr>
                  </tbody>
                @endforeach
      
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
    <!-- /.content-wrapper -->
@endsection