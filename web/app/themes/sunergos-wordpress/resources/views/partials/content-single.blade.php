<article @php(post_class(['h-entry', 'relative', 'overflow-hidden', '-top-[14px]', 'relative']))>
  <img class="absolute object-cover h-[515px] max-md:hidden -z-10" src="@asset('images/blog_bg.png')" alt="A large honeycomb image, displayed lightly in the background">
  <img class="absolute object-cover h-[515px] md:hidden -z-10" src="@asset('images/blog_bg_mobile.png')" alt="A small honeycomb image, displayed lightly in the background">
  <div class="container">

    <header class="h-[515px] max-md:h-auto flex flex-row max-md:flex-col items-center justify-center mb-3 max-md:mt-16">
      <img width="200px" class="max-md:mb-5" src="{{ $imageUrl }}" alt="{{ $imageAlt }}" itemprop="image" />
      <div class="w-[370px] max-md:w-[325px] flex flex-col items-center mb-3">
        <h1 class="text-center text-4xl mb-2">{!! $title !!}</h1>
        <time class="dt-published text-twilightblue" datetime="{{ get_post_time('c', true) }}" itemprop="datePublished">
          {{ get_the_date() }}
        </time>
        
        <div class="relative post-single-categories flex flex-row items-center italic">
          {!! $postCategories !!}
        </div>
        
        <p class="relative bottom-[3px]">
          <span class="text-base">
            {{ __('By', 'sage') }} 
            <span class="text-base" itemprop="author">{{ get_the_author() }}</span>
          </span>
          {{-- <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" class="p-author h-card">
            {{ get_the_author() }}
          </a> --}}
        </p>
      </div>
    </header>
  </div>

    @if($sunergosBreadcrumbs)
      <div class="breadcrumbs-container container relative mb-10 max-md:mb-3">
        {!! $socialShareButtons !!}
        {!! $sunergosBreadcrumbs !!}
      </div>
    @endif
  
    <div class="e-content mb-12 max-md:mb-7">
      @php(the_content())
    </div>

    <div class="container mb-12 max-md:mb-7">
      <a class="flex flex-row items-center" href="{{ get_permalink(get_option('page_for_posts')) }}">
        <img class="rotate-180 h-3 mr-2" src="@asset('images/cta_arrow.svg')" alt="">
        Back to {{ get_the_title( get_option('page_for_posts') ) }}
      </a>
    </div>
  
    <div class="container">
      @if ($pagination)
        <footer>
          <nav class="page-nav" aria-label="Page">
            {!! $pagination !!}
          </nav>
        </footer>
      @endif
    </div>
  
    {{-- @php(comments_template()) --}}
  </div>
</article>
