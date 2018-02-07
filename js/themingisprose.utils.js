/**
 * Theming is Prose
 *
 * @package			WordPress
 * @subpackage		Theming is Prose: Javascript
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com
 * @since 			Theming is Prose 1.0
 */
jQuery(document).ready(function($){
	// Make slider items the same high
	function themingisprose_item_hight( parent, item, highest ){
		var values	= []
			item 	= $(parent +' '+ item);
		item.each(function(index){
			var item_hight = $(this).height();
			values.push(item_hight);
		});
		values.sort();
		var value = ( highest ) ? values.pop() + 10 : values.shift();
		item.css( 'min-height', value );
		console.log( values );
	}
	themingisprose_item_hight( '#work-flow-carousel', '.carousel-item', true );
});
