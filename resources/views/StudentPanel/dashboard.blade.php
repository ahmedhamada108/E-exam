@extends('layouts.student')
@section('content')
    <!--home section start-->
    <section class="main-img responsive-img  pt-0" id="img-bg">
        <div class="container-fluid">
            <div class="main-contain">
                <div>
                    <h1 class="m-0">@lang('student.site.exam') <span> @lang('student.site.smart')</span></h1>
                    <h3 class="m-0"><span>@lang('student.site.the_best_test')</span> @lang('student.site.for_students_and_professors')</h3>
                    <img src="assets/images/landing-page/text.png" alt="" class="img-fluid">
                    @if (session('success_exam'))
                        <h3 class="m-0">{{ session('success_exam') }}<span style="color: #ff4c3b;font-size: 25px;">
                            {{ session('student_grade') }}</span>/{{ session('exam_grade') }}</h3>
                    @else
                        @auth('student')
                            <h3 class="m-0">@lang('student.site.welcome') <span>{{ auth('student')->user()->name }}</span> @lang('student.site.in_smart_exam')</h3>
                        @endauth
                    @endif
                </div>
            </div>
            <div class="home-decor">
                <div class="decor-1 decor wow zoomIn" id="img-1">
                    <img src="{{ asset('assets_web/undraw_functions_re_alho.svg') }}" alt="" class="img-fluid blur-up lazyload">
                </div>
                <div class="decor-2 decor wow zoomIn" id="img-2">
                    <img src="{{ asset('assets_web/undraw_online_art_re_f1pk.svg') }}" alt="" class=" img-fluid blur-up lazyload">
                </div>
                <div class="decor-3 decor wow zoomIn" id="img-3">
                    <img src="{{ asset('assets_web/undraw_key_points_re_u903.svg') }}" alt="" class=" img-fluid blur-up lazyload">
                </div>
                <div class="decor-4 decor wow zoomIn" id="img-4">
                    <img src="{{ asset('assets_web/undraw_instant_analysis_re_mid5.svg') }}" alt="" class=" img-fluid blur-up lazyload">
                </div>
                <div class="decor-5 decor wow zoomIn" id="img-5">
                    <img src="{{ asset('assets_web/undraw_file_manager_re_ms29.svg') }}" alt="" class=" img-fluid blur-up lazyload">
                </div>
                <div class="decor-6 decor wow zoomIn" id="img-6">
                    <img src="{{ asset('assets_web/undraw_certification_re_ifll.svg') }}" alt="" class=" img-fluid blur-up lazyload">
                </div>
                <div class="decor-7 decor wow zoomIn" id="img-7">
                    <img src="{{ asset('assets_web/undraw_fitting_piece_re_pxay.svg') }}" alt="" class=" img-fluid blur-up lazyload">
                </div>
                <div class="decor-8 decor wow zoomIn" id="img-8">
                    <img src="{{ asset('assets_web/undraw_interior_design_re_7mvn.svg') }}" alt="" class=" img-fluid blur-up lazyload">
                </div>
                <div class="decor-9 decor wow zoomIn" id="img-9">
                    <img src="{{ asset('assets_web/undraw_work_in_progress_re_byic.svg') }}" alt="" class=" img-fluid blur-up lazyload">
                </div>
                <div class="decor-10 decor wow zoomIn" id="img-10">
                    <img src="{{ asset('assets_web/undraw_tasting_re_3k5a.svg') }}" alt="" class=" img-fluid blur-up lazyload">
                </div>
                <div class="decor-11 decor wow zoomIn" id="img-11">
                    <img src="{{ asset('assets_web/undraw_services_re_hu5n.svg') }}" alt="" class=" img-fluid blur-up lazyload">
                </div>
            </div>
        </div>
    </section>
    <!--home section end-->

@endsection