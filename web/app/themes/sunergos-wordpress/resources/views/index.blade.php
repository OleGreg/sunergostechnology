@extends('layouts.app')

@section('content')
  <section class="container"
   @if(is_home()) itemscope itemtype="https://schema.org/Blog" @endif
  >
    @include('partials.page-header')

    {{-- <pre>
      @php(var_dump(get_categories()))
    </pre> --}}

    {!! $categoryButtons !!}

    <div class="posts-container grid grid-cols-4 max-lg:grid-cols-3 max-md:grid-cols-2 gap-5 my-14">

      @if (! have_posts())
        <x-alert type="warning">
          {!! __('Sorry, no results were found.', 'sage') !!}
        </x-alert>
    
        {!! get_search_form(false) !!}
      @endif

      @while(have_posts()) @php(the_post())
        @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
      @endwhile
    </div>
    
    {!! $pagination !!}
  </section>
@endsection

@section('sidebar')
  @include('sections.sidebar')
@endsection
