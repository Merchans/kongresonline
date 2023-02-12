<div class="container chi-hr mt-25 chi-pt-5"></div>
<div class="chi-footer-webpage-info container p-0">
	<p>Tyto stránky jsou určeny výhradně pro odbornou veřejnost.</p>
	<u id="cookiePreferencesButton">Nastavení cookies</u>
	<p> &copy; 2015 – <span id="year"></span> CZECH HEALTH INTERACTIVE</p>
</div>
</div>
<style>
	footer .text-center.color-green,
	.chi-footer-webpage-info.container>p {
		margin-bottom: 0.5rem;
	}

	.color-#C4C4C4 {
		color: #C4C4C4;
	}

	.text-center.color-green {
		color: #C4C4C4;
	}

	.container.text-center {
		padding: 10px 0 30px 0;
	}
</style>
<script>
	document.getElementById("year").innerHTML = new Date().getFullYear();

	function setCookie(key, value, expireDays, expireHours, expireMinutes, expireSeconds) {
		var expireDate = new Date();
		if (expireDays) {
			expireDate.setDate(expireDate.getDate() + expireDays);
		}
		if (expireHours) {
			expireDate.setHours(expireDate.getHours() + expireHours);
		}
		if (expireMinutes) {
			expireDate.setMinutes(expireDate.getMinutes() + expireMinutes);
		}
		if (expireSeconds) {
			expireDate.setSeconds(expireDate.getSeconds() + expireSeconds);
		}
		document.cookie = key + "=" + escape(value) +
			";domain=" + window.location.hostname +
			";path=/" +
			";expires=" + expireDate.toUTCString();
	}

	function deleteCookie(name) {
		setCookie(name, "", null, null, null, 1);
	}
	document.getElementById("cookiePreferencesButton").addEventListener("click", function() {
		deleteCookie("cc_cookie");
		location.reload();
	});
</script>