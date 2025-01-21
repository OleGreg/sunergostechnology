{{--
  Template Name: Careers Form Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.content-careers')
  @endwhile
@endsection
