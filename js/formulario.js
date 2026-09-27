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

    $('#preco').mask('#.##0,00', {reverse: true});

    
    var urlAction = $("#formulario1").attr("action");
    var configuracaoRemote;
    if (urlAction.includes("editarArtBandaController.php")) {
        configuracaoRemote = {
            url: "validacaoRemotaNomeEditarController.php",
            type: "get",
            data: {
                id: function() {
                    return $("input[name='id']").val();
                }
            }
        };
    } else {
        configuracaoRemote = "validacaoRemotaNomeArtBandaController.php";
    }

    $("#formulario1").validate({
        rules: {
            nome: {
                required: true,
                remote: configuracaoRemote
            },
            descricao: {
                required: true,
                minlength: 50
            },
            preco: {
                required: true
            },
            foto: {
            required: function() {
                return $('input[name="id"]').val() === '';
            }
        }
        },
        messages: {
            nome: {
                required: "O campo nome é obrigatório.",
                remote: "Este artista ou banda já está cadastrado!"
            },
            descricao: {
                required: "O campo descrição é obrigatório.",
                minlength: "A descrição deve ter pelo menos 50 caracteres."
            },
            preco: {
                required: "O campo preço é obrigatório."
            },
            foto: {
                required: "O campo foto é obrigatório."
            }
        }
    });

});