{{--
  Template Name: Contact Form Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.content-contact')
  @endwhile
@endsection
