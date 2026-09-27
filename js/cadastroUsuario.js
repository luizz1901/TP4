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

    var idUsuario = $("input[name='idUser']").val();
    var configuracaoRemote;

    if (idUsuario) {
        configuracaoRemote = {
            url: "validacaoRemotaNomeUsuarioController.php",
            type: "post",
            data: {
                id: function() {
                    return idUsuario;
                }
            }
        };
    } else {
        configuracaoRemote = {
            url: "validacaoRemotaNomeUsuarioController.php",
            type: "post"
        };
    }

    $("#formulario1").validate({
        rules: {
            nome: {
                required: true,
                remote: configuracaoRemote 
            },
            senha: {
                required: true
            },
            foto: {
                required: function() {
                    return !idUsuario;
                }
            }
        },
        messages: {
            nome: {
                required: "Preencha esse campo",
                remote: "Este nome de usuário já está cadastrado!"
            },
            senha: {
                required: "Preencha esse campo"
            },
            foto: {
                required: "Preencha esse campo"
            }
        }
    });

});