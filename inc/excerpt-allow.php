<?php

function excerpt($limit, $id = null)
{
	if ($id) {
		$excerpt = explode(' ', get_the_excerpt($id), $limit);
	}
	else {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
	}
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'<a href="'. get_permalink() . '">' . '&hellip;' . '</a>'; ;
    } else {
        $excerpt = implode(" ",$excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);

    $excerpt = closetags( $excerpt );
	


	if ( is_automat_nbsp_active() ):

		$excerpt = add_nbsp($excerpt, false);
		return $excerpt;
	else:
		return $excerpt;
	endif;
}


function closetags($html) {
	preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
	$openedtags = $result[1];
	preg_match_all('#</([a-z]+)>#iU', $html, $result);
	$closedtags = $result[1];
	$len_opened = count($openedtags);
	if (count($closedtags) == $len_opened) {
		return $html;
	}
	$openedtags = array_reverse($openedtags);
	for ($i=0; $i < $len_opened; $i++) {
		if (!in_array($openedtags[$i], $closedtags)) {
			$html .= '</'.$openedtags[$i].'>';
		} else {
			unset($closedtags[array_search($openedtags[$i], $closedtags)]);
		}
	}
	return $html;
}
