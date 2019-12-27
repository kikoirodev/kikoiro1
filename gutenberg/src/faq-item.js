import { registerBlockType } from '@wordpress/blocks';
import { RichText } from '@wordpress/editor';
import { getClassNameFromProperty } from './tools.js';

registerBlockType( 'kikoiro1/faq-item', {
    title: 'FAQアイテム',
    icon: 'editor-ul',
    category: 'kikoiro1',
    attributes: {
        titleContent: {
            selector: 'span',
            type: 'string',
            source: 'html',
            default: "タイトル"
        },
        content: {
            type: 'string',
            source: 'html',
            default: ''
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
            <div class={ "faqItem" + getClassNameFromProperty(props.attributes, "className") }>
            <h2>
            <RichText 
                tagName="span"
                value={ titleContent } 
                onChange={ onChangeTitleContent } />
            </h2>
            <RichText
                tagName="p"
                value={ content }
                onChange={ onChangeContent } />
            </div>
        );
    },
    save(props) {
        return (
            <div class={ "faqItem" + getClassNameFromProperty(props.attributes, "className") }>
            <h2>
            <RichText.Content
                tagName="span"
                value={ props.attributes.titleContent } />
            </h2>
            <RichText.Content
                tagName="p"
                value={ props.attributes.content } />
            </div>
        );
    },
});
