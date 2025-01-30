const category_buttons = document.querySelectorAll('.category-button');
const category_labels = document.querySelectorAll('.post-category-label');
const post_previews = document.querySelectorAll('.post-preview');

function initCategoryButtons() {
  let active_button_ids = ['0'];

  category_buttons.forEach((category_button) => {
    category_button.addEventListener('click', function() {
      //Get the category ID
      let clicked_category_id = category_button.dataset.categoryId;
      //Condition if the button clicked is not All Categories
      if(clicked_category_id != 0) {
        //If the button is already active, deactivate (toggle) it, if not, add it to the array of active categories
        if(active_button_ids.includes(clicked_category_id)) {
          let index_of_id = active_button_ids.indexOf(clicked_category_id);
          active_button_ids.splice(index_of_id, 1);
          //If the active category array is now empty, set All Categories to be active
          if(active_button_ids.length === 0) {
            active_button_ids = ['0'];
          }
        //The active categories id is not already active, so instead of deactivating (toggling) it, add it to array of active categories
        } else {
          //Remove the All Categories Button Id if it exists
          if(active_button_ids.includes('0')) {
            let index_of_all_categories_id = active_button_ids.indexOf('0');
            active_button_ids.splice(index_of_all_categories_id, 1);
          }
          active_button_ids.push(clicked_category_id);
        }
      // The condition here is the All Categories button, so remove all categories and set the active category to All Categories
      } else {
        active_button_ids = ['0'];
      }
      //Uncomment this to debug
      // console.log(active_button_ids);

      updateActiveClasses(active_button_ids);
    });
  })
}

function updateActiveClasses(active_category_array) {
  //Loop through our array of buttons
  category_buttons.forEach((category_button) => {
    //If the active categories array includes the category ID of our button, set the class to active, otherwise, unset it
    if(active_category_array.includes(category_button.dataset.categoryId)) {
      category_button.classList.add('active');
    }
    else {
      category_button.classList.remove('active');
    }
  });

  //Loop through our array of category labels
  category_labels.forEach((category_label) => {
    //If the active categories array includes the category ID of our button, set the class to active, otherwise, unset it
    if(active_category_array.includes(category_label.dataset.categoryId) || active_category_array.includes('0')) {
      category_label.classList.add('active');
    }
    else {
      category_label.classList.remove('active');
    }
  });

  //Loop through our array of post previews
  post_previews.forEach((post_preview) => {
    let remove_post = true;
    //find the labels inside of this post preview
    let labels = post_preview.querySelectorAll('.post-category-label');
    labels.forEach((label) => {
      if(label.classList.contains('active')) {
        remove_post = false;
      }
    });
    //if no active classes were found, remove the post
    if(remove_post) {
      post_preview.classList.remove('active');
    }
    else {
      post_preview.classList.add('active');
    }
  });
}

export { initCategoryButtons }
