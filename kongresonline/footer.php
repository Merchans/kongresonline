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
		}, 5000)
		document.getElementById("chi-submit").addEventListener("click",
			function (e) {
				if ($('#customCheck1').is(':checked')) {
					document.querySelector(".chi-bg-modal").style.display = "none";
					localStorage.setItem('chi-confirm', 'true');
				}
			});
	})
</script>
</html>