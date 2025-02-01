import cta_arrow_image from '../../images/cta_arrow.svg';
import Headroom from "headroom.js";

function initHeadroom() {
  // select your header or whatever element you wish
  const header = document.querySelector("header");
  const options = {
    offset : 100,
    tolerance: 10
  };
  const headroom = new Headroom(header, options);
  headroom.init();
}

function toggleMobileNav() {
  const hamburger = document.getElementById('hamburger');
  const primary_nav = document.querySelector('.nav-primary');
  hamburger.addEventListener('click', function() {
    this.classList.toggle('active');
    primary_nav.classList.toggle('active');
  })
}

function addSubmenuDropdown() {
  const nav_items_with_children = document.querySelectorAll('.menu-item-has-children');
  nav_items_with_children.forEach((nav_item) => {
    let submenu_dropdown = document.createElement('img');
    submenu_dropdown.classList.add('submenu-dropdown');
    submenu_dropdown.setAttribute('src', cta_arrow_image);
    submenu_dropdown.setAttribute('alt', "");
    nav_item.appendChild(submenu_dropdown);
    submenu_dropdown.addEventListener('click', function() {
      this.classList.toggle('active');
      let parent_element = this.parentElement
      let submenu = parent_element.querySelector('.sub-menu');
      submenu.classList.toggle('active');
    });
  });
}

function hideNavShadow() {
  const nav_items_with_children = document.querySelectorAll('.menu-item-has-children');
  const header = document.querySelector('header');
  nav_items_with_children.forEach((nav_item) => {
    nav_item.addEventListener('mouseover', function() {
      header.classList.remove('shadow-md');
    });
    nav_item.addEventListener('mouseleave', function() {
      header.classList.add('shadow-md');
    })
  });
}

export { toggleMobileNav, hideNavShadow, addSubmenuDropdown, initHeadroom }