import { registerBlockType } from '@wordpress/blocks';
import { SelectControl, TextControl, ToggleControl, PanelBody } from '@wordpress/components';
import { InspectorControls, URLInputButton } from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
// import hover_image_src from '../../../images/cta_arrow.svg';


registerBlockType('sage/sunergos-footer-cta', {
    apiVersion: 3,
    title: 'Sunergos Footer CTA',
    description: 'A Call to Action with Customized Options',
    icon: 'phone',
    category: 'widgets',
    attributes: {
      link_url: {
        type: 'string',
        default: '',
      },
      link_text: {
        type: 'string',
        default: 'Contact Us'
      },
      gradient_text: {
        type: 'string',
        default: 'Ready to work together?'
      },
      open_in_new_tab: {
        type: 'boolean',
        default: false,
      },
    },
    edit: ({ attributes, setAttributes }) => {
        const { link_url, link_text, gradient_text, open_in_new_tab } = attributes;

        return (
          <Fragment>
            <InspectorControls>
              <PanelBody title="Settings" initialOpen={true}>
                <TextControl
                  label="Gradient Text"
                  value={gradient_text}
                  onChange={(newText) =>
                    setAttributes({gradient_text : newText})
                  }
                />                
                <TextControl
                  label="Link Text"
                  value={link_text}
                  onChange={(newText) =>
                    setAttributes({link_text : newText})
                  }
                />
                <URLInputButton
                  label="Button Link URL"
                  url={link_url}
                  onChange={(newUrl) =>
                    setAttributes({ link_url : newUrl })
                  }
                />
                <ToggleControl
                  label="Open in new tab?"
                  checked={open_in_new_tab}
                  onChange={(newTabSetting) =>
                    setAttributes({ open_in_new_tab: newTabSetting })
                  }
                />
              </PanelBody>
            </InspectorControls>
          {/* Block Preview */}
          <div className="sunergos-footer-cta">
            <span>{gradient_text}</span>
            <a
              href={link_url}
              target={open_in_new_tab ? '_blank' : '_self'}
              rel={open_in_new_tab ? 'noopener' : ''}
              className="sunergos-footer-cta"
            >
              {link_text}
              <svg className="cta-arrow" width="33" height="24" viewBox="0 0 33 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.64282 11.838H31.3571M31.3571 11.838L21.3571 1.83801M31.3571 11.838L21.3571 21.838" stroke="#89619E" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </a>
          </div>
        </Fragment>
        );
    },
    save: ({ attributes }) => {
      const { link_url, link_text, gradient_text, open_in_new_tab } = attributes;

      return (
        <div className="sunergos-footer-cta">
          <span>{gradient_text}</span>
          <a
            href={link_url}
            target={open_in_new_tab ? '_blank' : '_self'}
            rel={open_in_new_tab ? 'noopener' : ''}
            className="sunergos-footer-cta"
          >
            {link_text}
            <svg className="cta-arrow" width="33" height="24" viewBox="0 0 33 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1.64282 11.838H31.3571M31.3571 11.838L21.3571 1.83801M31.3571 11.838L21.3571 21.838" stroke="#89619E" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </a>
        </div>
      );
    },
});