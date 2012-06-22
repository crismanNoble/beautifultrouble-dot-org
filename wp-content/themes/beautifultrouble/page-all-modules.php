<?php
/*
Template Name: Links template
*/
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
  <div class="row">
    <div class="container">
      <?php if (function_exists('bootstrapwp_breadcrumbs')) bootstrapwp_breadcrumbs(); ?>
    </div><!--/.container -->
  </div><!--/.row -->
  <div class="container">
 <!-- Masthead
 ================================================== -->
 <header class="jumbotron subhead" id="overview">
  <h1><?php the_title();?></h1>
</header>

<div class="row content">
  <div class="span8">
    <?php the_content();
    endwhile;
    ?>
    <hr />
<?php
$types = array( 'tactic', 'theory', 'principle', 'case', 'practitioner' );
foreach ( $types as $type ) {
    $obj = get_post_type_object( "bt_$type");
    echo '<h2>', $obj->labels->name, '</h2>';
    echo '<ul class="', $case, '">';
    // The Query
    $the_query = new WP_Query( array( 'post_type' => "bt_$type", 'nopaging' => 'true', 'orderby' => 'title', 'order' => 'ASC'  ));

    // The Loop
    while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

    <li><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></li>
           
    <?php endwhile;
    echo "</ul>";
    // Reset Post Data
    wp_reset_postdata();
    }
?>

  </div><!-- /.span8 -->
</div><!-- row -->
<?php get_footer(); ?>
