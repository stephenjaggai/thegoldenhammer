<?php
/**
 * The default template for displaying content
 *
 * Used for single posts.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

$default        = hestia_get_blog_layout_default();
$sidebar_layout = apply_filters( 'hestia_sidebar_layout', get_theme_mod( 'hestia_blog_sidebar_layout', $default ) );
$wrap_class     = apply_filters( 'hestia_filter_single_post_content_classes', 'col-md-8 single-post-container' );
?>
<article id="post-<?php the_ID(); ?>" class="section section-text">
	<div class="row">
		<?php
		if ( ( $sidebar_layout === 'sidebar-left' ) && ! is_singular( 'elementor_library' ) ) {
			get_sidebar();
		}
		?>
		<div class="<?php echo esc_attr( $wrap_class ); ?>" data-layout="<?php echo esc_attr( $sidebar_layout ); ?>">

			<?php

			do_action( 'hestia_before_single_post_wrap' );

			if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {

				echo '<div class="single-post-wrap entry-content">';

				do_action( 'hestia_before_single_post_article' );

				do_action( 'hestia_before_single_post_content' );

				the_content();

				hestia_wp_link_pages(
					array(
						'before'      => '<div class="text-center"> <ul class="nav pagination pagination-primary">',
						'after'       => '</ul> </div>',
						'link_before' => '<li>',
						'link_after'  => '</li>',
					)
				);

				echo '</div>';

				//displaying related handymen for each location
				$relatedHandymen = new WP_Query(array(
					'posts_per_page' => -1,
					'post_type' => 'handyman',
					'orderby' => 'title',
					'order' => 'ASC',
					'meta_query' => array(
					  array(
						'key' => 'related_locations',
						'compare' => 'LIKE',
						'value' => '"'.get_the_ID().'"'
					  )
					)
				  ));
		
				  if($relatedHandymen->have_posts()){
					echo '<hr class="section-break">';
					echo '<h2 class="headline headline--medium">'. get_the_title().' Handymen</h2>';
					echo '<ul class="handyman-cards">';
					while($relatedHandymen->have_posts()){
					  $relatedHandymen->the_post();?>
					  <li class="handyman-card__list-item">
						<a class="handyman-card" href="<?php the_permalink();?>">
						<img class="handyman-card__image"
							  src="<?php the_post_thumbnail_url('handymanLandscape');?>">
						  <span class="handyman-card__name"> <?php the_title(); ?></span>
						</a>
					  </li>
					<?php
					}
					echo '</ul>';
					}wp_reset_postdata( );
			}

			echo '</div>';
			if ( ( $sidebar_layout === 'sidebar-right' ) && ! is_singular( 'elementor_library' ) ) {
				get_sidebar();
			}


			?>
		</div>
</article>

