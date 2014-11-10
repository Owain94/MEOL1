/**
 * Created by Owain on 10/11/14.
 */

$(function() {

    $("input,textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
        },
        submitSuccess: function($form, event) {
            event.preventDefault();
            var firstname = $("input#voornaam").val();
            var affix = $("input#tussenvoegsel").val();
            var lastname = $("input#achternaam").val();
            var residence = $("input#plaats").val();

            $.ajax({
                url: "././apicalls/addowner.php",
                type: "POST",
                data: {
                    firstname: firstname,
                    affix: affix,
                    lastname: lastname,
                    residence: residence
                },
                cache: false,
                success: function() {
                    $('#success').html("<div class='alert alert-success'>");
                    $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-success')
                        .append("<strong>De eigenaar is toegevoegd. </strong>");
                    $('#success > .alert-success')
                        .append('</div>');

                    $('#ownerForm').trigger("reset");
                },
                error: function() {
                    $('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-danger')
                        .append("<strong>Oeps er is iets verkeerds gegaan.... </strong>");
                    $('#success > .alert-danger')
                        .append('</div>');

                    $('#ownerForm').trigger("reset");
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
