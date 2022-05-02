$(function() {
	const showInput = (id) => {
		$('#asks_'+id).val('');
		$('#'+id).show();
	}

	const hideInput = (id) => {
		$('#asks_'+id).val('null');
		$('#'+id).hide();
	}

	$('input[name^="asks[status]"]').change(function() {
		let status = parseInt($("input[name='asks[status]']:checked").val());

		if (status === 1) {
			let fieldsToShow = [
				'companyName',
				'sirenOrRm',
			];

			let fieldsToHide = [
				'siret',
				'idPoleEmploi',
			];

			fieldsToShow.forEach((value) => {
				showInput(value);
			})

			fieldsToHide.forEach((value) => {
				hideInput(value);
			})

			$('#activite').show();
			$('#stagiaires').show();

			$('#prerequis_autre').hide();
			$('#handicap').hide();
		}    
		else if (status === 2) {
			let fieldsToShow = [
				'idPoleEmploi',
			];

			let fieldsToHide = [
				'siret',
				'companyName',
				'sirenOrRm',
			];

			fieldsToShow.forEach((value) => {
				showInput(value);
			})

			fieldsToHide.forEach((value) => {
				hideInput(value);
			})

			$('#handicap').show();

			$('#stagiaires').hide();
			$('#prerequis_autre').show();

			$('#activite').show();
		}
		else if (status === 3) {
			let fieldsToShow = [
				'sirenOrRm',
			];

			let fieldsToHide = [
				'siret',
				'companyName',
				'idPoleEmploi',
			];

			fieldsToShow.forEach((value) => {
				showInput(value);
			})

			fieldsToHide.forEach((value) => {
				hideInput(value);
			})

			$('#handicap').show();

			$('#stagiaires').hide();
			$('#prerequis_autre').show();

			$('#activite').show();
		}
		else if (status === 4) {
			let fieldsToShow = [
				'siret',
			];

			let fieldsToHide = [
				'sirenOrRm',
				'companyName',
				'idPoleEmploi',
			];

			fieldsToShow.forEach((value) => {
				showInput(value);
			})

			fieldsToHide.forEach((value) => {
				hideInput(value);
			})

			$('#handicap').show();

			$('#stagiaires').hide();
			$('#prerequis_autre').show();

			$('#activite').hide();
		}
		else {
			let fieldsToHide = [
				'siret',
				'companyName',
				'idPoleEmploi',
				'sirenOrRm',
			];

			fieldsToHide.forEach((value) => {
				hideInput(value);
			})

			$('#handicap').show();

			$('#stagiaires').hide();
			$('#prerequis_autre').show();
		}
	});

	$('input[name^="asks[status]"]').change(() => {
		let status = parseInt($("input[name='asks[status]']:checked").val());

		if(status === 5) {
			$('#autre_statut_champ').show();
		} else {
			$('#autre_statut_champ').hide();
		}
	})

	$('input[name^="asks[activityCategory]"]').change(() => {
		let activityCategory = $("input[name='asks[activityCategory]']:checked").val();

		if(activityCategory === "Autre") {
			$('#autre_activite_champ').show();
		} else {
			$('#autre_activite_champ').hide();
		}
	})

	$('input[name^="asks[goal]"]').change(() => {
		let goal = $("input[name='asks[goal]']:checked").val();

		if(goal === "Autre") {
			$('#autre_obj_champ').show();
		} else {
			$('#autre_obj_champ').hide();
		}
	})

	$('#asks_knowsUs_5').on("click", () => {
		if($('#asks_knowsUs_5').prop('checked')){
			$('#autre_cnn_champ').show();
		} else {
			$('#autre_cnn_champ').hide();
		}
	})
});

