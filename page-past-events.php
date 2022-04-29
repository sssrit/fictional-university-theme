<?php 
/*  http://localhost/wp-cutom-theme/past-events/  */


get_header();
?>

<div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg');?>)"></div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"> Past Events</h1>
        <div class="page-banner__intro">
          <p>
         Recap of Past events.
          </p>
        </div>
      </div>
    </div>

    <div class="container container--narrow page-section">

      <?php
        // Custom PAGINATION CODE
        $pastEvents = new WP_Query(array(
            'paged' => get_query_var('paged',1),
            'posts_per_page'=>1, // if we delete this key defoult 10 post will display. At present it is set to 1 post 
            'post_type'=> 'event',
            'meta_key' => 'event_date', // Enter meta key created in 3rd party ACF plugin
                    'orderby' => 'meta_value_num', // in wordpress meta data means custom or extra data associated with post
                    'order' => 'ASC',
                    'meta_query' => array( // Query on meta / custom value to show posts
                      array(
                        'key' => 'event_date',
                        'compare' => '<',
                        'value' => date('Ymd'),
                        'type'=> 'numeric'
                      )
                    )
        ));
      
        while($pastEvents->have_posts())
        {
            $pastEvents->the_post();?>
          <div class="event-summary">
          <a class="event-summary__date t-center" href="<?php the_permalink();?>">
                            <span class="event-summary__month">
                              <?php 
                                     // the_field('event_date'); // This function is come with ACF plugin installed 
                                      //get_field('event_date'); // This function is come with ACF plugin installed 
                                    $eventDate = new DateTime(get_field('event_date'));
                                    echo $eventDate ->format('M');
                            
                            ?></span>
                            <span class="event-summary__day"><?php  echo $eventDate ->format('d')?></span>
                        </a>
                        <div class="event-summary__content">
                            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
                            <p><?php echo wp_trim_words(get_the_content(),10);?> <a href="<?php the_permalink();?>" class="nu gray">Read more</a></p>
                        </div>
                    </div>
        <?php
        }
        //echo paginate_links(); 
        //This function will not woek with custom query. it is only worked with generic pages. 
        //To run this wee need to add some more parameters in this paginatin_links() function.
         
        echo paginate_links(array(
            'total' => $pastEvents->max_num_pages
        )); 

      ?>

    </div>

<?php
get_footer();
?>