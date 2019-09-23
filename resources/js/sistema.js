function voltaSubmit() {

    $("#endereco").val("");
    $("#bairro").val("");
    $("#cidade").val("");
    $("#uf").val("");
}

$("#cep").blur(function() {

    //Nova variável "cep" somente com dígitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            $("#endereco").val("...");
            $("#bairro").val("...");
            $("#cidade").val("...");
            $("#uf").val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#endereco").val(dados.logradouro);
                    $("#bairro").val(dados.bairro);
                    $("#cidade").val(dados.localidade);
                    $("#uf").val(dados.uf);
                } //end if.
                else {
                    //CEP pesquisado não foi encontrado.
                    voltaSubmit();
                    alert("CEP não encontrado.");
                }
            });
        } //end if.
        else {
            //cep é inválido.
            voltaSubmit();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        voltaSubmit();
    }
});

$('.vincular-curso-aluno').on('submit', function(e) {
    e.defaultPrevented;

    let _url = $(this).attr('action');
    let _instituicao = $(this).find('select[name="instituicao"]').val();
    let _curso = $(this).find('select[name="curso"]').val();

    if(_instituicao == "") {
        $('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
            '  Escolha ao menos uma instituição para vincular \n' +
            '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
            '    <span aria-hidden="true">&times;</span>\n' +
            '  </button>\n' +
            '</div>').appendTo($(this).find('.modal-body'));

        return false;
    }

    if(_curso == "") {
        $('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
            '  Escolha ao menos um curso para vincular \n' +
            '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
            '    <span aria-hidden="true">&times;</span>\n' +
            '  </button>\n' +
            '</div>').appendTo($(this).find('.modal-body'));

        return false;
    }

    $.ajax({
        contentType: "application/json; charset=utf-8",
        type: 'POST',
        url: _url,
        data: "{\"instituicao\": "+_instituicao+", \"curso\": "+_curso+"}",
        beforeSend: function(xhr) {

        },
        success: function(resp) {
            let _html = '<tr>\n' +
                    '    <td>'+resp.instituicao.nome+'</td>\n' +
                    '    <td>'+resp.curso.nome+'</td>\n' +
                    '    <td>\n' +
                    '       <button type="button" class="btn btn-sm btn-danger">\n' +
                    '           <i class="fa fa-trash"></i>\n' +
                    '       </button>\n' +
                    '    </td>\n' +
                    '</tr>';
            $(_html).appendTo($('#tableList'));
        },
        error: function(error) {

        }
    });

    return false;
});

$('.vincular-curso-aluno').on('submit', function(e) {
    e.defaultPrevented;

    let _url = $(this).attr('action');
    let _curso = $(this).find('select[name="curso"]').val();

    if(_curso == "") {
        $('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
            '  Escolha ao menos um curso para vincular \n' +
            '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
            '    <span aria-hidden="true">&times;</span>\n' +
            '  </button>\n' +
            '</div>').appendTo($(this).find('.modal-body'));

        return false;
    }

    $.ajax({
        contentType: "application/json; charset=utf-8",
        type: 'POST',
        url: _url,
        data: "{\"curso\": "+_curso+"}",
        beforeSend: function(xhr) {

        },
        success: function(resp) {
            let _html = '<tr>\n' +
                '    <td>'+resp.curso.nome+'</td>\n' +
                '    <td>\n' +
                '       <button type="button" class="btn btn-sm btn-danger">\n' +
                '           <i class="fa fa-trash"></i>\n' +
                '       </button>\n' +
                '    </td>\n' +
                '</tr>';
            $(_html).appendTo($('#tableListCursos'));
        },
        error: function(error) {

        }
    });

    return false;
});
