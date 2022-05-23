@extends('layouts.app')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@lang('panel.subjects.subjects_list')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">@lang('panel.subjects.home')</a></li>
              <li class="breadcrumb-item active">@lang('panel.subjects.table')</li>
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
                <a class="btn btn-success mb-4 text-bold" href="{{route('subjects.create')}}">@lang('panel.subjects.add_new') + </a>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>@lang('panel.subjects.id')</th>
                    <th>@lang('panel.subjects.name')</th>
                    <th>@lang('panel.subjects.level_name')</th>
                    <th>@lang('panel.subjects.department_name')</th>
                    <th>@lang('panel.subjects.actions')</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($subjects as $subject)  
                  <tr>
                    <td>{{ $subject->id}}</td>
                    <td>{{ $subject->subject_name}}</td>
                        
                    <td>{{ $subject['levels']->name }}</td>
                    {{-- access to the levels object from subjects table --}}

                    <td>{{ $subject['departments']->dept_name}}</td>

                    {{-- access to the departmnets object from the subject table --}}
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-info">@lang('panel.subjects.actions')</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu" style="">
                        <a class="dropdown-item" href="{{ route('chapters.index', $subject->id ) }}">@lang('panel.subjects.chapters')</a>
                        <a class="dropdown-item" href="{{ route('subjects.edit', $subject->id ) }}">@lang('panel.subjects.edit')</a>
                        <form method="post" action="{{ route('subjects.destroy',$subject->id) }}">
                          @method('delete')
                          @csrf
                          <button class="dropdown-item">@lang('panel.subjects.delete')</button>
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