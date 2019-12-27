import { registerBlockType } from '@wordpress/blocks';
import { RichText } from '@wordpress/editor';
import { InnerBlocks } from '@wordpress/editor';
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
    },
    edit(props) {
        let titleContent = props.attributes.titleContent;
        let onChangeTitleContent = function( content ) {
            props.setAttributes( { titleContent: content } );
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
            <InnerBlocks allowedBlocks={ [ 'core/paragraph' ] }
                                template={[
                                    [ 'core/paragraph', {} ] 
                                ]}
                />
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
            <InnerBlocks.Content />
            </div>
        );
    },
});
