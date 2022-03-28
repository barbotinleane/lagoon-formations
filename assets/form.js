$(function() {
	$('input:radio[name="formation_asks[status]"]').change(function() {
		if ($(this).val() == 1) {
			$('#company_name').show();
			$('#siren_or_rm').show();
			$('#responsable').show();
			$('#activite').show();
			$('#stagiaires').show();

			$('#prerequis_autre').hide();
			$('#siret').hide();
			$('#id_pole_emploi').hide();
			$('#siren_entreprise').hide();
			$('#resp').hide();
			$('#handicap').hide();
		}    
		else if ($(this).val() == 2) {
			$('#company_name').hide();
			$('#siren_or_rm').show();
			$('#siret').hide();
			$('#id_pole_emploi').hide();
			$('#handicap').show();

			$('#stagiaires').hide();
			$('#prerequis_autre').show();

			$('#activite').show();
		}
		else if ($(this).val() == 3) {
			$('#company_name').hide();
			$('#siren_or_rm').hide();
			$('#siret').show();
			$('#id_pole_emploi').hide();
			$('#handicap').show();

			$('#stagiaires').hide();
			$('#prerequis_autre').show();

			$('#activite').show();
		}
		else if ($(this).val() == 4) {
			$('#company_name').hide();
			$('#siren_or_rm').hide();
			$('#siret').hide();
			$('#id_pole_emploi').show();
			$('#handicap').show();

			$('#stagiaires').hide();
			$('#prerequis_autre').show();

			$('#activite').hide();
		}
		else {
			$('#company_name').hide();
			$('#siren_or_rm').hide();
			$('#siret').hide();
			$('#id_pole_emploi').hide();
			$('#handicap').show();

			$('#stagiaires').hide();
			$('#prerequis_autre').show();
		}
	});
});

const addStagiaireToCollection = (e) => {
	alert(e.currentTarget.dataset.collectionHolderClass);
	const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

	const item = document.createElement('li');

	item.innerHTML = collectionHolder
		.dataset
		.prototype
		.replace(
			/__name__/g,
			collectionHolder.dataset.index
		);

	collectionHolder.appendChild(item);

	collectionHolder.dataset.index++;
};

document
	.querySelectorAll('.add_stagiaire_link')
	.forEach(btn => {
		btn.addEventListener("click", addStagiaireToCollection)
	})