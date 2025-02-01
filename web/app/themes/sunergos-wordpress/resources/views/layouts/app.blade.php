<!doctype html>
<html @php(language_attributes())>
  <head>
    <!-- Google Tag Manager -->
      {{-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-TZDQBFXN');</script> --}}
    <!-- End Google Tag Manager -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(!empty(get_field('meta_title')))
      <meta name="title" content="{{ get_field('meta_title') }}">
    @endif
    @if(!empty(get_field('meta_description')))
      <meta name="description" content="{{ get_field('meta_description') }}">
    @endif
    @if(!empty(get_field('schema_ld_json')))
      <script type="application/ld+json">
        {!! get_field('schema_ld_json') !!}
      </script>
    @endif
    @if(get_field('no_index'))
      ​​<meta name="robots" content="noindex" />
    @endif
    {{-- Facebook OG Metadata --}}
    <meta property="og:title" content="{{ get_the_title() }} | Articles">
    <meta property="og:description" content="{{ get_field('meta_description', get_the_ID()) }}">
    <meta property="og:image" content="https://sunergostechnology.com/app/uploads/2025/01/blog_share.png">
    <meta property="og:url" content="{{ get_permalink() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Sunergos Technology">
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
