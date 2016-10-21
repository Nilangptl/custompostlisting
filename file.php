<?php
/*
 * Get list of post using taxonomy of cutom post-type.
 * Author : Nilang
 * Email : patelnil.79@gmail.com
 */

    // get all the taxonomy/category of custom taxonomy
    $terms = get_terms('topic-tag', array(
       'orderby' => 'count',
       'hide_empty' => 0
    ));

    foreach($terms as $term)
    {
        wp_reset_query();

        // get post list of specific taxonomy/category
        $args = array('post_type' => 'topic',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'topic-tag',
                            'field' => 'slug',
                            'terms' => $term->slug,
                        ),
                    ),
                );
        $loop = new WP_Query($args);
        if($loop->have_posts())
        {
            echo '<h2>'.$term->name.'</h2>';
            while($loop->have_posts()) : $loop->the_post();
                echo '<a href="'.get_permalink().'">'.get_the_title().'</a>';
            endwhile;
        }
    }
?>