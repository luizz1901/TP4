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

    $('#duracao').mask('#.##0,00', {reverse: true});

    $("#formulario1").validate({
        rules: {
            nome: {
                required: true,
            },
            duracao: {
                required: true,
            },
            data: {
                required: true,
            },
            artista: {
                required: true,
            },
            foto: {
            required: function() {
                return $('input[name="id"]').val() === '';
            }
        }
        },
        messages: {
            nome: {
                required: "O campo nome é obrigatório."
            },
            duracao: {
                required: "O campo duração é obrigatório."
            },
            data: {
                required: "O campo data é obrigatório."
            },
            artista: {
                required: "O campo artista é obrigatório."
            },
            foto: {
                required: "O campo foto é obrigatório."
            }
        }
    });

});