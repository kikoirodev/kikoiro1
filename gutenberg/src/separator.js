import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls } from '@wordpress/editor';
import { CheckboxControl, PanelBody } from '@wordpress/components';
import { getClassNameFromProperty } from './tools.js';

registerBlockType( 'kikoiro1/separator', {
    title: '仕切り線',
    icon: 'minus',
    category: 'kikoiro1',
    attributes: {
        isFullWidth: { 
            type: 'boolean', 
            default: false,
        },
    },
    edit(props) {
        return ([
            <InspectorControls>
                <PanelBody title='設定'>
                    <CheckboxControl
                        label="コンテンツ幅に合わせる"
                        checked={ props.attributes.isFullWidth || false }
                        onChange={ ( nextValue ) => {
                            props.setAttributes( {
                                isFullWidth: nextValue,
                            } );
                        } }
                    />
                </PanelBody>
            </InspectorControls>,
            <hr className={ `contentSeparator ${getClassNameFromProperty(props.attributes, 'className')} ${(props.attributes.isFullWidth === true) ? 'fullWidth' : ''}` }
            />
        ]);
    },
    save(props) {
        return (
            <hr className={ `contentSeparator ${getClassNameFromProperty(props.attributes, 'className')} ${(props.attributes.isFullWidth === true) ? 'fullWidth' : ''}` }
            />
        );
    },
});
