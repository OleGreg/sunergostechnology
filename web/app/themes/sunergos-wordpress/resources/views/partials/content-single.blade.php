<article @php(post_class(['h-entry', 'relative', 'overflow-hidden']))>
  <img class="absolute object-cover h-[512px]" src="@asset('images/blog_bg.png')" alt="A large honeycomb image, displayed lightly in the background">
  <div class="container">

    <header class="h-[512px] flex flex-row items-center justify-center mb-10">
      <img width="200px" src="{{ $imageUrl }}" alt="{{ $imageAlt }}" itemprop="image" />
      <div class="w-[370px] flex flex-col items-center mb-3">
        <h1 class="text-center text-4xl">{!! $title !!}</h1>
        @include('partials.entry-meta')
      </div>
    </header>
  
    <div class="e-content">
      @php(the_content())
    </div>
  
    @if ($pagination)
      <footer>
        <nav class="page-nav" aria-label="Page">
          {!! $pagination !!}
        </nav>
      </footer>
    @endif
  
    @php(comments_template())
  </div>
</article>
