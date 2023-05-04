import '../styles/css/webpages/formationAsk.scss';

$('.btn-save-formation-ask').prop('disabled', true);

$(function() {
    $("nav.navbar").addClass("bg-transparent");
    $("nav.navbar").removeClass("bg-white");

    $('input[name^="asks[status]"]').change(() => {
        let status = parseInt($("input[name='asks[status]']:checked").val());

        if(status === 1) {
            $('#companyInformations').show();
            $('#asks_companyName').prop('required',true);
            $('#asks_companyPostalCode').prop('required',true);
        } else {
            $('#companyInformations').hide();
            $('#asks_companyName').prop('required',false);
            $('#asks_companyPostalCode').prop('required',false);
        }

        if(status === 3) {
            $('#autre_statut_champ').show();
        } else {
            $('#autre_statut_champ').hide();
        }
    })

    $('input[name^="asks[knowsUs][]"]').click(() => {
        let knowsUs = [];
        $("input:checkbox[name='asks[knowsUs][]']:checked").each(function(){
            knowsUs.push($(this).val());
        });

        if(knowsUs.indexOf("Autre") > -1) {
            $('#autre_cnn_champ').show();
        } else {
            $('#autre_cnn_champ').hide();
        }
    })

    var $consents = [$('#asks_consents_0'), $('#asks_consents_1'), $('#asks_consents_2')];

    $.each($consents, function( index, value ) {
        value.change(function() {
            //if all checked
            if($consents[0].is(':checked') && $consents[1].is(':checked') && $consents[2].is(':checked')) {
                $('.btn-save-formation-ask').prop('disabled', false);
            } else {
                $('.btn-save-formation-ask').prop('disabled', true);
            }
        })
    });
})