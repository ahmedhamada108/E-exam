<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                    <a href="{{ route('logout') }}">@lang('AdminPanel.logout')</a>
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)           
                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>           
                @endforeach
            </div>

        <div class="content">
            <div class="title m-b-md">
                @lang('AdminPanel.subjects.index')
            </div>
            @include('layouts.errors')
            @include('layouts.sessions_messages')

                <form action="{{ route('subjects.update',$subjects->id) }}" method="POST" >
                    @csrf
                    <input type="hidden" name="_method" value="put" />

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">name AR</label>
                        <input value="{{ $subjects->name_ar }}" type="text" name="name_ar" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">name EN</label>
                          <input value="{{ $subjects->name_en }}" type="text" name="name_en" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">The Levels</label>
                      <select name="level_id" class="js-example-basic-single w-100">
                          @foreach($levels as $level)
                              <option value="{{ $level->id }}" {{$level->id==$subjects['levels']->id ? 'selected' : ''}}>{{$level->name}}</option>
                          @endforeach
                      </select>        
                      </div>
                      <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">The departments</label>
                          
                          <select name="dept_id" class="js-example-basic-single w-100">
                              @foreach($departments as $department)
                                  <option value="{{ $department->id }}" {{$department->id==$subjects['departments']->id ? 'selected' : ''}}>{{$department->name}}</option>
                              @endforeach
                          </select>        
                      </div>
                      <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">The Proffessor</label>
                          
                          <select name="prof_id" class="js-example-basic-single w-100">
                              @foreach($professors as $professor)
                                  <option value="{{ $professor->id }}" {{$professor->id==$subjects['professors']->id ? 'selected' : ''}}>{{$professor->name}}</option>
                              @endforeach
                          </select>        
                      </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>            
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>
</html>
