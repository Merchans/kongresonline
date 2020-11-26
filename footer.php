<!-- JQuery Library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap Propper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script>
	$(document).ready(function () {

		document.getElementById("chi-close").addEventListener("click", function () {
			window.location.replace("http://google.com");
		});
		var chiConfirm = localStorage.getItem("chi-confirm");
		setTimeout(function () {
			if (!chiConfirm) {
				/*document.querySelector(".chi-bg-modal").style.display = "flex".hide();*/
				$("#popupContainer")
					.css("display", "flex")
					.hide()
					.fadeIn();
			}
		}, 100)
		document.getElementById("chi-submit").addEventListener("click",
			function (e) {
				if ($('#customCheck1').is(':checked')) {
					document.querySelector(".chi-bg-modal").style.display = "none";
					localStorage.setItem('chi-confirm', 'true');
				}
			});
	})
</script>
<script>
	$(document).ready(function () {

		document.getElementById("chi-close").addEventListener("click", function () {
			window.location.replace("http://google.com");
		});
		setTimeout(function () {
			/*document.querySelector(".chi-bg-modal").style.display = "flex".hide();*/
			$("#pfizerPopupContainer")
				.css("display", "flex")
				.hide()
				.fadeIn();
		}, 200);

		document.getElementById("pfizer-confirm-yes").addEventListener("click",
			function (e) {
				//var myNewURL = "?company=pfizerOK";//the new URL
				//window.history.pushState("object or string", "Title", myNewURL );
				$("#pfizerPopupContainer").fadeOut();
			});

		document.getElementById("pfizer-confirm-no").addEventListener("click",function () {
			window.location.replace("http://google.com");
		});

	});
</script>

<!--<script>
	jQuery(function ($) { $('h1, h2, h3, h4, h5, h6, p').each(function(index, value){
		var str = $(this).html();
		str = str.replace(/(\s|^)(a|i|o|u|k|s|v|z|A|I|O|U|K|S|V|Z|by|co|či|do|je|ke|ku|na|no|od|po|se|ta|to|ve|za|ze|že|aby|byl|což|jen|když|kde|kdy|který|která|které|nad|pod|pro|před|při|tak|Co|Či|Do|Je|Ke|Ku|Na|No|Od|Po|Se|Ta|To|Ve|Za|Ze|Že|Aby|Byl|Což|Jen|Když|Kde|Kdy|Který|Která|Které|Nad|Pod|Pro|Před|Při|Tak)(\s+)([^\p{Cc}\p{Cf}\p{zL}\p{Zp}]+)/gmi , '$1$2&nbsp;$4');
		$(this).html(str);
		console.log(str);
	})});
</script> -->
</html>
