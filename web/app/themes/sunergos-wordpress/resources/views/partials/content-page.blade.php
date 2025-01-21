@php(the_content())

@if ($pagination)
  <div class="container mx-auto">
    <nav class="page-nav" aria-label="Page">
      {!! $pagination !!}
    </nav>
  </div>
@endif
