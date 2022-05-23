@extends('layouts.app')
@section('content')

<div class="content-wrapper" style="min-height: 328.4px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>@lang('panel.chapters.chapters')</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('panel.chapters.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('subjects.index')}}">@lang('panel.chapters.subjects')</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('chapters.index',$subject_id) }}">@lang('panel.chapters.chapters')</a></li>
                </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @include('layouts.errors')
            @include('layouts.sessions_messages')
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header bg-success">
                    <h3 class="card-title">@lang('panel.chapters.add_new_chapter')</h3>
                </div>
                <!-- /.card-header -->
                <form action="{{ route('chapters.store',$subject_id) }}" method="post" >
                    @csrf
                    <div class="card-body">  
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">@lang('panel.chapters.name_ar')</label>
                            <input value="{{ old('name_ar') }}" type="text" name="name_ar" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">@lang('panel.chapters.name_en')</label>
                            <input value="{{ old('name_en') }}" type="text" name="name_en" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">@lang('panel.chapters.submit')</button>
                        </div>
                    </div>    
                  </form>

            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
  <!-- /.content -->

</div>
@endsection