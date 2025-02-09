<!doctype html>
<html @php(language_attributes())>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(get_field('no_index'))
      ​​<meta name="robots" content="noindex" />
    @endif
    @if(!empty(get_field('meta_title')))
    <meta name="title" content="{{ get_field('meta_title') }}">
    @endif
    @if(!empty(get_field('meta_description')))
    <meta name="description" content="{{ get_field('meta_description') }}">
    @endif
    {!! $schemaJSON !!}
    @if(is_single())
      <link rel="canonical" href="{{ get_permalink() }}">
    @endif
    {{-- Facebook OG Metadata --}}
    @if(is_single())
    <meta property="og:title" content="{{ get_the_title() }} | Articles">
    @else
    <meta property="og:title" content="{{ get_the_title() }} | Sunergos Technology">
    @endif
    <meta property="og:description" content="{{ get_field('meta_description', get_the_ID()) }}">
    <meta property="og:image" content="https://sunergostechnology.com/app/uploads/2025/01/blog_share.png">
    <meta property="og:url" content="{{ get_permalink() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Sunergos Technology">
    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@SunergosTech" />
    @if(is_single())
    <meta name="twitter:title" content="{{ get_the_title() }} | Articles" />
    @else
    <meta name="twitter:title" content="{{ get_the_title() }} | Sunergos Technology" />
    @endif
    <meta name="twitter:description" content="{{ get_field('meta_description', get_the_ID()) }}" />
    <meta name="twitter:image" content="https://sunergostechnology.com/app/uploads/2025/01/blog_share.png" />
    @php(do_action('get_header'))
    @php(wp_head())
  </head>

  <body @php(body_class('bg-seashell'))>
    <!-- Google Tag Manager (noscript) -->
      <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TZDQBFXN"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    @php(wp_body_open())

    <div id="app">
      <a class="sr-only focus:not-sr-only" href="#main">
        {{ __('Skip to content') }}
      </a>

      @include('sections.header')

      @if($sunergosBreadcrumbs && is_page())
        <div class="breadcrumbs-container container mx-auto relative py-5">
          {!! $sunergosBreadcrumbs !!}
        </div>
      @endif

      <main id="main" class="main">
        @yield('content')
      </main>

      @hasSection('sidebar')
        <aside class="sidebar">
          @yield('sidebar')
        </aside>
      @endif

      @include('sections.footer')
    </div>

    @php(do_action('get_footer'))
    @php(wp_footer())
  </body>
</html>
