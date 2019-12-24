import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks } from '@wordpress/editor';
import { getClassNameFromProperty } from './tools.js';

registerBlockType( 'kikoiro1/interviewee-profile', {
    title: 'インタビュイープロフィール（当事者本人）',
    icon: 'admin-users',
    category: 'kikoiro1',
    edit(props) {
        return (
            <div class={"interviewee_profile" + getClassNameFromProperty(props.attributes, "className") }>
                <h4>お話を伺った方のプロフィール</h4>
                <InnerBlocks allowedBlocks={ [ 'core/list' ] }
                            templateLock='all' 
                            template={[
                                [ 'core/list', {} ] 
                            ]}
                />
            </div>
        );
    },
    save(props) {
        return (
            <div class={"interviewee_profile" + getClassNameFromProperty(props.attributes, "className") }>
                <h4>お話を伺った方のプロフィール</h4>
                <InnerBlocks.Content />
            </div>
        );
    },
} );
