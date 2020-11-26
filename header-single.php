<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo("charset")?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php bloginfo("name")?> <?php wp_title( '&raquo;', $display = true, $seplocation = ''); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <!--Favicon-->
    <link rel="shortcut icon" href="<?php echo get_site_icon_url(); ?>"/>
</head>
<style>
    .navbar-collapse {
        justify-content: flex-end;
    }

     .navbar-collapse {
         justify-content: flex-end;
     }

    footer {
        background: none;
    }
    main
    {
        margin-bottom: 0;
    }
</style>
<style>
    .nv-post-navigation,
    .nv-single-post-wrap .nv-tags-list,
    .nv-single-post-wrap .nv-thumb-wrap {
        margin-bottom: 20px
    }

    .nv-single-post-wrap .entry-header:first-child,
    .nv-single-post-wrap .nv-content-wrap:first-child,
    .nv-single-post-wrap .nv-post-navigation:first-child,
    .nv-single-post-wrap .nv-tags-list:first-child,
    .nv-single-post-wrap .nv-thumb-wrap:first-child {
        margin-top: 30px
    }

    .single-post-container .title {
        margin-bottom: 0
    }

    .attachment-neve-blog {
        display: flex
    }

    .nv-post-navigation {
        display: flex;
        justify-content: space-between
    }

    .nv-post-navigation .next a:hover,
    .nv-post-navigation .previous a:hover {
        text-decoration: none
    }

    .nv-post-navigation .next a:hover span:not(.nav-direction),
    .nv-post-navigation .previous a:hover span:not(.nav-direction) {
        text-decoration: underline
    }

    .nv-post-navigation .next .nav-direction,
    .nv-post-navigation .previous .nav-direction {
        color: #676767;
        display: flex;
        flex-direction: column;
        font-size: 1em;

    }

    .nv-post-navigation .next {
        margin-left: auto;
        text-align: right
    }

    .nv-content-wrap .page-numbers {
        justify-content: center;
        margin: 10px auto;
        display: flex;
        flex-wrap: wrap;
        padding-left: 0;
        list-style-type: none
    }

    .nv-content-wrap .page-numbers>a:not(:last-child) span,
    .nv-content-wrap .page-numbers>span {
        padding-right: 20px
    }

    .post-password-form {
        margin-bottom: 40px;
        text-align: center
    }

    .post-password-form input[type=submit] {
        height: 39px;
        margin-left: 10px
    }

    .post-password-form label {
        margin-bottom: 0
    }

    .post-password-form p {
        display: flex;
        justify-content: center;
        align-items: center
    }

    .post-password-form label>input {
        margin-left: 10px
    }

    .nv-tags-list {
        font-size: .85em
    }

    .nv-tags-list span {
        margin-right: 10px
    }

    .nv-tags-list a {
        display: inline-block;
        padding: 2px 10px;
        transition: all .3s ease;
        border-radius: 3px;
        margin-bottom: 10px;
        margin-right: 10px;
        border: 1px solid #0366d6;
        color: #0366d6
    }

    .nv-tags-list a:hover {
        background: #0366d6;
        border-color: #0366d6;
        color: #fff
    }

    #comments {
        border-top: 1px solid #f0f0f0;
        margin-top: 10px
    }

    #comments ol {
        list-style: none
    }

    #comments ol>ol {
        padding-left: 10px
    }

    #comments .nv-content-wrap ol {
        list-style-type: decimal
    }

    #comments .nv-comments-list>li {
        padding: 10px 0 0
    }

    #comments .children>li {
        margin-top: 20px;
        padding-top: 20px
    }

    #comments .edit-reply {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        font-size: .85em
    }

    #comments .edit-reply .nv-reply-link {
        margin-left: auto
    }

    .nv-comments-list {
        padding-bottom: 20px
    }

    .nv-comments-title-wrap {
        margin: 40px 0 60px
    }

    .nv-comment-article {
        padding-bottom: 20px;
        border-bottom: 1px solid #f0f0f0
    }

    .nv-comment-header {
        display: flex;
        align-items: center;
        text-transform: none;
        font-style: normal;
        font-size: .85em;
        margin-bottom: 20px
    }

    .nv-comment-header .comment-author {
        display: flex;
        flex-direction: column
    }

    .nv-comment-avatar {
        margin-right: 20px
    }

    .nv-comment-avatar>img {
        float: left;
        border-radius: 50%
    }

    .comment-author .author {
        font-weight: 700;
        text-transform: uppercase
    }

    #comments input:not([type=submit]):not([type=checkbox]) {
        width: 100%
    }

    #comments textarea {
        width: 100%;
        max-width: 100%;
        min-width: 100%
    }

    #comments .comment-respond {
        margin: 40px 0
    }

    #comments .comment-reply-title small {
        float: right
    }

    .comment-form {
        display: grid;
        grid-column-gap: 20px;
        grid-row-gap: 20px
    }

    .comment-form>p:not(.comment-notes) {
        margin-bottom: 0
    }

    .comment-form label {
        margin-bottom: 10px;
        display: inline-block
    }

    .chi-other-text
    {
        width: 275px;
        height: 59px;
        font-style: normal;
        font-weight: bold;
        font-size: 18px;
        line-height: 26px;
        color: #000000;
    }

</style>
<style>
    html
    {
        background: linear-gradient(0deg, #FFFFFF, #FFFFFF), #FFFFFF;
    }
</style>
<?php
$category = get_the_category()[0]->slug;
$article = get_site_url() . "/". $category;
$video = get_site_url() . "/video/". $category;

$active_article =  "";
$active_video =  "";
$url_segments = array_filter(explode("/", $_SERVER['REQUEST_URI']));
$only_articles = ($_SERVER['REQUEST_URI']);

if (strpos($only_articles, "?clanky-a-reportaze"))
{
    $active_article = "chi-active";
}


$alert = "čtěte také";
$all_video = is_integer(strpos($only_articles, "?clanky-a-reportaze"));

if ($url_segments[1] == "video" or $all_video)
{
$active_video = "chi-active";
$category = $url_segments[2];
$alert = __("všechna videa", "chi");
?>
<style>
	/*.chi-claim
	{
		height: 100%
	}*/
	.chi-position-botom
	{
		padding: 0;
	}
	.chi-info-text
	{
		margin: 0;
		padding: 0 0 24px 0;
	}
	.white-color > p
	{
		margin: 0;
	}
</style>
<?php
}?>

<body <?php has_category("kardiovaskularni-zpravodajstvi") ? 'class="chi-claim--kavaz"' : '' ?>>
<header>
	<div class="navbar navbar-light chi-bg-light chi-navbar-height">

		<div class="left" id="chi-nav-toggle">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		</div>
		<div class="d-felex">
			<div class="chi-logo-sentens right">
				Provozováno portálem <a class="navbar-brand chi-logo-text-words" href="<?php echo get_home_url(); ?>"  title="Kongresonline.cz"><u>Kongresonline.cz</u></a>
			</div>
			<div class="right">
                <?php get_search_form(); ?>
			</div>
		</div>
	</div>
</header>
<div <?php body_class("chi-claim"); ?>>
    <?php get_template_part("chi-category-nav-content"); ?>
<?php get_template_part("/assets/confirms/chi-confirm"); ?>
    <?php get_template_part("/assets/confirms/pfizer-confirm"); ?>

