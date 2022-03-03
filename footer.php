<!-- JQuery Library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap Propper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<!-- COKIEAS -->
<script>
    $('#c-p-bn').on('click', function() {
  var oldSrc = $(".embed-responsive-item").attr("src");
  var newSrc = oldSrc.replace("dnt=1", "dnt=0");
  
  $(".embed-responsive-item").attr("src", newSrc);
  
  console.log("Old Src: " + oldSrc);
  console.log("New Src: " + newSrc);
});
</script>

<?php //if ( isset($_GET["company"]) && $_GET["company"] == "pfizer"  ) :  ?>
<!--<script>-->
<!--	$(document).ready(function () {-->
<!---->
<!--		document.getElementById("chi-close").addEventListener("click", function () {-->
<!--			window.location.replace("http://google.com");-->
<!--		});-->
<!--		setTimeout(function () {-->
<!--			/*document.querySelector(".chi-bg-modal").style.display = "flex".hide();*/-->
<!--			$("#pfizerPopupContainer")-->
<!--					.css("display", "flex")-->
<!--					.hide()-->
<!--					.fadeIn();-->
<!--		}, 200);-->
<!---->
<!--		document.getElementById("pfizer-confirm-yes").addEventListener("click",-->
<!--				function (e) {-->
<!--					//var myNewURL = "?company=pfizerOK";//the new URL-->
<!--					//window.history.pushState("object or string", "Title", myNewURL );-->
<!--					$("#pfizerPopupContainer").fadeOut();-->
<!--				});-->
<!---->
<!--		document.getElementById("pfizer-confirm-no").addEventListener("click",function () {-->
<!--			window.location.replace("http://google.com");-->
<!--		});-->
<!---->
<!--	});-->
<!--</script>-->
<?php //endif; ?>
<?php //if ( !isset($_GET["company"]) or $_GET["company"] != "pfizer"  ) : ?>
<!--	<script>-->
<!--		$(document).ready(function () {-->
<!---->
<!--			document.getElementById("chi-close").addEventListener("click", function () {-->
<!--				window.location.replace("http://google.com");-->
<!--			});-->
<!---->
<!--			var chiConfirm = localStorage.getItem("chi-confirm");-->
<!--			setTimeout(function () {-->
<!--				if (!chiConfirm) {-->
<!--					/*document.querySelector(".chi-bg-modal").style.display = "flex".hide();*/-->
<!--					$("#popupContainer")-->
<!--							.css("display", "flex")-->
<!--							.hide()-->
<!--							.fadeIn();-->
<!--				}-->
<!--			}, 100)-->
<!--			document.getElementById("chi-submit").addEventListener("click",-->
<!--					function (e) {-->
<!--						if ($('#customCheck1').is(':checked')) {-->
<!--							document.querySelector(".chi-bg-modal#popupContainer").style.display = "none";-->
<!--							localStorage.setItem('chi-confirm', 'true');-->
<!--						}-->
<!--					});-->
<!--		})-->
<!--	</script>-->
<?php //endif ?>

</html>
