<footer class="shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)]">
  <div class="container py-7 max-md:py-10 flex flex-row max-md:flex-col items-center justify-between">
    <div class="left-col max-md:flex max-md:flex-col max-md:gap-y-5 max-md:items-center max-md:mb-10">
      <div class="social-icons flex flex-row items-center gap-x-4">
        <a class="facebook-link" href="https://facebook.com/sunergostechnology" target="_blank" aria-label="Link to Our Facebook Page">
          <svg width="36" height="37" viewBox="0 0 36 37" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M27 3.33801H22.5C20.5109 3.33801 18.6032 4.12819 17.1967 5.53471C15.7902 6.94123 15 8.84889 15 10.838V15.338H10.5V21.338H15V33.338H21V21.338H25.5L27 15.338H21V10.838C21 10.4402 21.158 10.0587 21.4393 9.77735C21.7206 9.49605 22.1022 9.33801 22.5 9.33801H27V3.33801Z" stroke="#26619C" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>            
        </a>
        <a class="linkedin-link" href="https://www.linkedin.com/company/sunergos-technology" target="_blank" aria-label="Link to Our Facebook Page">
          <svg width="36" height="37" viewBox="0 0 36 37" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M24 12.338C26.3869 12.338 28.6761 13.2862 30.364 14.9741C32.0518 16.6619 33 18.9511 33 21.338V31.838H27V21.338C27 20.5424 26.6839 19.7793 26.1213 19.2167C25.5587 18.6541 24.7956 18.338 24 18.338C23.2044 18.338 22.4413 18.6541 21.8787 19.2167C21.3161 19.7793 21 20.5424 21 21.338V31.838H15V21.338C15 18.9511 15.9482 16.6619 17.636 14.9741C19.3239 13.2862 21.6131 12.338 24 12.338Z" stroke="#26619C" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M9 13.838H3V31.838H9V13.838Z" stroke="#26619C" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M6 9.33801C7.65685 9.33801 9 7.99487 9 6.33801C9 4.68116 7.65685 3.33801 6 3.33801C4.34315 3.33801 3 4.68116 3 6.33801C3 7.99487 4.34315 9.33801 6 9.33801Z" stroke="#26619C" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
      </div>
      <div class="footer-nav mt-5">
        @if (has_nav_menu('footer_navigation'))
          <nav class="nav-footer relative" aria-label="{{ wp_get_nav_menu_name('footer_navigation') }}">
            {!! wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => 'footer-nav', 'echo' => false]) !!}
          </nav>
        @endif
      </div>
    </div>
    <div class="right-col copyright-column flex flex-row max-md:flex-col-reverse items-center gap-x-4 max-md:gap-y-7">
      <div class="flex flex-col gap-y-1">
        <p class="text-mediterraneanblue text-base mb-0 leading-[125%]">&copy;{{ date('Y') }} Sunergos Technology</p>
        <p class="text-mediterraneanblue text-base mb-0 leading-[125%]">Wellsboro, PA 16901</p>
        <a class="text-mediterraneanblue text-base leading-[125%]" href="tel:570-209-9198">(570) 209-9198</a>
      </div>
      <img width="77px" height="auto" src="@asset('images/logo.svg')" alt="Sunergos Logo">
    </div>
  </div>
</footer>
