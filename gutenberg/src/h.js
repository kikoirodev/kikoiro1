import { createBlock } from '@wordpress/blocks';
import { registerBlockType } from '@wordpress/blocks';
import { RichText } from '@wordpress/editor';

/*
 transformsのfromは変換を受け付けるホワイトリストだが、h2-h4に自分以外のホワイトリストを設定するだけではなぜかダメのようだ
 （h3, h4 -> h2の変換しかできない）
 よくわからないがh2-h4でなんとなく重複を避けるように記述したところうまく動作している
 */
registerBlockType( 'kikoiro1/h2', {
    title: '大見出し',
    icon: 'editor-textcolor',
    category: 'kikoiro1',
    attributes: {
        content: {
            selector: 'h2',
            type: 'string',
            source: 'html',
            default: ''
        },
    },
    transforms: {
        from: [
            {
                type: 'block',
                blocks: [ 'core/heading', 'kikoiro1/h3', 'kikoiro1/h4' ],
                transform: ( { content } ) => {
                    return createBlock( 'kikoiro1/h2', {
                        content,
                    } );
                },
            },
        ],
        to: [
            {
                type: 'block',
                blocks: ['kikoiro1/h3'],
                transform: ({content}) => createBlock('kikoiro1/h3', {content}),
            },
            {
                type: 'block',
                blocks: ['kikoiro1/h4'],
                transform: ({content}) => createBlock('kikoiro1/h4', {content}),
            },
        ],
    },
    edit(props) {
        let content = props.attributes.content;
        let onChangeContent = function( content ) {
            props.setAttributes( { content: content } );
        }
        return (
            <RichText 
                tagName="h2" 
                multiline="false"
                value={ content } 
                onChange={ onChangeContent } />
        );
    },
    save(props) {
        return (
            <RichText.Content
                tagName="h2" 
                multiline="false"
                value={ props.attributes.content } />
        );
    },
});

/*
    transforms
    h2のfromにもう入っているのでh2へのtoを指定する必要はないっぽい？
    h2のtoにもう入っているのでh2からのfromを指定する必要はないっぽい？
 */
registerBlockType( 'kikoiro1/h3', {
    title: '中見出し',
    icon: 'editor-textcolor',
    category: 'kikoiro1',
    attributes: {
        content: {
            selector: 'h3',
            type: 'string',
            source: 'html',
            default: ''
        },
    },
    transforms: {
        from: [
            {
                type: 'block',
                blocks: [ 'core/heading', 'kikoiro1/h4' ],
                transform: ( { content } ) => {
                    return createBlock( 'kikoiro1/h3', {
                        content,
                    } );
                },
            },
        ],
        to: [
            {
                type: 'block',
                blocks: ['kikoiro1/h4'],
                transform: ({content}) => createBlock('kikoiro1/h3', {content}),
            }
        ],
    },
    edit(props) {
        let content = props.attributes.content;
        let onChangeContent = function( content ) {
            props.setAttributes( { content: content } );
        }
        return (
            <RichText 
                tagName="h3" 
                multiline="false"
                value={ content } 
                onChange={ onChangeContent } />
        );
    },
    save(props) {
        return (
            <RichText.Content
                tagName="h3" 
                multiline="false"
                value={ props.attributes.content } />
        );
    },
});

/*
    transforms
    h2, h3のfromにもう入っているのでtoを指定する必要はないっぽい？
    h2, h3のtoにもう入っているのでh2, h3からのfromを指定する必要はないっぽい？
 */
registerBlockType( 'kikoiro1/h4', {
    title: '小見出し',
    icon: 'editor-textcolor',
    category: 'kikoiro1',
    attributes: {
        content: {
            selector: 'h4',
            type: 'string',
            source: 'html',
            default: ''
        },
    },
    transforms: {
        from: [
            {
                type: 'block',
                blocks: [ 'core/heading' ],
                transform: ( { content } ) => {
                    return createBlock( 'kikoiro1/h4', {
                        content,
                    } );
                },
            },
        ]
    },
    edit(props) {
        let content = props.attributes.content;
        let onChangeContent = function( content ) {
            props.setAttributes( { content: content } );
        }
        return (
            <RichText 
                tagName="h4" 
                multiline="false"
                value={ content } 
                onChange={ onChangeContent } />
        );
    },
    save(props) {
        return (
            <RichText.Content
                tagName="h4" 
                multiline="false"
                value={ props.attributes.content } />
        );
    },
});
