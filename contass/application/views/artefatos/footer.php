
<!-- parte inicial da página -->



<!-- jQuery 3 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<!-- Bootstrap 3.4.0 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


<script>

  //variavel para definir se o item vai ser editado ou não
  var editarTarefas = 0;
  
  $(document).ready(function () {

    //verifica se a variavel tarefas esta ativa e chama a função listartodas()
    if ('<?php echo @$tarefas; ?>' == 'active') {
      listarTodas();
    }


    //função parapesquisar tarefas no banco
    $("#buscatarefas").keyup(function(){   
      if($("#buscatarefas").val()==""){
          listarTodas();
      }else{
          var like = $("#buscatarefas").val();
              // Faz requisição ajax e envia o ID da última frase via método POST
              $.post("<?php echo base_url('Tarefas/pesquisar'); ?>", {like: like}, function(resposta) {
                  //Limpa os dados anteriores da tabela
                  $("#lista_tarefas tr").remove();
                  // Coloca as frases na DIV
                  if(resposta!=0){
                      $("#lista_tarefas").append(resposta);
                  }else{
                      $("#lista_tarefas").append("<tr><td colspan='6'>Nenhum registro encontrado!</td></tr>");
                  }
              });
          }
      });

  });
   
  //função para enviar os dados do formulário para salvar ou editar a tarefa
   $('#ntarefas_form').submit(function () {
      var dados = $(this).serialize();
      var url_use;
      if (editarTarefas === 0) {
          url_use = "<?php echo base_url('Tarefas/salvar'); ?>";
      } else {
          url_use = "<?php echo base_url('Tarefas/editar'); ?>";
          dados += "&id=" + editarTarefas;
          editarTarefas = 0;
      }
      $.ajax({
          type: "POST",
          url: url_use,
          data: dados,
          success: function (data)
          {
              $("#ntarefas_form").trigger("reset");
              listarTodas();
              alert("Sucesso! A tarefa foi cadastrada.")
          }

      });
      return false;
  });

  //função que envia um id para remover uma tarefa
  function removerItem(idremover) {
    decisao = confirm("Deseja realmente REMOVER a tarefa?");
    if (decisao){
        var dados = new FormData();
        dados.append('idremover', idremover);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Tarefas/remover'); ?>",
            data: dados,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data)
            {
              listarTodas();
              alert("Sucesso! A tarefa foi Removida.");
            }
        });
    }else{
      return false;
    }
  }
  ;

  //função para carregar os dados do item que sera editado no formulário
  function alterarItem(ideditar, tarefa, autor, status) {
    editarTarefas = ideditar;
   
    document.getElementById("title_item").innerHTML = "Editar Tarefa:";
    document.getElementById("tarefa").value = tarefa;  
    document.getElementById("autor").value = autor;
    $("#status").val( $('option:contains("'+status+'")').val() );

    
    window.scrollTo(0, 0);
  }
  ;

  //função que lista todas as tarefas
  function listarTodas() {
    var ultimo = 1;

    // Faz requisição ajax para o controller
    $.post("/contass/Tarefas/listar", {ultimo: ultimo}, function (resposta) {
        //Limpa os dados anteriores da tabela
        $("#lista_tarefas tr").remove();
        // Coloca as frases na DIV
        $("#lista_tarefas").append(resposta);
    });
  }
  ;

</script>
</body>
</html>