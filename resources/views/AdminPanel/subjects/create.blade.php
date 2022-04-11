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
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('subjects.index') }}">Subjects</a></li>
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
                    <h3 class="card-title">Add New Subject</h3>
                </div>
                <!-- /.card-header -->
                <form action="{{ route('subjects.store') }}" method="post" >
                    @csrf
                    <div class="card-body">  
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">name AR</label>
                            <input value="{{ old('name_ar') }}" type="text" name="name_ar" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">name EN</label>
                            <input value="{{ old('name_en') }}" type="text" name="name_en" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        <div class="form-group">
                            <label>Select levels</label>
                            <select name="level_id" class="form-control select2" style="width: 100%;">
                                @foreach($levels as $level)    
                                    <option value="{{ $level->id }}">{{$level->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Department</label>
                            <select name="dept_id" class="form-control select2" style="width: 100%;">
                                @foreach($deaprtments as $deaprtment)    
                                    <option value="{{ $deaprtment->id }}">{{$deaprtment->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Professor</label>
                            <select name="prof_id" class="form-control select2" style="width: 100%;">
                                @foreach($professors as $professor)    
                                    <option value="{{ $professor->id }}">{{$professor->name}}</option>
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