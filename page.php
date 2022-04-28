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
    <?php
    $theParent = wp_get_post_parent_id(get_the_ID()); // Return parent Page ID. If no parent return 0
        if($theParent)
        {
            ?>
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                <a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent);?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent);?></a> <span class="metabox__main"><?php the_title();?></span>
                </p>
            </div>
            <?php
        }      
    ?>
      
        <?php 
        $theArray = get_pages(array(
          'child_of' => get_the_ID()
        ));
        if($theParent || $theArray)
        {
        // Check for page that is not a CHILD or PARENT page. Case of Normal Page  
        //In Case of normal page child pages menu bar will not display
        ?>
      <div class="page-links">
        <!-- 
         + $theParent = 0, means curent page is the parent page

         + get_the_title($theParent)
         
         + get_the_title(0) , current page
        -->
        <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent);?>"><?php echo get_the_title($theParent);?></a></h2>
        <ul class="min-list">
          <?php
          if($theParent)
          {          //if thge current page have parent  (menas it is the child) 

            $findChildrenOf = $theParent;
          }else{
            $findChildrenOf = get_the_ID();
          }
            wp_list_pages(array(
              'title_li' => null,
              'child_of' => $findChildrenOf,
              'sort_column' => 'menu_order'

            ));
          ?>
        </ul>
      </div> 
      <?php } ?>

      <div class="generic-content">
        <p>
            <?php the_content();?>
        </p>
      </div>
    </div>
   
    <?php
}

get_footer();
?>