<?php

if ( ! function_exists( 'ishyoboy_get_color_data' ) ) {
	function ishyoboy_get_color_data( $id = null ){

		if ( null == $id ){
			$id = get_the_ID();
		}

		$bg_class = '';

		// Grid Item Color
		$bg_color = IshYoMetaBox::get('color', true, $id );
		if ( ! empty( $bg_color ) ){

			/*
			if ( is_page() ){
				$bg_color = 'color3';
			}
			else{
				$bg_color = 'color5';
			}
			/**/

			$bg_class = ' ish-' . $bg_color;

		}

		$text_class = '';

		// Grid Item Text Color
		$text_color = IshYoMetaBox::get('text_color', true, $id );
		if ( ! empty( $text_color ) ){

			/*
			if ( is_page() ){
				$text_color = 'color1';
			}
			else{
				$text_color = 'color3';
			}
			/**/

			$text_class = ' ish-text-' . $text_color;
		}

		$data = Array(
			'bg_color' => $bg_color,
			'text_color' => $text_color,
			'bg_class' => $bg_class,
			'text_class' => $text_class,
			'classes' => $bg_class . $text_class,
		);

		return apply_filters( 'ishyoboy_get_color_data', $data, $id );

	}
}

if ( ! function_exists( 'ish_get_the_ID' ) ) {
	function ish_get_the_ID(){

		if ( is_home() ){
			$pst = get_post( get_option( 'page_for_posts' ) );
			if ( 'page' != get_option('show_on_front') ){
				$pst = null;
			}
			return (!empty($pst)) ? ( $pst->ID ) : null;
		}

		$pst = get_post();
		return (!empty($pst)) ? ( $pst->ID ) : null;

	}
}

if ( ! function_exists( 'ishyoboy_get_post_format_quote' ) ) {
	function ishyoboy_get_post_format_quote(){

		if (function_exists('get_post_format_meta')){

			/**
			 *   Adding support fo WP >= 3.6.0
			 */
			$meta =  get_post_format_meta( get_the_ID() );
			return $meta['quote'];
		} else{

			/**
			 *   WP <= 3.5.9
			 */
			return IshYoMetaBox::get('post_quote');
		}

	}
}

if ( ! function_exists( 'ishyoboy_get_post_format_quote_source' ) ) {
	function ishyoboy_get_post_format_quote_source(){

		if (function_exists('get_post_format_meta')){

			/**
			 *   Adding support fo WP >= 3.6.0
			 */
			$meta =  get_post_format_meta( get_the_ID() );
			return $meta['quote_source'];
		} else{

			/**
			 *   WP <= 3.5.9
			 */
			return IshYoMetaBox::get('post_quote_source');
		}

	}
}

if ( ! function_exists( 'ishyoboy_get_post_format_url' ) ) {
	function ishyoboy_get_post_format_url() {


		if (function_exists('get_the_post_format_url')){

			/**
			 *   Adding support fo WP >= 3.6.0
			 */
			$url =  get_the_post_format_url();
			return ($url) ? $url : apply_filters( 'the_permalink', get_permalink() );
		} else{

			/**
			 *   WP <= 3.5.9
			 */
			switch (get_post_format()){
				case 'quote' :
					$url = IshYoMetaBox::get('post_quote_url');
					break;
				default :
					$url = IshYoMetaBox::get('post_url');
					break;
			}
			return ($url) ? $url : apply_filters( 'the_permalink', get_permalink() );
		}
	}
}

if ( ! function_exists( 'ishyoboy_get_post_format_url_text' ) ) {
	function ishyoboy_get_post_format_url_text() {
		$url = IshYoMetaBox::get('post_url_text');
		return ( $url ) ? $url : '';
	}
}

if ( ! function_exists( 'ishyoboy_the_post_video' ) ) {
	function ishyoboy_the_post_video( $id , $permalink_on_images = true ) {
		global $content_width;

		wp_enqueue_script( 'wp-mediaelement' );
		wp_enqueue_style( 'wp-mediaelement' );

		if (function_exists('get_the_post_format_media')){

			/**
			 *   Adding support fo WP >= 3.6.0
			 */
			$video =  get_the_post_format_media('video');
			if ( '' != $video ) {
				echo '<div class="ish-blog-video-content">', $video, '</div>';
			}

		} else{

			/**
			 *   WP <= 3.5.9
			 */
			if ( ( 'true' == IshYoMetaBox::get('post_embedded_video', true, $id) ) ){

				$video = IshYoMetaBox::get('post_video', true, $id);

				if ( '' != $video ) {?>
					<div class="ish-blog-video-content">
						<!-- EMBEDDED VIDEO BEGIN -->
						<?php
						if ( substr($video, 0, 4) == "http" ){
							global $wp_embed;
							echo do_shortcode($wp_embed->run_shortcode('[embed]'. $video . '[/embed]'));
						}else{
							echo str_replace( '&', '&amp;', $video );
						}

						?>
						<!-- EMBEDDED VIDEO END -->
					</div>
				<?php } else {

					if ( has_post_thumbnail() ){
						$return = '';
						$return .= '<div class="ish-main-post-image">';

						if ( $permalink_on_images ){
							$return .= '<a href="' . get_permalink() . '">';
						}
						else{
							$img_details = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full' );
							$return .= '<a href="' . esc_attr( $img_details[0] ) . '" target="_blank">';
						}

						$return .= get_the_post_thumbnail($id, 'theme-large');
						$return .= '</a>';
						$return .= '</div>';

						echo $return;
					}
				}
			} else {

				$mp4 = IshYoMetaBox::get('post_video_mp4', true, $id);
				$mebm = IshYoMetaBox::get('post_video_webm', true, $id);

				if ( '' != $mp4 || '' != $mebm ) { ?>
					<div class="ish-blog-video-content">
						<!-- HTML5 VIDEO BEGIN -->
						<div class="wp-video">
							<video class="wp-video-shortcode ish-video" controls="controls" preload="metadata" style="width: 100%; height: 100%;" width="<?php echo $content_width; ?>" <?php if ('' != IshYoMetaBox::get('post_video_poster', true, $id)) echo 'poster="' . IshYoMetaBox::get('post_video_poster', true, $id) . '"'; ?>>
								<?php if ( '' != $mp4 ) echo '<source src="' . $mp4 . '" type="video/mp4"/>'; ?>
								<?php if ( '' != $mebm ) echo '<source src="' . $mebm . '" type="video/webm"/>'; ?>
								<?php if ( '' != $mp4 ) { echo '<a href="' . $mp4 . '">' . $mp4 . '</a>'; } else { echo '<a href="' . $mebm . '">' . $mebm . '</a>'; } ?>
							</video>
						</div>
						<!-- HTML5 VIDEO END -->
					</div> <?php
				} else {

					if ( has_post_thumbnail() ){
						$return = '';
						$return .= '<div class="ish-main-post-image">';

						if ( $permalink_on_images ){
							$return .= '<a href="' . get_permalink() . '">';
						}
						else{
							$img_details = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full' );
							$return .= '<a href="' . esc_attr( $img_details[0] ) . '" target="_blank">';
						}

						$return .= get_the_post_thumbnail($id, 'theme-large');
						$return .= '</a>';
						$return .= '</div>';

						echo $return;
					}

				}
			}
		}
	}
}

if ( ! function_exists( 'ishyoboy_the_post_audio' ) ) {
	function ishyoboy_the_post_audio( $id , $permalink_on_images = true ){
		if ( '' != IshYoMetaBox::get('post_audio', true, $id) ) {?>

			<?php
			wp_enqueue_script( 'wp-mediaelement' );
			wp_enqueue_style( 'wp-mediaelement' );
			?>

			<div class="ish-blog-audio-content">
				<?php /*
				<div class="ish-blog-audio-image ish-main-post-image">
					<?php if ( !is_single() ) { ?>
						<a href="<?php the_permalink(); ?>">
							<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {  ?>
								<?php  echo get_the_post_thumbnail($id, 'theme-large'); ?>
							<?php } ?>
						</a>
					<?php } else { ?>
						<?php
						$img_details = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full' );
						?>
						<a href="<?php echo esc_attr($img_details[0]); ?>"  target="_blank">
							<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {  ?>
								<?php  echo get_the_post_thumbnail($id, 'theme-large'); ?>
							<?php } ?>
						</a>
					<?php } ?>
				</div>

                */ ?>
				<div class="ish-blog-audio-player">
					<!-- AUDIO BEGIN -->
					<?php $audio = IshYoMetaBox::get('post_audio', true, $id); ?>
					<!--[if lt IE 9]><script>document.createElement('audio');</script><![endif]-->
					<?php echo '<audio class="wp-audio-shortcode ish-audio" preload="none" style="width: 100%" controls="controls">
						<source type="audio/mpeg" src="' . $audio . '" />
						<a href="' . $audio . '">' . $audio . '</a>
					</audio>'; ?>
					<!-- AUDIO END -->
				</div>
			</div>
		<?php } else {

			if ( has_post_thumbnail() ){
				$return = '';
				$return .= '<div class="ish-main-post-image">';

				if ( $permalink_on_images ){
					$return .= '<a href="' . get_permalink() . '">';
				}
				else{
					$img_details = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full' );
					$return .= '<a href="' . esc_attr( $img_details[0] ) . '" target="_blank">';
				}

				$return .= get_the_post_thumbnail($id, 'theme-large');
				$return .= '</a>';
				$return .= '</div>';

				echo $return;
			}
		}
	}
}

if ( ! function_exists( 'ishyoboy_get_item_bg_style' ) ) {
	function ishyoboy_get_item_bg_style( $id = null ){

		if ( null == $id ){
			$id = ish_get_the_ID();
		}

		if ( has_post_thumbnail() ) {
			$img_id = get_post_thumbnail_id( get_the_ID() );
			$img_details = wp_get_attachment_image_src( $img_id, 'theme-large' );
			$bg_style = 'style="background-image: url(\'' . $img_details[0] . '\'); background-size: cover; background-position-y: 50%; background-attachment: fixed;"';
			return $bg_style;
		}

		return '';
	}
}

if ( ! function_exists( 'ishyoboy_get_blog_excerpt' ) ) {
	function ishyoboy_get_blog_excerpt( $length = null ){

		/*if ( ! empty( $length ) ) {

			$func = function( $arg ) use ( $length ) {
				return $length;
			}

			add_filter( 'excerpt_length', $func, 999 );
		}*/

		if ( ! empty( $length ) ) {
			return wpautop( wp_trim_words( apply_filters( 'the_excerpt', get_the_excerpt() ) , $length ) );
		}


		return wpautop( apply_filters( 'the_excerpt', get_the_excerpt() ) );
	}
}

if ( ! function_exists( 'ishyoboy_get_post_details' ) ) {
	function ishyoboy_get_post_details(){
		$return = '';

		global $post, $authordata;
		if ( !is_object( $authordata ) ){
			if ( isset( $post->post_author ) ){
				$authordata = get_userdata( $post->post_author );
			}
		}

		ob_start(); ?>
		<span class="ish-blog-post-details">
					<a href="<?php echo get_day_link( get_post_time('Y'), get_post_time('m'), get_post_time('j') ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
			<?php if ( is_object( $authordata ) ) : ?>
				<span><?php _e( 'by', 'ishyoboy_assets'); ?></span> <?php echo the_author_posts_link(); ?>
			<?php endif; ?>
			<?php if ( has_category() ) : ?>
				<span><?php _e( 'in category', 'ishyoboy_assets'); ?></span> <?php the_category(', '); ?>
			<?php endif; ?>
			<?php if ( has_tag() ) : ?>
				<span><?php _e( 'tagged as', 'ishyoboy_assets'); ?></span> <?php the_tags('', ', '); ?>
			<?php endif; ?>
			<?php if ( is_single() ) : ?>
				<?php _e( 'with', 'ishyoboy_assets'); ?> <a href="<?php comments_link(); ?>"><i class="ish-icon-chat"></i><?php comments_number('0', '1', '%'); ?></a>
				<?php _e( 'and', 'ishyoboy_assets'); ?> <?php ishyoboy_the_likes( false ); ?>
			<?php endif; ?>

		</span>
		<?php
		$return .= ob_get_contents();
		ob_end_clean();

		return $return;
	}
}

if ( ! function_exists( 'ishyoboy_get_masonry_post_details' ) ) {
	function ishyoboy_get_masonry_post_details(){
		$return = '';

		ob_start(); ?>
		<span class="ish-blog-post-details">
			<a href="<?php echo get_day_link( get_post_time('Y'), get_post_time('m'), get_post_time('j') ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
			<a href="<?php comments_link(); ?>"><i class="ish-icon-chat"></i><?php comments_number('0', '1', '%'); ?></a>
			<?php ishyoboy_the_likes( false ); ?>
		</span>
		<?php
		$return .= ob_get_contents();
		ob_end_clean();

		return $return;
	}
}

if ( ! function_exists( 'ishyoboy_get_theme_colors_array' ) ) {
	function ishyoboy_get_theme_colors_array() {

		global $ish_options;

		$ish_theme_colors = Array();

		if ( ! empty( $ish_options ) ){

			for ($i = 1; $i <= IYB_COLORS_COUNT; $i++ ){

				if ( isset( $ish_options['color' . $i ] ) ){
					//$ish_theme_colors[ sprintf( __( 'Color %d', 'ishyoboy_assets' ), $i )  ] = 'color' . $i  ;
					$ish_theme_colors[ 'Color' . $i ] = 'color' . $i  ;
				}

			}

		}
		// $ish_theme_colors[ __( 'Advanced', 'ishyoboy_assets' ) ] = 'advanced';

		return $ish_theme_colors;

	}
}

if ( ! function_exists( 'ishyoboy_output_theme_colors_css' ) ) {
	function ishyoboy_output_theme_colors_css() {

		global $ish_options;

		echo '<style type="text/css">';

		for ($i = 1; $i <= IYB_COLORS_COUNT; $i++ ){

			if ( ! isset( $ish_options['color' . $i] ) ) {
				$ish_options['color' . $i] = constant( 'ISH_COLOR_' . $i );
			}

			if ( $i > IYB_BASE_COLORS_COUNT && '#ffffff' != strtolower($ish_options['color' . $i]) ){
				echo '.ish_meta_param.ish_color_selector_item color' . $i . ', .ish_meta_param.ish_color_selector_container [data-ish-value="color' . $i . '"] { background-color: ' . $ish_options['color' . $i] . "; color: #ffffff; }\n";
			}
			else {
				echo '.ish_meta_param.ish_color_selector_item color' . $i . ', .ish_meta_param.ish_color_selector_container [data-ish-value="color' . $i . '"] { background-color: ' . $ish_options['color' . $i] . "; color: " . ishyoboy_get_color_contrast( $ish_options['color' . $i] ) . "; }\n";
			}

		}

		echo '</style>' . "\n";
	}
}