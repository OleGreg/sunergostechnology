<article @php(post_class(['post-preview', 'active', 'max-md:mb-5'])) itemscope itemtype="https://schema.org/BlogPosting">

  <div class="relative pt-14 border-twilightblue border-2 mb-2">
    <div class="absolute top-0 right-0 bg-twilightblue text- px-4 pt-[10px] pb-1 flex flex-row items-center justify-center flex-wrap">
      {!! $postCategories !!}
    </div>
    <img class="mb-2" src="{{ $imageUrl }}" alt="{{ $imageAlt }}" itemprop="image" />
  </div>

  <h2 class="mb-1 leading-[0] entry-title" itemprop="headline">
      <a class="text-2xl" href="{{ get_permalink() }}" itemprop="url">
        {!! $title !!}
      </a>
  </h2>

  @include('partials.entry-meta')

  <meta itemprop="mainEntityOfPage" content="{{ get_permalink() }}" />
  {{-- <div class="entry-summary">
    @php(the_excerpt())
  </div> --}}
</article>