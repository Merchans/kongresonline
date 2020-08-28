<?php  /* Template Name: O nas */
chi_all_headers();
wp_head();
?>
	<style>
		body
		{
			background: #FFFFFF;
		}
		main {
			margin-bottom: 0px;
			margin-bottom: 0px;
			background: linear-gradient(0deg, #FFFFFF, #FFFFFF), linear-gradient(180deg, #364F60 0%, #464F55 100%);
		}
		footer
		{
			background: none;
			margin-bottom: 0px;
			background: linear-gradient(0deg, #FFFFFF, #FFFFFF), linear-gradient(180deg, #364F60 0%, #464F55 100%);
		}
	</style>
	<main >
		<div class="container pb-5">
			<div class="row">
				<div class="col-md-12 chi-mt-1">
					<h1 class="chi-article-title">Co nabízíme?</h1>
					<p class="chi-404-text font-weight-bold">Společnost CZECH HEALTH INTERACTIVE, s.r.o. se zaměřuje výhradně na digitální komunikaci v oblasti zdravotnictví. Základem naší práce je především kvalitní, odborný obsah, který šíříme pomocí moderních online nástrojů. Naší vizí je stát se odborným partnerem pro farmaceutické společnosti v oblasti e-commerce a respektovaným médiem pro lékaře a farmaceuty.</p>
					<div class="chi-mt-1"></div>
				</div>
			</div>
			<div class="row mt-25">
				<div class="col-md-6">
					<div class="media">
						<img class="align-self-center  chi-media-about-us-img" src="<?php echo get_template_directory_uri(); ?>/img/obsah.svg" alt="Generic placeholder image">
						<div class="media-body">
							<h5 class="mt-0">Špičkový medicínský obsah</h5>
							<p>Veškerý náš obsah je připravován zdravotnickými odborníky. Víme, o čem píšeme, a dokážeme posoudit, jaké informace jsou pro lékaře skutečně důležité. Máme přehled v odborné legislativě a dokážeme Vám poradit s výběrem vhodných témat.</p>
						</div>
					</div>
					<div class="media">
						<img class="align-self-center  chi-media-about-us-img" src="<?php echo get_template_directory_uri(); ?>/img/technologiím.svg" alt="Generic placeholder image">
						<div class="media-body">
							<h5 class="mt-0">Moderní přístup k technologiím</h5>
							<p>Orientujeme se v moderních technologiích. Víme, co je právě "in" a velmi dobře známe farmaceutický trh. Dokážeme Vám pomoci s výběrem té nejlepší technologie právě pro vás.</p>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="media">
						<img class="align-self-center  chi-media-about-us-img" src="<?php echo get_template_directory_uri(); ?>/img/leadery.svg" alt="Generic placeholder image">
						<div class="media-body">
							<h5 class="mt-0">Odborná práce s opinion leadery</h5>
							<p>S lékaři dokážeme hovořit na odborné úrovni. Chápeme jejich časovou vytíženost a dokážeme pomoci tam, kde je třeba. Rádi pracujeme v přátelské atmosféře a vždy se snažíme na projektu pracovat tak, aby byl zajímavý a zábavný pro všechny zúčastněné.</p>
						</div>
					</div>
					<div class="media">
						<img class="align-self-center  chi-media-about-us-img" src="<?php echo get_template_directory_uri(); ?>/img/pristup.svg" alt="Generic placeholder image">
						<div class="media-body">
							<h5 class="mt-0">Individuální a osobní přístup</h5>
							<p>Ke každému projektu přistupujeme individuálně a vždy se snažíme navrhnout jej tak, aby co nejvíce naplnil potřeby klienta. Úspěch každého jednotlivého projektu je pro nás velmi důležitý.</p>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="d-flex h-20 mt-5">
                 <div class="chi-tag text-uppercase mr-auto p-2">
                     <a href="#" class="chi-tag_link">O NÁS</a>
                 </div>
             </div>-->
			<div class="container chi-hr mt-5" style="padding: 0px"></div>
			<!--   <div class="chi-team">
            <h4 class="chi-about-us-title">Jsme tým nadšených lidí s mnohaletými <br> zkušenosti z oboru. Naše práce je pro nás zároveň koníčkem.</h4>
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="chi-media-footer">
                        <div class="media chi-footer-media-title">
                            <img class="mr-3 chi-media-footer-img" src="<?php echo get_template_directory_uri(); ?>/img/vetrovsky.png" alt="Vetrovský">
                            <div class="media-body">
                                <h5 class="mt-0">MUDr. Tomáš Větrovský</h5>
                                <h6>IDEAS AND CO-OWNER</h6>
                            </div>
                        </div>
                        <p class="chi-media-footer-body">Snažím se propojit svoje zkušenosti z medicíny, marketingu a digitálních technologií, abych pro Vás vyvíjel účinná a inovativní řešení v oblasti …</p>
                    </div>
                    <div class="chi-media-footer">
                        <div class="media chi-footer-media-title">
                            <img class="mr-3 chi-media-footer-img" src="<?php echo get_template_directory_uri(); ?>/img/gadzuk.png" alt="Gadžuk">
                            <div class="media-body">
                                <h5 class="mt-0">Jindřich Gadžuk</h5>
                                <h6>SOLUTIONS</h6>
                            </div>
                        </div>
                        <p class="chi-media-footer-body">Mé dlouholeté praktické zkušenosti s rozvojem firemního IT jsou zárukou vysoce odborného a osobního přístupu k Vašim potřebám. Záleží mi na tom …</p>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="chi-media-footer">
                        <div class="media chi-footer-media-title">
                            <img class="mr-3 chi-media-footer-img" src="<?php echo get_template_directory_uri(); ?>/img/vanek.png" alt="Vaněk">
                            <div class="media-body">
                                <h5 class="mt-0">MUDr. Martin Vaněk</h5>
                                <h6>IDEAS AND CO-OWNER</h6>
                            </div>
                        </div>
                        <p class="chi-media-footer-body">Ostruhy jsem získával počátkem milénia téměř pět let v bývalých ZDN. Následujíci dekáda v soukromém sektoru, zaměřená na odbornou tištěnou …</p>
                    </div>
                    <div class="chi-media-footer">
                        <div class="media chi-footer-media-title">
                            <img class="mr-3 chi-media-footer-img" src="<?php echo get_template_directory_uri(); ?>/img/shibalova.png" alt="Novotný">
                            <div class="media-body">
                                <h5 class="mt-0">Kateřina Shibalová</h5>
                                <h6>SOLUTIONS</h6>
                            </div>
                        </div>
                        <p class="chi-media-footer-body">Již více než 8 let se pohybuji v oblasti IT a stejně tak dlouho se specializuji na farmacii. Díky svým zkušenostem z technické realizace i řízení …</p>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="chi-media-footer">
                        <div class="media chi-footer-media-title">
                            <img class="mr-3 chi-media-footer-img" src="<?php echo get_template_directory_uri(); ?>/img/novotny.png" alt="Novotný">
                            <div class="media-body">
                                <h5 class="mt-0">MUDr. Tomáš Novotný</h5>
                                <h6>CONTENT</h6>
                            </div>
                        </div>
                        <p class="chi-media-footer-body">Nabízím více než 12 let zkušeností z práce v odborných zdravotnických médiích, které jsou opřeny hlavně o znalost medicínské problematiky a osobní vazby …</p>
                    </div>
                </div>
            </div>
        </div> -->
		</div>
	</main>
	<!--<section class="pre-footer pb-5 ">
    <h4 class="pre-footer-title">Co o nás říkají odborníci?</h4>
    <div class="chi-carousel">
        <div class="bd-example">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators chi-carousel-cicrcle">
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class=""></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="1" class=""></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="2" class="active"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/800x400.png" class="d-block w-100" alt="img/800x400.png">
                        <div class="carousel-caption d-none d-md-block">
                            <p class="chi-carousel-text">Program digitálního kongresového zpravodajství vnímám velmi pozitivně a domnívám se, že takovýto projekt, jde naproti lékařům, je velice užitečný, protože přináší ve srozumitelné podobě novinky z jednotlivých oborů, čímž pomáhá zavádění inovativních postupů do béžné klinické praxe.</p>
                            <div class="chi-carousel-subtitle">
                                <strong>Prof. MUDr. Miloš Táborský, CSc., FESC, MBAprof. MUDr.</strong>
                                <small>předseda České kardiologické společnosti</small>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/800x400.png" class="d-block w-100" alt="img/800x400.png">
                        <div class="carousel-caption d-none d-md-block">
                            <p class="chi-carousel-text">Program digitálního kongresového zpravodajství vnímám velmi pozitivně a domnívám se, že takovýto projekt, jde naproti lékařům, je velice užitečný, protože přináší ve srozumitelné podobě novinky z jednotlivých oborů, čímž pomáhá zavádění inovativních postupů do béžné klinické praxe.</p>
                            <div class="chi-carousel-subtitle">
                                <strong>Prof. MUDr. Miloš Táborský, CSc., FESC, MBAprof. MUDr.</strong>
                                <small>předseda České kardiologické společnosti</small>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item active">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/800x400.png" class="d-block w-100" alt="img/800x400.png">
                        <div class="carousel-caption d-none d-md-block">
                            <p class="chi-carousel-text">Program digitálního kongresového zpravodajství vnímám velmi pozitivně a domnívám se, že takovýto projekt, jde naproti lékařům, je velice užitečný, protože přináší ve srozumitelné podobě novinky z jednotlivých oborů, čímž pomáhá zavádění inovativních postupů do béžné klinické praxe.</p>
                            <div class="chi-carousel-subtitle">
                                <strong>Prof. MUDr. Miloš Táborský, CSc., FESC, MBAprof. MUDr.</strong>
                                <small>předseda České kardiologické společnosti</small>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/800x400.png" class="d-block w-100" alt="">
                        <div class="carousel-caption d-none d-md-block">
                            <p class="chi-carousel-text">Program digitálního kongresového zpravodajství vnímám velmi pozitivně a domnívám se, že takovýto projekt, jde naproti lékařům, je velice užitečný, protože přináší ve srozumitelné podobě novinky z jednotlivých oborů, čímž pomáhá zavádění inovativních postupů do béžné klinické praxe.</p>
                            <div class="chi-carousel-subtitle">
                                <strong>Prof. MUDr. Miloš Táborský, CSc., FESC, MBAprof. MUDr.</strong>
                                <small>předseda České kardiologické společnosti</small>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</section>-->
	<section class="chi-pre-footer-contact container">
		<h6 class="chi-contact-title">Kontakt</h6>
		<div class="text-center mb-5">
			<a href="mailto:info@chinteractive.cz" class="chi-contact-email">info@chinteractive.cz</a>
		</div>
		<div class="row chi-contact-info mb-5">
			<div class="col-md-6">
				<strong>Adresa kanceláře:</strong>
				<br> Národní 32, 110 00 Praha 1
				<br> (Palác Chicago)
			</div>
			<div class="col-md-6">
				<strong>Fakturační údaje:</strong>
				<br> CZECH HEALTH INTERACTIVE, s.r.o.
				<br> Národní 58/32, 110 00 Praha 1 – Nové Město | IČ: 25130099, DIČ: CZ25130099
			</div>
		</div>
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post() ?>
                <?php the_content(); ?>
            <?php endwhile ?>
        <?php else : ?>

        <?php endif ?>
	</section>
	<footer>
        <?php get_template_part("chi-footer-content");	?>
	</footer>
<?php
wp_footer();
get_footer();
?>