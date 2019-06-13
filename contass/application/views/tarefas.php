<?php $this->load->view('artefatos/header.php');?>

    <h1>Lista de Tarefas </h1>
       <div class="row">
        <!-- left column -->
	        <div class=" col-md-10 col-md-offset-1 col-lg-offset-1">
	          <!-- general form elements -->

	            <div>
		            <div>
		              <h3  id="title_item">Nova Tarefa</h3>
		            </div>
		            <!-- /.box-header -->
		            <!-- form start -->
		            <form class="form-horizontal" method="POST" id="ntarefas_form">
		              <div class="box-body">
		                <div class="form-group">
		                  <label class="col-sm-1 control-label">Tarefa:</label>
		                  <div class="col-sm-6">
		                    <input type="text" class="form-control" id="tarefa" name="tarefa" required placeholder="Digite um novo título para a tarefa...">
		                  </div>

		                   <label class="col-sm-1 control-label">Status:</label> 
		                    <div class="col-sm-4">
			                  <select class="form-control" name="status" id="status" required>
			                    <option value="1">Finalizado</option>
			                    <option value="0">Em andamento</option>
			                    <option value="2">Cancelado</option>
			                  </select>
		                  </div>
		                </div>
		                <div class="form-group">
		                  <label class="col-sm-1 control-label">Autor:</label>
		                  <div class="col-sm-6">
		                    <input type="text" class="form-control" id="autor" name="autor" placeholder="Digite o nome do Autor...">
		                  </div>
		              </div>
		              <!-- /.box-body -->
		              <div class="box-footer">
		                <button type="reset" class="btn btn-default">Limpar</button>
		                <button type="submit" class="btn btn-info pull-right">Salvar</button>
		              </div>
		              <!-- /.box-footer -->
		            </form>
	            </div>

	        
	            <div class="box">
		            <div class="box-header">
		              <h3 class="box-title">Tarefas</h3>
		            
		              <div class="box-tools">

		                <div class="input-group input-group-sm" style="width: 300px;"> 
		                  <input type="text" id="buscatarefas" name="buscatarefas" required class="form-control pull-right" placeholder="Pesquisar">

		                  <div class="input-group-btn">
		                    <button type="submit" disabled class="btn btn-default">ir</button>
		                  </div>
		                </div>
		              </div>
		            </div>
	            	<!-- /.box-header -->
		            <div class="box-body table-responsive no-padding">
		              <table class="table table-hover">
		                <thead>
		                  <tr>
		                    <th>ID</th>
		                    <th>Tarefa</th>
		                    <th>Autor</th>
		                    <th>Status</th>
		                    <th>Editar</th>
		                    <th>Remover</th>
		                  </tr>
		                </thead>
		                <tbody id="lista_tarefas">
		                  
		                </tbody>
		               
		              </table>
		            </div>
		            <!-- /.box-body -->
	           </div>
	          <!-- /.box -->
	        </div>
        </div>



<?php $this->load->view('artefatos/footer.php');?>