<?php
/**
 * The default template for displaying content
 *
 * Used for pages.
 *
 * @package Hestia
 * @since Hestia 1.0
 */
?>

<?php
$sidebar_layout = apply_filters( 'hestia_sidebar_layout', get_theme_mod( 'hestia_page_sidebar_layout', 'full-width' ) );
$wrap_class     = apply_filters( 'hestia_filter_page_content_classes', 'col-md-8 page-content-wrap ' );
?>

	<article id="post-<?php the_ID(); ?>" class="section section-text">
		<div class="row">
			<?php
			if ( $sidebar_layout === 'sidebar-left' ) {
				do_action( 'hestia_page_sidebar' );
			}
			?>
			<div class="<?php echo esc_attr( $wrap_class ); ?>">
				<?php

					$theParent = wp_get_post_parent_ID(get_the_ID());
					if($theParent){ ?>
						<div class="metabox metabox--position-up metabox--with-home-link">
							<p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent); ?>">
							<i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent); ?></a> 
							<span class="metabox__main"><?php echo the_title(); ?></span></p>
						</div>
			<?php }

				do_action( 'hestia_before_page_content' );

				the_content();

				echo apply_filters( 'hestia_filter_blog_social_icons', '' );

				// this returns the pages but doesn't output it. If the pages has a parent or 
				$testArray = get_pages(array(
					'child_of' => get_the_ID()
				));  
				if($theParent or $testArray){ ?>
				<div class="page-links"> 
					<h2 class="page-links__title">
						<a href="<?php echo get_permalink($theParent); ?>">
							<?php echo get_the_title($theParent); ?>
						</a>
					</h2>
					<ul class="min-list">
					   <?php
						if($theParent){ // if the current page has a parent
							$findChildrenOf = $theParent;
						}
						else{ //viewing a parent page
							$findChildrenOf = get_the_ID();
						}
						 wp_list_pages(array(
							 'title_li' => NULL ,
							  'child_of' => $findChildrenOf,   
							  'sort_column' => 'menu_order'  
						 ));
					   ?> 
					</ul>
				</div>
				<?php } 

				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>
			</div>
			<?php
			if ( $sidebar_layout === 'sidebar-right' ) {
				do_action( 'hestia_page_sidebar' );
			}
			?>
		</div>
	</article>
<?php
if ( is_paged() ) {
	hestia_single_pagination();
}
