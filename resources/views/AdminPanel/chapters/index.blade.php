@extends('layouts.app')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@lang('panel.chapters.chapters_list')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">@lang('panel.chapters.home')</a></li>
              <li class="breadcrumb-item active">@lang('panel.chapters.table')</li>
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
                <a class="btn btn-success mb-4 text-bold" href="{{ route('chapters.create',$subject_id) }}">@lang('panel.chapters.add_new') + </a>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>@lang('panel.chapters.id')</th>
                    <th>@lang('panel.chapters.name')</th>
                    <th>@lang('panel.chapters.subject_name')</th>
                    <th>@lang('panel.chapters.actions')</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($chapters as $chapter)  
                  <tr>
                    <td>{{ $chapter->id}}</td>
                    <td>{{ $chapter->name}}</td>
                    <td>{{ $chapter['subjects']->subject_name}}</td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-info">@lang('panel.chapters.actions')</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu" style="">
                        <a class="dropdown-item" href="{{ route('questions.index',[$subject_id,$chapter->id] ) }}">@lang('panel.chapters.questions')</a>
                        <a class="dropdown-item" href="{{ route('chapters.edit',[$subject_id,$chapter->id]) }}">@lang('panel.chapters.edit')</a>
                        <form method="post" action="{{ route('chapters.destroy',[$subject_id,$chapter->id]) }}">
                          @method('delete')
                          @csrf
                          <button class="dropdown-item">@lang('panel.chapters.delete')</button>
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