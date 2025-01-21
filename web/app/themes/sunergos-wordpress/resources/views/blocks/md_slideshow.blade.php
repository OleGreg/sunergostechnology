@php
  $sd_posts = new WP_Query([
    'post_type' => 'md_slides',
    'posts_per_page' => -1,
    'order' => 'ASC'
  ]);
@endphp

<div class="md-slideshow service-slideshow">
  <div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
      <!-- Slides -->
      @if($sd_posts->have_posts())
        @while($sd_posts->have_posts()) @php $sd_posts->the_post(); $slide_link = get_field('slide_link'); @endphp
          <div class="swiper-slide">
            <div class="swiper-carousel-animate-opacity">
              <div class="slide-content">
                {!! get_the_post_thumbnail() !!}
                <h3>{{ get_the_title() }}</h3>
                {!! get_field('slide_text') !!}
                @if(!empty($slide_link))
                  <a class="sunergos-cta" href="{{ $slide_link['url'] }}" aria-label="Learn more about {{ get_the_title() }}">
                    {{ $slide_link['title'] }}
                    <svg class="arrow" width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.583862 7.2485H18.9292M18.9292 7.2485L12.7553 1.07459M18.9292 7.2485L12.7553 13.4224" stroke="#26619C" stroke-width="1.05839" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </a>
                @endif
              </div>
            </div>
          </div>
        @endwhile
      @else
        <p>No Software Development Slides Found.</p>
      @endif
    </div>
  </div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
  <div class="swiper-pagination"></div>
</div>