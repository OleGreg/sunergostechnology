<!doctype html>
<html @php(language_attributes())>
  <head>
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
    @php(do_action('get_header'))
    @php(wp_head())
  </head>

  <body @php(body_class('bg-seashell'))>
    @php(wp_body_open())

    <div id="app">
      <a class="sr-only focus:not-sr-only" href="#main">
        {{ __('Skip to content') }}
      </a>

      @include('sections.header')

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
