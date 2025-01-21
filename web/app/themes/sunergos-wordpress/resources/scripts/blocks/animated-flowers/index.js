import { registerBlockType } from '@wordpress/blocks';
import { SelectControl } from '@wordpress/components';
import { Fragment } from '@wordpress/element';

registerBlockType('sage/animated-flowers', {
    apiVersion: 3,
    title: 'Animated Flower',
    description: 'Displays an animated svg flower',
    attributes: {
      flower_type: {
        type: 'string',
        default: 'echinacea',
      },
    },
    icon: 'buddicons-replies',
    category: 'widgets',
    edit: ({ attributes, setAttributes }) => {
        const { flower_type } = attributes;

        const flowerOptions = [
          { label: 'Echinacea', value: 'echinacea' },
          { label: 'Lavender', value: 'lavender' },
        ]
        return (
          <Fragment>
            <SelectControl
                label="Select Flower Type"
                value={flower_type}
                options={flowerOptions}
                onChange={(newFlowerType) => setAttributes({ flower_type : newFlowerType })}
            />
        </Fragment>
        );
    },
    save: ({ attributes }) => {
      return null
    },
});