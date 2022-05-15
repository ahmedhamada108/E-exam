@extends('layouts.app')
@section('content')

<div class="content-wrapper" style="min-height: 328.4px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Subjects</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('subjects.index') }}" >Subjects</a></li>
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
                    <h3 class="card-title">Edit the subject</h3>
                </div>
                <!-- /.card-header -->
                <form action="{{ route('subjects.update',$subjects->id) }}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="put" />
                    <div class="card-body">  
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">name AR</label>
                            <input value="{{ $subjects->name_ar }}" type="text" name="name_ar" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">name EN</label>
                            <input value="{{ $subjects->name_en }}" type="text" name="name_en" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">Subject Images</label>
                            <input type="file" name="subject_image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label>Select levels</label>
                            <select name="level_id" class="form-control select2" style="width: 100%;">
                                @foreach($levels as $level)    
                                    <option value="{{ $level->id }}" {{$level->id==$subjects['levels']->id ? 'selected' : ''}}>{{$level->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Department</label>
                            <select name="dept_id" class="form-control select2" style="width: 100%;">
                                @foreach($departments as $deaprtment)    
                                    <option value="{{ $deaprtment->id }}" {{$deaprtment->id==$subjects['departments']->id ? 'selected' : ''}} >{{$deaprtment->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Professor</label>
                            <select name="prof_id" class="form-control select2" style="width: 100%;">
                                @foreach($professors as $professor)    
                                    <option value="{{ $professor->id }}" {{$professor->id==$subjects['professors']->id ? 'selected' : ''}}>{{$professor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Submit</button>
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