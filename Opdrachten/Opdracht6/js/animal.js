/**
 * Created by Owain on 10/11/14.
 */

$(function() {

    $("input,textarea,select").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
        },
        submitSuccess: function($form, event) {
            event.preventDefault();
            var name = $("input#naam").val();
            var kind = $("input#soort").val();
            var dob = $("input#geboortejaar").val();
            var owner = $("select#eigenaar").val();

            $.ajax({
                url: "././apicalls/addanimal.php",
                type: "POST",
                data: {
                    name: name,
                    kind: kind,
                    dob: dob,
                    owner: owner
                },
                cache: false,
                success: function() {
                    $('#success').html("<div class='alert alert-success'>");
                    $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-success')
                        .append("<strong>Het dier is toegevoegd. </strong>");
                    $('#success > .alert-success')
                        .append('</div>');

                    $('#animalForm').trigger("reset");
                },
                error: function() {
                    $('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-danger')
                        .append("<strong>Oeps er is iets verkeerds gegaan.... </strong>");
                    $('#success > .alert-danger')
                        .append('</div>');

                    $('#animalForm').trigger("reset");
                }
            })
        },
        filter: function() {
            return $(this).is(":visible");
        }
    });

    $("a[data-toggle=\"tab\"]").click(function(e) {
        e.preventDefault();
        $(this).tab("show");
    });
});

$('#name').focus(function() {
    $('#success').html('');
});
