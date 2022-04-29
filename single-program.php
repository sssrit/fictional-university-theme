<?php

get_header();

while(have_posts())
{
    the_post();
    ?>  
    <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg');?>)"></div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_title();?></h1>
        <div class="page-banner__intro">
          <p>Add Data Later on.</p>
        </div>
      </div>
    </div>
   
    <div class="container container--narrow page-section">
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program');?>"><i class="fa fa-home" aria-hidden="true"></i> 
                Programs Home </a> <span class="metabox__main"><?php the_title();?>  </p>
            </div>
      <div calss="generic-content">
          <?php
            the_content();
          ?>
      </div>

      <?php
                $homePageEvents = new WP_Query(array(
                    'posts_per_page' => 2, // -1 means All posts
                    'post_type'=> 'event', // Add for custom post type.value is add in register_post_type function in university_post_types.php file
                    'meta_key' => 'event_date', // Enter meta key created in 3rd party ACF plugin
                    'orderby' => 'meta_value_num', // in wordpress meta data means custom or extra data associated with post
                    'order' => 'ASC',
                    'meta_query' => array( // Query on meta / custom value to show posts
                      array(
                        'key' => 'event_date',
                        'compare' => '>=',
                        'value' => date('Ymd'),
                        'type'=> 'numeric'
                      ),
                      array(
                        'key' => 'related_programs', //Chapter 8 Need to add details
                        'compare' => 'LIKE',
                        'value' => '"' . get_the_ID() . '"'
                      )
                    )
                ));


                if($homePageEvents->have_posts())
                {
                echo "<hr class = 'section-break'>";
                echo "<h2 class= 'headline headline--medium'>Upcomming ". get_the_title() ." Event</h2>";
                while($homePageEvents->have_posts())
                {
                    $homePageEvents->the_post();
                    ?>
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
            }
            ?>
    </div>
    <?php
}

get_footer();
?>