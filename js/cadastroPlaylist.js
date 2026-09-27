$(document).ready(function() {

    function previewImagem(input) {
        if (input.files && input.files[0]) {
            var leitor = new FileReader();

            leitor.onload = function(e) {
                $('#preview').attr('src', e.target.result).show();
            }

            leitor.readAsDataURL(input.files[0]);
        } else {
            $('#preview').hide();
        }
    }
    $("#foto").change(function() {
        previewImagem(this);
    });

    $("#formulario1").validate({
        rules: {
            nome: {
                required: true,
            },
            foto: {
            required: function() {
                return $('input[name="idPlaylist"]').val() === '';
            }
        }
        },
        messages: {
            nome: {
                required: "O campo nome é obrigatório."
            },
            foto: {
                required: "O campo foto é obrigatório."
            }
        }
    });

});