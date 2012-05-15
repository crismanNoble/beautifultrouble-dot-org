<?php get_header(); ?>
			
			<div id="content" class="clearfix row-fluid">
			
				<div id="main" class="span8 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header>
						
							<?php the_post_thumbnail( 'wpbs-featured' ); ?>
							
							<div class="page-header"><h1 class="single-title" itemprop="headline"><?php the_title(); ?></h1></div>
							
							<p class="meta"><?php _e("Posted", "bonestheme"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_date(); ?></time> <?php _e("by", "bonestheme"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", "bonestheme"); ?> <?php the_category(', '); ?>.</p>
						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">
							<?php the_content(); ?>

                                                        <?php $values = get_field('sources');
                                                        if($values)
                                                        {
                                                                echo '<h3 id="sources" class="sources">Sources</h3>';
                                                                echo '<ul>';
                                                         
                                                                foreach($values as $value)
                                                                {
                                                                    echo '<li>';
                                                                    echo '<a href="' . $value['link'] . '">' . $value['description'] . '</a>';  
                                                                    echo '</li>';
                                                                }
                                                         
                                                                echo '</ul>';
                                                        }
                                                        ?>						


                                                        <?php $args = array(
                                                            'numberposts'     => -1,
                                                            'offset'          => 0,
                                                            'orderby'         => 'post_date',
                                                            'order'           => 'DESC',
                                                            'post_type'       => 'bt_tactic',
                                                            'post_status'     => 'draft',
                                                            'meta_query' => array(
                                                                    array(
                                                                            'key' => 'related_practitioners',
                                                                            'value' => $post->ID,
                                                                    )
                                                            )
                                                        );  
                                                        $posts_array = get_posts( $args );
                                                        if( $posts_array ) {
                                                            echo '<h3 id="related-modules" class="related-modules">Related Modules</h3>';
                                                            echo '<ul>';
                                                            foreach( $posts_array as $post ) {
                                                                echo '<li>';
                                                                echo '<a href="' . $post->guid . '">' . $post->post_title . '</a>';
                                                                echo '</li>';
                                                            }
                                                            echo '</ul>';
                                                        }
                                                        ?>


                                                <?php wp_link_pages(); ?>

					
						</section> <!-- end article section -->
						
						<footer>
			
							<?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags","bonestheme") . ':</span> ', ' ', '</p>'); ?>
							
							<?php 
							// only show edit button if user has permission to edit posts
							if( $user_level > 0 ) { 
							?>
							<a href="<?php echo get_edit_post_link(); ?>" class="btn btn-success edit-post"><i class="icon-pencil icon-white"></i> <?php _e("Edit post","bonestheme"); ?></a>
							<?php } ?>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php comments_template(); ?>
					
					<?php endwhile; ?>			
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "bonestheme"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "bonestheme"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
				<?php get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>