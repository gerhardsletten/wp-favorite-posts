<?php
/*
echo "<ul>";
if ($favorite_post_ids):
	$c = 0;
	$favorite_post_ids = array_reverse($favorite_post_ids);
    foreach ($favorite_post_ids as $post_id) {
    	if ($c++ == $limit) break;
        $p = get_post($post_id);
        echo "<li>";
        echo "<a href='".get_permalink($post_id)."' title='". $p->post_title ."'>" . $p->post_title . "</a> ";
        echo "</li>";
    }
else:
    echo "<li>";
    echo "Your favorites will be here.";
    echo "</li>";
endif;
echo "</ul>";
*/
?>


<?php

		    $favorite_post_ids = wpfp_get_users_favorites();
		    echo "<ul>";
		    if ($favorite_post_ids):
				$favorite_post_ids = array_reverse($favorite_post_ids);
		        $post_per_page = wpfp_get_option("post_per_page");
		        $page = intval(get_query_var('paged'));
		        query_posts(array('post__in' => $favorite_post_ids, 'posts_per_page'=> $post_per_page, 'orderby' => 'post__in'));
		        while ( have_posts() ) : the_post();
?>
						<ul class="track">
							<?php echo "<li class=\"track-title\">" . get_the_title() . "</li>"; ?>
							<li class="track-fav"><?php if (function_exists('wpfp_link')) { wpfp_link(); } ?></li>
							<li class="track-play"><?php the_content(); ?></li>
						</ul>
<?php
		        endwhile;
		
		        wp_reset_query();
		    else:
		        echo "<li>";
				echo wpfp_get_option('favorites_empty');
		        echo "</li>";
		    endif;
		    echo "</ul>";
?>