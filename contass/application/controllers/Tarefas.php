<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tarefas extends CI_Controller {

	//função index do controller
	public function index(){
		$dados['tarefas'] = "active";
		$this->load->view('tarefas.php',$dados);
	}

	//função salva tarefas no banco
	public function salvar() {
        $dados['tarefa'] = $this->input->post('tarefa');
        $dados['autor'] = $this->input->post('autor');
        $dados['status'] = $this->input->post('status');        
        
        $this->load->model('Tarefas_Model', 'tarefas');
        if ($this->tarefas->salvar($dados)) {
            echo "Salvo!";
        } else {
            echo "Erro!";
        }
    }

    //função que remove tarefas do banco
    public function remover() {
        $id = $this->input->post('idremover');
        $this->load->model('Tarefas_Model', 'tarefas');
        if($this->tarefas->remover($id)){
            echo "Removido!";
        }else{
            echo 'Erro';
        }
    }

    //função que edita tarefas do banco
    public function editar() {
        $dados['id'] = $this->input->post('id');
       	$dados['tarefa'] = $this->input->post('tarefa');
        $dados['autor'] = $this->input->post('autor');
        $dados['status'] = $this->input->post('status');  
       
        
        $this->load->model('Tarefas_Model', "tarefas");
        if ($this->tarefas->editar($dados)) {
            echo "Salvo!";
        } else {
            echo "Erro!";
        }
    }

    //função que lista todas as tarefas do banco
    public function listar() {
        $this->load->model('Tarefas_Model', 'tarefas');  
        $dados= $this->tarefas->listarTodos();
        foreach ($dados as $linha) {
            $id = "'" . $linha['id'] . "'";
            $tarefa = "'" . $linha['tarefa'] . "'";
            $autor = "'" . $linha['autor'] . "'";
            $status_name='';
            if ($linha['status'] == '1') {
            	$status_name='Finalizado';
            }else if($linha['status'] == '0'){
            	$status_name='Em andamento';
            }else if($linha['status'] == '2'){
            	$status_name='Cancelado';
            }
             $status = "'" . $status_name . "'";
            echo
            '<tr>
			<td>' . $linha['id'] . '</td>
			<td>' . $linha['tarefa'] . '</td>
			<td>' . $linha['autor'] . '</td>
            <td>' . $status_name . '</td>
			<td><button class="btn btn-info" onclick="alterarItem(' . $id . ',' . $tarefa . ',' . $autor .','.$status.')">Editar</button></td>
			<td><button class="btn btn-danger" onclick="removerItem(' . $id . ')">Remover</button></td>
			</tr>';
        }
    }

    //função que lista tarefas especificas
	public function pesquisar(){
        $this->load->model('Tarefas_Model','tarefas');
        $dados['like'] = $this->input->post('like');
        $resposta = $this->tarefas->pesquisar($dados); 
        if(!is_array($resposta)){
            echo 0;
            return 0;
        }
        foreach ($resposta as $linha) {
            $id = "'" . $linha->id . "'";
            $tarefa = "'" . $linha->tarefa . "'";
            $autor = "'" . $linha->autor . "'";
            $status_name='';
            if ($linha->status == '1') {
            	$status_name='Finalizado';
            }else if($linha->status == '0'){
            	$status_name='Em andamento';
            }else if($linha->status == '2'){
            	$status_name='Cancelado';
            }
             $status = "'" . $status_name . "'";
            echo
            '<tr>
			<td>' . $linha->id . '</td>
			<td>' . $linha->tarefa . '</td>
			<td>' . $linha->autor . '</td>
            <td>' . $status_name . '</td>
			<td><button class="btn btn-info" onclick="alterarItem(' . $id . ',' . $tarefa . ',' . $autor .','.$status.')">Editar</button></td>
			<td><button class="btn btn-danger" onclick="removerItem(' . $id . ')">Remover</button></td>
			</tr>';
        }
    }

}
