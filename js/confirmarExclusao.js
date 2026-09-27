$(document).ready(function () {
    $('.btn-excluir').on('click', function () {
        var botao = $(this);
        var idRegistro = botao.data('id');
        var urlExclusao = botao.data('url') || '../c/excluirArtBandaController.php'; 

        if (confirm("Tem certeza que deseja excluir este registro?")) {

            $.ajax({
                url: urlExclusao,
                type: 'GET',
                data: { id: idRegistro },
                success: function (resposta) {
                    alert("Registro excluído com sucesso!");
                    
                    var elementoPai = botao.closest('.col-12, .col-md-6, .col-lg-4, tr');
                    
                    elementoPai.fadeOut(400, function () {
                        $(this).remove();
                    });
                },
                error: function () {
                    alert("Erro ao tentar excluir o registro.");
                }
            });

        }
    });
});