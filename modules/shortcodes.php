<?php 
add_shortcode( 'puzzle', 'pw_shortcode_handler' );
function pw_shortcode_handler( $atts, $content = null ) {
		$out = '';
		$puzzle_id = $atts['id'];
		
		$free_url = file_get_contents( 'http://www.rebuses.co/free/' );
		$get_max = pw_get_string_between( $free_url , '<a class="more" href="', '"');
		$id_item =  explode('-',$get_max) ;
		$id_item = str_replace( '/', '', $id_item[1] );
		
		if( $puzzle_id  ){
			$rand_id = $puzzle_id;
		}else{
			if( !$id_item ){
				$id_item = 125;
			}
		
			$rand_id = rand(1, $id_item);
			
			if( $rand_id > 125 ){
				if( $rand_id % 2 == 0 ){
					$rand_id = $rand_id - 1;
				}
			}
			
		}
		
		
		$link_url = 'http://www.rebuses.co/rebus-'.$rand_id;
		$page_content = file_get_contents( $link_url );
		
		$res_title = pw_get_string_between($page_content, '<title>', '</title>');
		
		
		$res_tmp = pw_get_string_between($page_content, '<span class="post-thumb">', '</span>');
		$image_source =  pw_get_string_between($res_tmp, 'src="', '"');
		$image_source = str_replace('.png', '-220x220.png', $image_source );
		
		if( $image_source ){
		$out .= '
		<div class="puzzle_container">
			<a target="_blank" href="'.$link_url.'" alt="'.$res_title.'" ><img title="'.$res_title.'" alt="'.$res_title.'" src="'.$image_source.'"></a>
			<div class="how_to_info">
				<a target="_blank" href="http://www.rebuses.co/how-to-solve-a-rebus-puzzle/">Need help on how to solve this rebus?</a>
			</div>
			<div class="clue_answer">
				<a target="_blank" href="'.$link_url.'">Need a <strong>clue</strong> or have the <strong>answer</strong>?</a>
			</div>
		</div>
		';
		}else{
		$out .= '
		<div class="puzzle_container">			
			<div class="clue_answer">
				There is ether a temporary connection issue or the specified puzzle number is not available yet.
			</div>
		</div>
		';
		}
	  
	  return $out; 
}

?>