import { registerBlockType } from '@wordpress/blocks';
import { RichText } from '@wordpress/editor';
import { getClassNameFromProperty } from './tools.js';

registerBlockType( 'kikoiro1/sources', {
    title: '出典',
    icon: 'editor-ul',
    category: 'kikoiro1',
    attributes: {
        titleContent: {
            selector: 'h2',
            type: 'string',
            source: 'html',
            default: "出典"
        },
        content: {
            selector: 'ul',
            type: 'array',
            source: 'children'
        },
    },
    edit(props) {
        let content = props.attributes.content;
        let titleContent = props.attributes.titleContent;
        let onChangeTitleContent = function( content ) {
            props.setAttributes( { titleContent: content } );
        }
        let onChangeContent = function( content ) {
            props.setAttributes( { content: content } );
        }
        return (
            <div class={"references" + getClassNameFromProperty(props.attributes, "className") }>
            <RichText 
                tagName="h2"
                value={ titleContent } 
                onChange={ onChangeTitleContent } />
            <RichText
                tagName="ul"
                value={ content }
                multiline="li"
                onChange={ onChangeContent } />
            </div>
        );
    },
    save(props) {
        return (
            <div class={ "references" + getClassNameFromProperty(props.attributes, "className") }>
            <RichText.Content
                tagName="h2"
                value={ props.attributes.titleContent } />
            <RichText.Content
                tagName="ul"
                value={ props.attributes.content } />
            </div>
        );
    },
});
