var table;
$('document').ready(function () {

/**
 * Recebe o id da tabela para montar a dataTable e buscar
 * os registros para montar na interface do usuário
 */
    table = $('#listaFuncionario').DataTable({
        "ajax": "../../../controller/funcionario/ControllerFuncionario.php",
        "language": {
            "sEmptyTable": "Nenhum registro cadastrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum funcionário encontrado",
            "sSearch": "Pesquisar",
            "paginate": {
                "previous": "Anterior",
                "next": "Próximo",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }

        }
    });

    $(".modal").modal({ backdrop: false, keyboard: false, show: false });


/**
 * Funcionalidade para abrir o modal quando solicitar nova inclusão
 * de funcionário
 */
    $(document).on('click', '#addFuncionario', function () {
        $("#form")[0].reset();
        $("#modal_func").modal("show");
        $("#modal_func .modal-title").text("Adicionar Funcionário");
        $('[name="id"]').val("");
    });


/**
 * Funcionalidade para adicionar ou atualizar o funcionário
 */
    $(document).on("submit", "#form", function (event) {
        event.preventDefault();

        const id = $('[name="id"]').val();
        const dataForm = $("#form").serializeArray();
        let acao="add";

        if(id != ""){
            acao="update";
        }

        const url = "../../../controller/funcionario/ControllerFuncionario.php?acao=" + acao;

        $.ajax({
            url: url,
            type: "POST",
            data: dataForm,
            dataType: "json",
            success: function (data) {
                $("#modal-mensagem").modal("show");
                $("#modal-mensagem .modal-title").css("display", "none");
                if (data.erro) {
                    $("#modal-mensagem p").text(data.msg).attr("class", "alert alert-danger");
                    setTimeout(function () {
                        $("#modal-mensagem").modal("hide");
                    }, 3000);
                } else {

                    $("#modal-mensagem p").text(data.msg).attr("class", "alert alert-success");
                    setTimeout(function () {
                        $("#modal-mensagem").modal("hide");
                        $("#modal_func").modal("hide");
                        table.ajax.reload(null, false);
                    }, 3000);
                }
                $("#modal-mensagem .modal-footer").css("display", "none");

            },
            error: function (xhr, testStatus, error) {
                console.log(JSON.stringify(xhr));
            }
        });

    });

    
/**
 * Funcionalidade para deletar o funcionário especificado pelo id
 * ou buscar um funcionário.
 */
    $(document).on("click", "button.actionBtn", function (event) {

        event.preventDefault();
        const id = $(this).data("id");
        const action=$(this).data("action");

        if (action == "get") {

            $.ajax({

                url: "../../../controller/funcionario/ControllerFuncionario.php?acao=get&id=" + id,
                type: "GET",
                dataType: "json",
                success: function (data) {

                    if (data.erro) {
                        $("#modal-mensagem").modal("show");
                        $("#modal-mensagem .modal-title").css("display", "none");
                        $("#modal-mensagem p").text(data.msg).attr("class", "alert alert-danger");
                        $("#modal-mensagem .modal-footer").css("display", "none");
                        setTimeout(function () {
                            $("#modal-mensagem").modal("hide");
                        }, 3000);
                    } else {
                        $('[name="id"]').val("");
                        $("#form")[0].reset();
                        $("#modal_func").modal("show");
                        $("#modal_func .modal-title").text("Atualizar Funcionário");
                        $('[name="id"]').val(data.id);
                        $('[name="nome"]').val(data.nome);
                        $('select[name="cargo"]').val(data.cargo).prop("selected",true);
                        $('[name="data_nasc"]').val(data.data_nasc);
                        $('[name="data_adm"]').val(data.data_adm);
                    }
                },
                error: function (xhr, textStatus, error) {
                    console.log(JSON.stringify(xhr));
                }

            });
        }
        else if (action == "del") {
            if (confirm('Deseja realmente excluir?')) {
                $.ajax({
                    url: "../../../controller/funcionario/ControllerFuncionario.php?acao=del&id="+id,
                    type: "POST",
                    dataType: "json",
                    success: function (data) {

                        $("#modal-mensagem").modal("show");
                        $("#modal-mensagem .modal-title").css("display", "none");
                        if (data.erro) {
                            $("#modal-mensagem p").text(data.msg).attr("class", "alert alert-danger");
                        } else {
                            table.ajax.reload();
                            $("#modal-mensagem p").text(data.msg).attr("class", "alert alert-success");
                        }
                        $("#modal-mensagem .modal-footer").css("display", "none");
                        setTimeout(function () {
                            $("#modal-mensagem").modal("hide");
                        }, 3000);
                    },
                    error: function (xhr, textStatus, error) {
                        console.log(JSON.stringify(xhr));
                    }

                });
            }
        }

    });


/**
 * Funcionalidade para realizar o login do usuário caso ele já contém registro
 * no banco de dados ou caso não possua , ele pode registrar um cadastro
 */
    $(document).on("click", ".forms", function (event) {
        event.preventDefault();
        const action = $(this).data("action");
        const dataForm = $("form").serializeArray();
        const acao=action;

        let url = "../../processos/login_process.php?acao=" + acao;

        $.ajax({
            url: url,
            type: "POST",
            data: dataForm,
            dataType: "json",
            success: function (data) {
                $("#modal-mensagem").modal("show");
                $("#modal-mensagem .modal-title").css("display", "none");
                if (data.erro) {
                    $("#modal-mensagem p").text(data.msg).attr("class", "alert alert-danger");
                    setTimeout(function () {
                        $("#modal-mensagem").modal("hide");
                    }, 3000);
                } else {

                    $("#modal-mensagem p").text(data.msg).attr("class", "alert alert-success");
                    setTimeout(function () {
                        $("#modal-mensagem").modal("hide");
                        location.replace("/");
                    }, 3000);
                }
                $("#modal-mensagem .modal-footer").css("display", "none");
                $("form")[0].reset();

            },
            error: function (xhr, testStatus, error) {
                console.log(JSON.stringify(xhr));
            }
        });

    });

});
