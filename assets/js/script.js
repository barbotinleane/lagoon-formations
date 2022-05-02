




/*//for tooltips
const tooltips = document.querySelectorAll('.tt')
tooltips.forEach(t => {
  new bootstrap.Tooltip(t)
})

*/


//for radio buttons
function show_block(nameButtonGroup, choiceGood, blockToShow) {
    let choices = document.getElementsByName(nameButtonGroup);

    choices.forEach((choice) => {
      if (choice.checked) {
            if(choice.value == choiceGood) {
                document.getElementById(blockToShow).style.display = "block";
            } 
            else {
                document.getElementById(blockToShow).style.display = "none";
            }
        }
    });
}

function show_dates(nameButtonGroup, choiceGood, nameBlockGroup, blockToShow) {
  let choices = document.getElementsByName(nameButtonGroup);
  let dates = document.getElementsByName(nameBlockGroup);
  alert('click');

  choices.forEach((choice) => {
    if (choice.checked) {
      if(choice.value == choiceGood) {
        alert(choice.value);
        dates.forEach((date) => {
          if(date.id === blockToShow) {
            document.getElementById(blockToShow).style.display = "block";
          } else {
            date.style.display = "none";
          }
        });
      }
    }
  });
}



//for checkboxes
function addInput(idOfCheck, idToShow) {
  if (document.getElementById(idOfCheck).checked) {
    document.getElementById(idToShow).style.display = "block";
  } 
  else {
    document.getElementById(idToShow).style.display = "none";
  }
}

function able_submit(consents) {
  // Get and check the checkboxes
  let check = true;

  for (consent of consents) {
    if(document.getElementById(consent).checked == false) {
      check = false;
    }
  }

  // Get the button
  let button = document.getElementById("valider");

  // If the checkbox is checked, display the button
  if (check == true){
    button.disabled = false;
  } else {
    button.disabled = true;
  }
}

$(document).ready(function() {
  var $formation = $('#asks_formationLibelle');
  // When formation gets selected ...
  $formation.change(function() {
    $('#asks_formationSession').html('<div class="loader"></div>')
    // ... retrieve the corresponding form.
    var $form = $(this).closest('form');
    // Simulate form data, but only include the selected formation value.
    var data = {};
    data[$formation.attr('name')] = $formation.val();

    if($formation.val() == 1) {
      $('#asks_prerequisites').val('true');
      $('#prerequisites').show();
    } else {
      $('#asks_prerequisites').val('null');
      $('#prerequisites').hide();
    }
    // Submit data via AJAX to the form's action path.
    $.ajax({
      url: $form.attr('action'),
      type: $form.attr('method'),
      data: data,
      complete: function (html) {
        // Replace current session field ...
        $('#asks_formationSession').replaceWith(
            // ... with the returned one from the AJAX response.
            $(html.responseText).find('#asks_formationSession')
        );
        // Session field now displays the appropriate positions.
      }
    });
  });



  const addStagiaireFormDeleteLink = (item) => {
    const container = document.createElement('div');
    container.classList.add("text-center");

    const removeFormButton = document.createElement('button');
    removeFormButton.classList.add("btn");
    removeFormButton.classList.add("btn-warning");
    removeFormButton.innerHTML = '<i class="fas fa-user-minus"></i>&nbsp;Supprimer ce stagiaire';

    container.appendChild(removeFormButton);
    item.append(container);

    removeFormButton.addEventListener('click', (e) => {
      e.preventDefault();
      item.remove();
    });
  }

  const addStagiaireToCollection = (e) => {
    const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

    /*const container = document.createElement('div');
    container.classList.add("col-12");
    container.classList.add("col-sm-6");*/

    const item = document.createElement('li');
    item.classList.add("bg-brand-dark");
    item.classList.add("text-light");
    item.classList.add("shadow-lg");
    item.classList.add("p-4");
    item.classList.add("m-2");


    item.innerHTML = '<h4 class="text-center">STAGIAIRE</h4>';

    item.insertAdjacentHTML('beforeend', collectionHolder
        .dataset
        .prototype
        .replace(
            /__name__/g,
            collectionHolder.dataset.index
        ));

    /*container.appendChild(item);*/
    collectionHolder.appendChild(item);

    collectionHolder.dataset.index++;

    addStagiaireFormDeleteLink(item);
  };

  document
      .querySelectorAll('.add_stagiaire_link')
      .forEach(btn => {
        btn.addEventListener("click", addStagiaireToCollection)
      })

  document
      .querySelectorAll('div.stagiaires div')
      .forEach((stagiaire) => {
        addStagiaireFormDeleteLink(stagiaire)
      })


  var $consents = [$('#asks_consents_0'), $('#asks_consents_1'), $('#asks_consents_2')];

  $.each($consents, function( index, value ) {
    value.change(function() {
      //if all checked
      if($consents[0].is(':checked') && $consents[1].is(':checked') && $consents[2].is(':checked')) {
        $('#asks_save').prop('disabled', false);
      } else {
        $('#asks_save').prop('disabled', true);
      }
    })
  });
});

