<script>
  $(document).ready(function () {
    var owl = $('#{{$id}}Carousel');
    owl.owlCarousel({
      stagePadding: {!!$stagePadding!!},
      autoplayTimeout:{!!$autoplayTimeout!!},
      loop: {!! $loopGallery ? 'true' : 'false' !!},
      lazyLoad: true,
      margin: {!! $margin !!},
      {!! !empty($navText) ? 'navText: '.$navText."," : "" !!}
      dots: {!! $dots ? 'true' : 'false' !!},
      responsiveClass: {!! $responsiveClass ? 'true' : 'false' !!},
      autoplay: {!! $autoplay ? 'true' : 'false' !!},
      autoplayHoverPause: {!! $autoplayHoverPause ? 'true' : 'false' !!},
      nav: {!! $nav ? 'true' : 'false' !!},
      responsive: {!!$responsive!!}
    });
  });
</script>