<?php

if (get_post_type() == "post")
{
    $next_name = "Předchozí článek";
    $prev_prev = "Následující článek";
}
if (get_post_type() == "chi_video")
{
    $next_name = "Předchozí video";
    $prev_prev = "Následující video";
}

?>
<div class="nv-post-navigation pt-3">
    <?php previous_post_link('<div class="previous"><span class="nav-direction">&#8592; '.  $next_name .' </span><span class="chi-other-text">%link</span></a></div>', '%title', true) ?>
    <?php next_post_link('<div class="next"><span class="nav-direction">'. $prev_prev .' &#8594;</span><span class="chi-other-text">%link</span></a></div>', '%title', true) ?>
</div>