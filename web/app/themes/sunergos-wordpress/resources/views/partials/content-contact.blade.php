@php(the_content())

<section>
  <div class="container flex flex-row max-md:flex-col justify-between contact-us-container">
    <div class="column-one w-1/2 max-md:w-full">
      <h1>Contact Us</h1>
      <p class="text-2xl">{{ get_field('contact_us_text') }}</p>
      {!! do_shortcode('[forminator_form id="364"]') !!}
    </div>
    <div class="column-two w-1/2 flex flex-col items-center justify-center max-md:w-full max-md:mt-20">
      @include('blocks.echinacea')
      <div class="contact-text flex flex-col gap-y-7 mt-20">
        <span class="flex flex-row gap-x-2 items-center">
          <img width="30px" src="@asset('images/phone.svg')" alt="A phone icon highlighting a click to call link">
          <a class="text-2xl leading-none hover:text-darklavender" href="tel:570-209-9198">570-209-9198</a>
        </span>
        <span class="flex flex-row gap-x-2 items-center">
          <img width="30px" src="@asset('images/mail.svg')" alt="A email icon highlighting a click to email link">
          <a class="text-2xl leading-none hover:text-darklavender" href="mailto:info@sunergostechnology.com">info@sunergostechnology.com</a>
        </span>
      </div>
    </div>
  </div>
</section>
