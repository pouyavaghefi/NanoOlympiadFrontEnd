<?xml version="1.0" encoding="UTF-8"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Complete your registration</title>

    @include('web-pages.survey.reg.layouts.init.head')

    <body>
        <form id="Stepform" action="{{ route('frt.survey.reg.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <main class="overflow-hidden show-section">

                @include('web-pages.survey.reg.layouts.overalls.header')
    
                <!-- step 1 -->
                @include('web-pages.survey.reg.layouts.sections.step1')
    
                <!-- step 2 -->
                @include('web-pages.survey.reg.layouts.sections.step2')

                <!-- step 3 -->
                @include('web-pages.survey.reg.layouts.sections.step3')

                <!-- step 4 -->
{{--                @include('web-pages.survey.reg.layouts.sections.step4')--}}
            </main>
        </form>

        <div id="error"></div>

        @include('web-pages.survey.reg.layouts.init.scripts')
    </body>
</html>
