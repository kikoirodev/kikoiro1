import { registerBlockType } from '@wordpress/blocks';
 
const blockStyle = {
    backgroundColor: '#900',
    color: '#fff',
    padding: '20px',
};
 
registerBlockType( 'kikoiro1/test', {
    title: 'Example',
    icon: 'universal-access-alt',
    category: 'kikoiro1',
    example: {},
    edit() {
        return <div class="test">AAA!</div>;
    },
    save() {
        return <div style={ blockStyle }>BBB!</div>;
    },
} );
