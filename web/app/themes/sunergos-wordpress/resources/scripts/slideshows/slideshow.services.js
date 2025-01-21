//import swiper and modules
import Swiper from 'swiper';
import { Autoplay, Navigation, Pagination } from 'swiper/modules';
import EffectCarousel from './effect-carousel.esm.js';
//import styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';


function initializeAllSlideshows() {
  const slideshows = document.querySelectorAll('.swiper');

  slideshows.forEach((slideshow) => {

    //Add unique IDs to the slideshow navigations
    console.log(slideshow.closest('.service-slideshow').querySelector('.swiper-button-next'));

    let button_prev = slideshow.closest('.service-slideshow').querySelector('.swiper-button-prev');
    let button_next = slideshow.closest('.service-slideshow').querySelector('.swiper-button-next');
    let pagination = slideshow.closest('.service-slideshow').querySelector('.swiper-pagination');


    let swiper = new Swiper(slideshow, {
      modules: [EffectCarousel, Navigation, Pagination, Autoplay],
      effect: 'carousel',
      carouselEffect: {
        // opacity change per side slide
        opacityStep: 0.65,
        // scale change per side slide
        scaleStep: 0.2,
        // amount of side slides visible, can be 1, 2 or 3
        sideSlides: 1,
      },
      grabCursor: true,
      loop: true,
      loopAddBlankSlides: 1,
      slidesPerView: 'auto',
      navigation: {
        nextEl: button_next,
        prevEl: button_prev,
      },
      pagination: {
        el: pagination,
      },
      // autoplay: {
      //   delay: 3000,
      // },
    });
  });
}







export { initializeAllSlideshows };