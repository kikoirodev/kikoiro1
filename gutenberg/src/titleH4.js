import { createBlock } from '@wordpress/blocks';
import { registerBlockType } from '@wordpress/blocks';
import { RichText } from '@wordpress/editor';
import { InspectorControls } from '@wordpress/editor';
import { RadioControl, PanelBody } from '@wordpress/components';
import { getClassNameFromProperty } from './tools.js';

registerBlockType( 'kikoiro1/h4', {
    title: '見出し（H4）',
    icon: 'editor-textcolor',
    category: 'kikoiro1',
    attributes: {
        content: {
            selector: 'h4',
            type: 'string',
            source: 'html',
            default: ''
        },
        headingStyle: {
            type: 'string', 
            default: 'normal',
        }
    },
    transforms: {
        from: [
            {
                type: 'block',
                blocks: [ 'core/heading', 'kikoiro1/h3' ],
                transform: ( { content } ) => {
                    return createBlock( 'kikoiro1/h4', {
                        content,
                    } );
                },
            },
        ],
        to: [
            {
                type: 'block',
                blocks: [ 'core/heading' ],
                transform: ({ content }) => createBlock('core/heading', { content: content, level: 4 }),
            }, 
            {
                type: 'block',
                blocks: [ 'kikoiro1/h3' ],
                transform: ({ content }) => createBlock('kikoiro1/h3', { content: content }),
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
                    <RadioControl
                        label="スタイル"
                        help=""
                        selected={ props.attributes.headingStyle || 'normal' }
                        options={ [
                            { label: 'ノーマル', value: 'normal' },
                            { label: '下線付き', value: 'underline' },
                            { label: '●付き', value: 'dot' },
                        ] }
                        onChange={ ( nextValue ) => {
                            props.setAttributes( {
                                headingStyle: nextValue,
                            } );
                        } }
                    />
                </PanelBody>
            </InspectorControls>,
            <RichText 
                tagName="h4" 
                multiline="false"
                className={ `${props.attributes.headingStyle} ${getClassNameFromProperty(props.attributes, 'className')}`}
                value={ content } 
                onChange={ onChangeContent } />
        ]);
    },
    save(props) {
        return (
            <RichText.Content
                tagName="h4" 
                multiline="false"
                className={ `${props.attributes.headingStyle} ${getClassNameFromProperty(props.attributes, 'className')}`}
                value={ props.attributes.content } />
        );
    },
});
