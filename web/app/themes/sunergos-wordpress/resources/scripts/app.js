import domReady from '@roots/sage/client/dom-ready';
import { initializeHoverImages } from './animations/animations.hover.image';
import { addSubmenuDropdown, hideNavShadow, toggleMobileNav, initHeadroom } from './navigation/header';
import { initCategoryButtons } from './navigation/blog.index';
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
  initHeadroom();
  initCategoryButtons();
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
