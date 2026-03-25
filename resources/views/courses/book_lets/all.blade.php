@extends('layouts.master')

@section('title','Booklets')

@section('style')
<style>
    .whats-float {
        position: fixed;
        transform:translate(108px,0px);
        top:25%;
        right:0;
        width:150px;
        overflow: hidden;
        background-color: #25d366;
        color: #FFF;
        border-radius: 2px 0 0 2px;
        z-index: 10;
        transition: all 0.5s ease-in-out;
        vertical-align: middle
    }
    .whats-float a span {
        color: white;
        font-size: 15px;
        padding-top: 8px;
        padding-bottom: 10px;
        position: absolute;
        line-height: 16px;
        font-weight: bolder;
    }

    .whats-float i {
        font-size: 30px;
        color: white;
        line-height: 30px;
        padding: 10px;
        transform:rotate(0deg);
        transition: all 0.5s ease-in-out;
        text-align:center;

    }

    .whats-float:hover {
        color: #FFFFFF;
        transform:translate(0px,0px);
    }

    .whats-float:hover i  {
        transform:rotate(360deg);
    }
</style>
@endsection

@section('wrapper')

@include('layouts.includes.gadgets.booklets-all')

@endsection

@section('scripts')
<script>
    function showPrivateCourseGuide() {
        Swal.fire({
            icon: 'info',
            title: 'Private Course',
            text: 'This course is only available to users who are signed up.',
            showCancelButton: true,
            confirmButtonText: 'Got it!',
            cancelButtonText: 'Register Now',
            reverseButtons: true
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.cancel) {
                window.location.href = '{{ route("cla.register") }}'; // Change to your actual registration route
            }
        });
    }

</script>
@endsection
