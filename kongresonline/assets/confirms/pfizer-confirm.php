<?php if ($_GET["company"] == "pfizer")  { ?>

	<div class="chi-bg-modal" id="pfizerPopupContainer">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">UPOZORNĚNÍ</h5>
					<button type="button" class="close" class="chi-close" id="chi-close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<strong>Opouštíte prostředí společnosti Pfizer PFE, spol. s r.o.</strong>
					<p>
						Společnost Pfizer PFE, spol. s r.o. neručí za obsah stránek, které hodláte navštívit. Přejete si pokračovat?
					</p>
				</div>
				<div class="modal-footer d-flex justify-content-between">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="pfizer-confirm-no">NE</button>
					<button type="button" class="btn btn-primary" id="pfizer-confirm-yes">ANO</button>
				</div>
			</div>
		</div>
	</div>
<?php } ?>


