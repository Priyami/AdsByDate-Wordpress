<? php

/*
Template Name: Ads by Date

*/

?>


<?php

/*

1. Created the Custom Fields - Ads  and its Field labels - Name, Featured Image, URL of Ads, Start Date and End Date

2. Created the Custom Post UI as Sponsors which has the Custom Field - Name, Featured Image, URL of Ads, Start Date and End Date

3. The Query checks the Post_type is equal to sponsor and compares the start and end date with Today of each sponsor to make it active

4. The Loop displays the_title and Featured_Image as a link to their URL of their sites respectively based on query.


*/

if ( get_query_var('paged') ) $paged = get_query_var('paged');
if ( get_query_var('page') ) $paged = get_query_var('page');

$query = new WP_Query( array( 'post_type' => 'sponsor',
							  'paged' => $paged ,
							  'meta_query' => array(
							  		array(
	        						'key' => mystartdate,
	        						'compare'=> '<=',
	        						'value'	=> date("Ymd"),
	        						'type' => 'DATE'
	    							),
                                    array(
                                      'key' =>  myenddate ,
                                      'value' => date('Ymd'),
                                      'compare' => '>=',
                                      'type' => 'DATE'
                                      ))

                                     ) );

if ( $query->have_posts() ) : ?>
	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
		<div class="entry">

			<!-- Title Display -->
			<p class="title"><?php get_field('name'); ?></p>

			<?php $url = get_field('url') ?>

			<?php $image = get_field('featured_image');

  			$size = 'medium'; ?>

  			<!-- Image -->
  			<?php if ($url):  ?>

  				<a href="<?php the_field('url'); ?>"><?php echo wp_get_attachment_image( $image ,$size ); ?></a>&nbsp;&nbsp;&nbsp;

  			<?php else: ?>

  				<?php echo wp_get_attachment_image( $image ,$size ); ?>&nbsp;&nbsp;&nbsp;&nbsp;
  				
            <?php endif; ?>
  			           


		</div>
		
	<?php endwhile; wp_reset_postdata(); ?>
	<!-- show pagination here -->
<?php else : ?>
	<!-- show 404 error here -->
<?php endif; ?>
