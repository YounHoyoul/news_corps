<!doctype html>
<html class="no-js">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="/wp-content/themes/empty/style.css"/>
  <?php wp_head(); ?>
</head>
<body>

  <?php get_header(); ?>
  
  <div class="logo-section my-5">
    <ul class="logos upper" id="upper-logos"></ul>  
    <ul class="logos lower" id="lower-logos"></ul>
  </div>

  <div class="form-section" id="request-form">
    <h2 class="text-center mb-5">Request a quote</h2>
    <div id="form_app"></div>
  </div>

  <div class="container my-5">
    <div class="row">
        <div class="blog-posts col-md-8">
        <?php if ( have_posts() ): ?>
            <?php while( have_posts() ): ?>
                <?php the_post(); ?>
                <div class="blog-post my-4">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php if ( has_post_thumbnail() ) :
                        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' ); ?>
                        <div class="blog-post-thumb">
                            <a href="<?php the_permalink(); ?>"><img src="<?php echo $featured_image[0]; ?>" alt='' /></a>
                        </div>
                    <?php endif; ?>
                    <?php the_excerpt(); ?>
                    <a class="read-more-link" href="<?php the_permalink(); ?>"><?php _e( 'Read More' ); ?></a>
                    <div class="posted-in">
                        <span><?php _e( 'Posted In', 'nd_dosth' ); ?></span>
                        <span><?php the_category( ', ' ); ?></span>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p><?php _e( 'No Blog Posts found', 'nd_dosth' ); ?></p>
        <?php endif; ?>
        </div>
        <div id="blog-sidebar" class="col-md-4">
        </div>
    </div>
  </div>

  <?php get_footer(); ?>

  <?php wp_footer(); ?>

  <script>
    jQuery(document).ready(function(){
      jQuery.ajax({
        type: 'GET',
        url: ajax_logosajax.ajaxurl,
        data: {
            action: 'ajax_ajaxhandler', 
        },
        success: function(data) {
            data = JSON.parse(data);
            upper = $("#upper-logos");
            data.upper.forEach(function(item){
              upper.append("<li><img src='"+item+"'></li>")
            })
            lower = $("#lower-logos");
            data.lower.forEach(function(item){
              lower.append("<li><img src='"+item+"'></li>")
            })
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert("Unknow error. please try again later.");
        }
      });
    });
  </script>
</body>
</html>