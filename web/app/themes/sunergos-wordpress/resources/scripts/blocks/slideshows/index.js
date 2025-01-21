import { registerBlockType } from '@wordpress/blocks';
import { SelectControl } from '@wordpress/components';
import { Fragment } from '@wordpress/element';

registerBlockType('sage/slideshows', {
    apiVersion: 3,
    title: 'Slideshow',
    description: 'Displays your chosen slideshow. Slides are managed by their respective menus located in the main menu',
    attributes: {
      slideshow_type: {
        type: 'string',
        default: 'sd_slideshow',
      },
    },
    icon: 'slides',
    category: 'widgets',
    edit: ({ attributes, setAttributes }) => {
        const { slideshow_type } = attributes;

        const slideshowOptions = [
          { label: 'Software Development Services', value: 'sd_slideshow' },
          { label: 'Multimedia Design Services', value: 'md_slideshow' },
          { label: 'Digital Marketing Services', value: 'dm_slideshow' },
        ]
        return (
          <Fragment>
            <SelectControl
                label="Select Slideshow"
                value={slideshow_type}
                options={slideshowOptions}
                onChange={(newSlideshowOptions) => setAttributes({ slideshow_type : newSlideshowOptions })}
            />
        </Fragment>
        );
    },
    save: ({ attributes }) => {
      return null
    },
});