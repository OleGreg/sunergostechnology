import domReady from '@roots/sage/client/dom-ready';
import { initializeHoverImages } from './animations/animations.hover.image';
import { addSubmenuDropdown, hideNavShadow, toggleMobileNav } from './helpers/header';
import { initializeAllSlideshows } from './slideshows/slideshow.services';

/**
 * Application entrypoint
 */
domReady(async () => {
  initializeHoverImages();
  toggleMobileNav();
  hideNavShadow();
  addSubmenuDropdown();
  initializeAllSlideshows();
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
