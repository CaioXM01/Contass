<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Este é o model responsavel por fazer a comunicação com o banco e retornar os dados.
class Tarefas_Model extends CI_Model {
    
    //salvar uma tarefa no banco
    public function salvar($dados=NULL) {
        if($dados!=NULL){
            $this->db->insert('tarefas', $dados);
            return 1;
        }else{
            return 0;
        }
    }
    //remover uma tarefa do banco
    public function remover($id=NULL) {
        if ($id != NULL) {
            $this->db->where('id', $id);
            $this->db->delete('tarefas');
            return 1;
        } else {
            return 0;
        }
    }
     //editar uma tarefa do banco
    public function editar($dados=NULL){
        if($dados!=NULL){
            $this->db->where('id', $dados['id']);
            return $this->db->update('tarefas', $dados);
        }
    }
     //listar todas as tarefas do banco
    public function listarTodos() {
       return $this->db->get('tarefas')->result_array();
    }
    
     //pesquisar uma tarefa no banco
    public function pesquisar($dados=NULL){
        if($dados['like'] !=NULL){
            $like = $dados['like'].'%';
            $sql ="SELECT * FROM tarefas WHERE tarefa LIKE ?";
            $query = $this->db->query($sql, array($like));
            return $query->result();
        }
    }    
    
}
	