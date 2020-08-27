<?php

if (isset($_GET["company"]) && $_GET["company"] == "pfizer"  )
{
	$url = "/?company=pfizer";
}
else
{
	$url = "#";
}

?>

<div class="chi-bg-modal" id="popupContainer">
	<div class="chi-modal-content mt-3" >
		<a href="#" class="chi-close" id="chi-close"><img src="<?php echo get_template_directory_uri(); ?>/img/close.svg" alt="krížik" ></a>
		<img src="<?php echo get_template_directory_uri(); ?>/img/chi-logo-black.svg" alt="" class="chi-logo-black">
        <?php if (!empty( get_option('chi_sub_logo_title') ) ){ echo get_option('chi_sub_logo_title'); }; ?>
		<p class="chi-claim-text mt-3">
			Výslovně prohlašuji a potvrzuji, že jsem odborníkem podle § 2a zákona č. 40/1995 Sb., o regulaci reklamy a o změně a doplnění některých dalších zákonů, ve znění pozdějších předpisů, tedy, že jsem osobou oprávněnou léčivé přípravky vydávat nebo předepisovat.
		</p>
		<form action="">
			<div class="custom-control custom-checkbox pl-0">
				<input type="checkbox"  id="customCheck1" checked required >
				<label  for="customCheck1" class="chi-lable">Jsem odborníkem ve zdravotnictví</label>
			</div>
			<a href="<?php echo $url ?>" id="chi-submit" type="submit" class="btn chi-btn-more-acticle mx-auto w-100">Potvrzuji</a>
		</form>
	</div>
</div>
