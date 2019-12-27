import { registerBlockType } from '@wordpress/blocks';
import { RichText } from '@wordpress/editor';
import { getClassNameFromProperty } from './tools.js';

registerBlockType( 'kikoiro1/faq-item', {
    title: 'FAQアイテム',
    icon: 'editor-help',
    category: 'kikoiro1',
    attributes: {
        titleContent: {
            selector: 'span',
            type: 'string',
            source: 'html',
            default: ''
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
                placeholder="質問タイトル"
                onChange={ onChangeTitleContent } />
            </h2>
            <RichText
                tagName="p"
                value={ content }
                placeholder="回答内容"
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
