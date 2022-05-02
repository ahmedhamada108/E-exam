@extends('layouts.app')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        @include('layouts.errors')
        @include('layouts.sessions_messages')
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Student Subjects</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Subjects</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          @foreach($subjects as $subject)
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$subject->name}}</h3>

                <p> Doctor: {{ $subject['professors']->name }}</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <?php
                $exam =App\Models\exam::where('subject_id',$subject->id)->get();
              ?>
              @if($exam->count()==0)
                <a href="#" class="small-box-footer">Not exists exam <i class="fas fa-arrow-circle-right"></i></a>
              @else
                @foreach($exam as $exam_check)
                  <a href="{{ route('student.exam',[$exam_check->id,$subject->id]) }}" class="small-box-footer">{{ $exam_check->exam_name }} <i class="fas fa-arrow-circle-right"></i></a>
                @endforeach
              @endif
            </div>
          </div>
          <!-- ./col -->
          @endforeach
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
@endsection