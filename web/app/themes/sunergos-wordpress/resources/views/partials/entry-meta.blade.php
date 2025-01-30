<time class="dt-published text-twilightblue" datetime="{{ get_post_time('c', true) }}" itemprop="datePublished">
  {{ get_the_date() }}
</time>

<p>
  <span>
    {{ __('By', 'sage') }} 
    <span itemprop="author">{{ get_the_author() }}</span>
  </span>
  {{-- <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" class="p-author h-card">
    {{ get_the_author() }}
  </a> --}}
</p>
