<header class="banner py-6 bg-seashell shadow-md transition-all">
  <div class="container mx-auto flex flex-row items-center justify-between">
    <a class="brand font-serif" href="{{ home_url('/') }}" aria-label="Go to homepage">
      {{-- {!! $siteName !!} --}}
      <img width="287px" height="55px" class="max-md:w-[200px]" src="@asset('images/header_brand.svg')" alt="Sunergos">
    </a>
  
    @if (has_nav_menu('primary_navigation'))
      <nav class="nav-primary" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}
      </nav>
    @endif

    <div id="hamburger" class="hamburger lg:hidden">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
</header>