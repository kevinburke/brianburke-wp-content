<?php
/**
 * @package WordPress
 * @subpackage Mondo_Zen_Theme
 */

get_header(); ?>

	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : ?>

		<h2 class="pagetitle specialtitle">Search Results</h2>
		<?php if (is_search()) { ?>
			<small class="queryBlog">You have searched this blog for <strong>'<?php the_search_query(); ?>'</strong>.</small>
			<?php } ?>

		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?>>
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<small><?php the_time('l, F jS, Y') ?></small>

				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?><?php edit_post_link('Edit', ' | ', ''); ?></p>
			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

	<?php else : ?>
		
		<h2 class="pagetitle searchtitle">No Search Results Found</h2>
			<small class="queryBlog">Try a different search.</small>
		<div class="searchboxbody">
		<?php get_search_form(); ?>
		</div>
	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>