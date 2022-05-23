@extends('layouts.app')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@lang('panel.questions.questions_list')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">@lang('panel.questions.home')</a></li>
              <li class="breadcrumb-item"><a href="{{ route('chapters.index',[$subject_id] ) }}">@lang('panel.questions.chapters')</a></li>
              <li class="breadcrumb-item active">@lang('panel.questions.table')</li>
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
                <a class="btn btn-success mb-4 text-bold" href="{{ route('questions.create',[$subject_id,$chapter_id]) }}">@lang('panel.questions.add_new_question') +</a>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>@lang('panel.questions.id')</th>
                    <th>@lang('panel.questions.questions')</th>
                    <th>@lang('panel.questions.type')</th>
                    <th>@lang('panel.questions.model')</th>
                    <th>@lang('panel.questions.actions')</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($questions as $question)  
                  <tr id="{{ $question->id }}">
                    <td>{{ $question->id}}</td>
                    <td>{{ $question->question_name}}</td>
                  @if($question->Is_TrueFalse==0)
                  <td>@lang('panel.questions.multi_choices')</td>
                  @else  
                    <td>@lang('panel.questions.true_&_false')</td>
                  @endif  
                        @foreach($question['model_type'] as $question_model)
                            <td>{{ $question_model->type}}</td>
                        @endforeach
                    <td id="{{ $question->id }}">
                      <div class="btn-group">
                        <button type="button" class="btn btn-info">@lang('panel.questions.actions')</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu" style="">
                        <form method="post" action="{{ route('chapters.destroy',[$subject_id,$question->id]) }}">
                          @method('delete')
                          @csrf
                          <button class="dropdown-item">@lang('panel.questions.delete')</button>
                        </form>
                        </div>
                        </div>
                    </td>
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