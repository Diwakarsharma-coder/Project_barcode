@extends('Layouts.master')


@section('page')

<div class="site_content">
    @include('Layouts.header')
    @yield('content')
    @include('Layouts.footer')
</div>
@stop
