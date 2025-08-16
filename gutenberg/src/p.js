import { registerBlockType } from '@wordpress/blocks';
import { RichText } from '@wordpress/editor';
import { createBlock } from '@wordpress/blocks';
import { InspectorControls } from '@wordpress/block-editor'; //最新
import { CheckboxControl, TextControl, PanelBody } from '@wordpress/components';
import { getClassNameFromProperty } from './tools.js';

registerBlockType( 'kikoiro1/p', {
    title: '本文段落',
    icon: 'editor-paragraph',
    category: 'kikoiro1',
    attributes: {
        content: {
            selector: 'p',
            type: 'string',
            source: 'html',
            default: ''
        },
        id: {
            type: 'string', 
            default: '',
        },
        useAsAnchor: {
            type: 'boolean', 
            default: false,
        }
    },
    transforms: {
        from: [
            {
                type: 'block',
                blocks: [ 'core/paragraph' ],
                transform: ( { content } ) => {
                    return createBlock( 'kikoiro1/p', {
                        content,
                    } );
                },
            },
        ],
        to: [
            {
                type: 'block',
                blocks: [ 'core/paragraph' ],
                transform: ({ content }) => createBlock('core/paragraph', { content }),
            }
        ],
    },
    edit(props) {
        let content = props.attributes.content;
        let onChangeContent = function( content ) {
            props.setAttributes( { content: content } );
        }
        return ([
            <InspectorControls>
                <PanelBody title='設定'>
                    <TextControl
                        label="ID"
                        value={ props.attributes.id }
                        onChange={ ( nextValue ) => {
                            props.setAttributes( {
                                id: nextValue,
                            } );
                        } }
                    />
                    <CheckboxControl
                        label="アンカーとして使用"
                        checked={ props.attributes.useAsAnchor || false }
                        onChange={ ( nextValue ) => {
                            props.setAttributes( {
                                useAsAnchor: nextValue,
                            } );
                        } }
                    />
                </PanelBody>
            </InspectorControls>,
            <RichText 
                tagName="p" 
                id={`${props.attributes.id}`}
                className={ `${(props.attributes.useAsAnchor === true) ? 'anchorLink' : ''} ${getClassNameFromProperty(props.attributes, 'className')}`}
                value={ content } 
                onChange={ onChangeContent } />
        ]);
    },
    save(props) {
        return (
            <RichText.Content
                tagName="p" 
                id={`${props.attributes.id}`}
                className={ `${(props.attributes.useAsAnchor === true) ? 'anchorLink' : ''} ${getClassNameFromProperty(props.attributes, 'className')}`}
                value={ props.attributes.content } />
        );
    },
});
