import hover_image_src from '../../images/button_hover_animated.svg';

function createHoverImage() {
  let hover_image = document.createElementNS("http://www.w3.org/2000/svg", "svg");
  hover_image.setAttribute('class', 'hover-image');
  hover_image.setAttribute('width', '297');
  hover_image.setAttribute('height', '29');
  hover_image.setAttribute('viewBox', '0 0 297 29');
  hover_image.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
  hover_image.setAttribute('fill', 'none');
  hover_image.innerHTML = '\
    <path stroke-width="1" class="hover_path_1" stroke="#26619C" d="M1 1C3.5 2.83333 20.3 6.4 67.5 6C126.5 5.5 158.5 8 158 19C157.6 27.8 137.167 28.6667 127 28C120.333 27 109 23.4 117 17C125 10.6 139 13 145 15C147.5 15.6667 152.4 17.5 152 19.5C151.6 21.5 143.167 23.3333 139 24C133.5 24.5 121.9 24.8 119.5 22C117.1 19.2 121.833 17.5 124.5 17C128.667 16.1667 138.5 15.3 144.5 18.5C148 20.3667 139.2 21.8 132 21C122 19 115.9 14.2 67.5 15C19.1 15.8 3 2.83333 1 1Z" />\
    <path stroke-width="1" class="hover_path_2" stroke="#26619C" d="M296.006 1C293.506 2.83333 276.706 6.4 229.506 6C170.506 5.5 138.506 8 139.006 19C139.406 27.8 159.839 28.6667 170.006 28C176.673 27 188.006 23.4 180.006 17C172.006 10.6 158.006 13 152.006 15C149.506 15.6667 144.606 17.5 145.006 19.5C145.406 21.5 153.839 23.3333 158.006 24C163.506 24.5 175.106 24.8 177.506 22C179.906 19.2 175.173 17.5 172.506 17C168.339 16.1667 158.506 15.3 152.506 18.5C149.006 20.3667 157.806 21.8 165.006 21C175.006 19 181.106 14.2 229.506 15C277.906 15.8 294.006 2.83333 296.006 1Z" />\
  ';
  
  const hover_path_1 = hover_image.querySelector('.hover_path_1');
  const hover_path_2 = hover_image.querySelector('.hover_path_2');

  const path_length_1 = hover_path_1.getTotalLength();
  const path_length_2 = hover_path_2.getTotalLength();

  //set up initial styles to hide the image
  hover_path_1.setAttribute('stroke-dasharray', path_length_1);
  hover_path_1.setAttribute('stroke-dashoffset', path_length_1);
  hover_path_2.setAttribute('stroke-dasharray', path_length_2);
  hover_path_2.setAttribute('stroke-dashoffset', path_length_2);

  return hover_image;
}

function addHoverImages(button_containers) {
  button_containers.forEach((button_container) => {
    var created_hover_image = createHoverImage();
    button_container.appendChild(created_hover_image);
    button_container.addEventListener('mouseenter', function(event) {
      event.stopPropagation();
      created_hover_image.classList.remove('inactive');
      animateImage(created_hover_image);
    });
    button_container.addEventListener('mouseleave', function(event) {
      event.stopPropagation();
      created_hover_image.classList.add('inactive');
    });
  });
}

function animateImage(hover_image) {
  const hover_path_1 = hover_image.querySelector('.hover_path_1');
  const hover_path_2 = hover_image.querySelector('.hover_path_2');

  const path_length_1 = hover_path_1.getTotalLength();
  const path_length_2 = hover_path_2.getTotalLength();

  hover_path_1.animate([
    { strokeDashoffset: path_length_1 },
    { strokeDashoffset: 0 }
  ],
  {
    duration: 777,
    easing: 'ease-in-out',
    fill: 'forwards'
  });

  hover_path_2.animate([
    { strokeDashoffset: path_length_2 },
    { strokeDashoffset: 0 }
  ],
  {
    duration: 777,
    easing: 'ease-in-out',
    fill: 'forwards'
  });  
}

function initializeHoverImages() {
  const main_nav_items = document.querySelectorAll('.nav-primary .menu-item');
  const cta_buttons = document.querySelectorAll('.sunergos-cta');

  addHoverImages(main_nav_items);
  addHoverImages(cta_buttons);
}

export { initializeHoverImages }