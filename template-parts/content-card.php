<?php
/**
 * Template part for displaying page content of the Current exhibition card
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package vorwerkstift
 */

?>


<article id="upcoming-card" class="card">
	<?php vorwerkstift_post_thumbnail(); ?>
	<div class="entry-inner-container">
		<header class="entry-header">
			<p class="card-category"><?php pll_e( 'Upcoming event' ); ?></p>
			<p class="period"><?php echo formatEventPeriod(); ?></p>
			<?php the_title( '<h2 class="event-title">', '</h2>' ); ?>

			<?php if(get_field('artists_names')) { ?>
			<p class="artists">
				<?php the_field('artists_names'); ?>
			</p>
			<?php } ?> <!-- end if artists -->
			
			<h3><?php pll_e( 'Opening hours' ); ?>:</h3>
			<p class="opening-hours">
				<?php echo formatOpenedHours(); ?>
			</p><!-- end opening-hours -->
			<p class="entrance-fee">
				<?php echo formatEntranceFee(); ?>
			</p><!-- end entrance-fee -->
		</header><!-- .entry-header -->

		<div class="card-content">
			<p><?php the_field('excerpt'); ?></p>

			<a class="card-cta" 
				aria-label="<?php pll_e( 'find out more' ); echo ' '; pll_e( 'about' ); echo ' '; the_title(); ?> " 
				href="<?php echo getCurrentUrl() ?>">
				<?php pll_e( 'find out more' ); ?>
			</a>
		</div><!-- .entry-content -->

		<?php if ( get_edit_post_link() ) : ?>
			<footer class="entry-footer">
				<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'vorwerkstift' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					),
					'<span class="edit-link">',
					'</span>'
				);
				?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
