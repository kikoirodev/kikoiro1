import { registerBlockType } from '@wordpress/blocks';
import { RichText, InspectorControls } from '@wordpress/editor';
import { getClassNameFromProperty } from './tools.js';
import { CheckboxControl, PanelBody } from '@wordpress/components';

registerBlockType( 'kikoiro1/main-ul', {
    title: '本文-リスト',
    icon: 'editor-ul',
    category: 'kikoiro1',
    attributes: {
        content: {
            selector: 'ul',
            type: 'array',
            source: 'children'
        },
        isWhiteBackground: { 
            type: 'boolean', 
            default: false,
        },
    },
    edit(props) {
        let content = props.attributes.content;
        let onChangeContent = function( content ) {
            props.setAttributes( { content: content } );
        }
        return ([
            <InspectorControls>
                <PanelBody title='設定'>
                    <CheckboxControl
                        label="背景色を白にする"
                        checked={ props.attributes.isWhiteBackground || false }
                        onChange={ ( nextValue ) => {
                            props.setAttributes( {
                                isWhiteBackground: nextValue,
                            } );
                        } }
                    />
                </PanelBody>
            </InspectorControls>,
            <RichText
                tagName="ul"
                className={ `withItemBottomMargin withPadding ${getClassNameFromProperty(props.attributes, 'className')} ${(props.attributes.isWhiteBackground === true) ? 'whiteBackground' : ''}` }
                multiline="li"
                value={ content }
                onChange={ onChangeContent } />
        ]);
    },
    save(props) {
        return (
            <RichText.Content
                tagName="ul"
                className={ `withItemBottomMargin withPadding ${getClassNameFromProperty(props.attributes, 'className')} ${(props.attributes.isWhiteBackground === true) ? 'whiteBackground' : ''}` }
                value={ props.attributes.content } />
        );
    },
});
