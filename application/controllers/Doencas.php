<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Doencas extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    validateRoutes('index', 'doencas');
    $this->load->library('grocery_CRUD');

  }

    public function index()
    {
        $this->load->model('pacientes_model');
        $pacientes = $this->pacientes_model->get()->result();
        
        echo $this->loadBase(
        array(
            'title' => 'Doenças Crônicas',
            'content' => "dashboard/doencas/index",
            'breadcumbs' => array("INÍCIO"),
            'pacientes' => $pacientes
        )
        );
    
        //  show_alert('success', 'Teste de alerta', 'warning');
    }


    public function crud() {
        {
            try {
                $crud = new grocery_CRUD();
               
                $crud->set_table('doencascronicas');

                $crud->unset_columns(array(
                    'id',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ));

                $crud->display_as('name', 'Nome');
                $crud->display_as('description', 'Descrição');
                $crud->display_as('created_at', 'Criado em');
                $crud->display_as('updated_at', 'Atualizado em');
                $crud->display_as('deleted_at', 'Deletado em');

                $crud->set_field_upload('foto', 'assets/uploads/files');

                $crud->field_type('tipo', 'enum', array(
                    'protocolo' => 'Protocolo',
                    'cronico' => 'Doença Cronica',
                    'outro' => 'Outro'
                ));


                $crud->set_subject('Doença');

                $crud->required_fields('name', 'description');

      
                $crud->unset_export();
                $crud->unset_print();
                $crud->unset_read();
                $crud->unset_clone();
                $crud->unset_edit_fields('created_at', 'updated_at', 'deleted_at');

                $output = $crud->render();

                
                $this->renderCRUD($output);
               
            } catch (Exception $e) {
                show_error($e->getMessage());
            }
        }
    }

    public function sintomas(){
        $this->load->model('pacientes_model');
        $pacientes = $this->pacientes_model->get()->result();
        
        echo $this->loadBase(
        array(
            'title' => 'Sintomas',
            'content' => "dashboard/sintomas/index",
            'breadcumbs' => array("INÍCIO"),
            'pacientes' => $pacientes
        )
        );
    }
    public function sintomasCrud() {
        try {
            $crud = new grocery_CRUD();
            
            $crud->set_table('sintomas');
            $crud->set_relation('doencaId', 'doencascronicas', 'nome'); // Assume que 'name' é a coluna de nome na tabela 'doencascronicas'
            
            $crud->display_as('doencaId', 'Doença Associada');
            $crud->display_as('titulo', 'Título do Sintoma');
            $crud->display_as('pergunta', 'Pergunta ');
            $crud->display_as('risco', 'Risco');
     
            $crud->display_as('opcoes', 'Opções de Resposta');
            $crud->display_as('habilitada', 'Habilitado');
            $crud->display_as('ordem', 'Ordem de Apresentação');
            
            $crud->fields('doencaId', 'titulo','risco', 'pergunta', 'opcoes', 'habilitada','ordem');

            
            $crud->required_fields('doencaId', 'risco', 'titulo', 'pergunta', 'habilitada','ordem');
            
            $crud->unset_columns('id');
            
            $crud->field_type('habilitada', 'true_false');
            $crud->field_type('risco', 'enum', array('baixo', 'medio', 'alto','urgente'));
            $crud->field_type('opcoes', 'enum' , 
              array('sim-nao', 'escala-numerica', 'escala-visual-analogica', 'multipla-escolha', 'aberta')
            );
            
            $crud->set_subject('Sintoma');
            
            $crud->unset_export();
            $crud->unset_print();
            $crud->unset_read();
            $crud->unset_clone();
    
            $output = $crud->render();
            
            $this->renderCRUD($output);
            
        } catch (Exception $e) {
            show_error($e->getMessage());
        }
    }
    


    private function renderCRUD($output = null)
    {
        $this->load->view('crud/render_view', $output);
    }


    public function getDiaseWithSintomas() {
        $doencas = $this->db->get('doencascronicas')->result();
        $sintomas = $this->db->get('sintomas')->result();
        $doencasWithSintomas = array();
        foreach($doencas as $doenca) {
            $doenca->sintomas = array();
            foreach($sintomas as $sintoma) {
                if($sintoma->doencaId == $doenca->id) {
                    array_push($doenca->sintomas, $sintoma);
                }
            }
            array_push($doencasWithSintomas, $doenca);
        }
        return printJSON($doencasWithSintomas);
    }


    // sk-proj-c1EMLEZ1pGVV6R2i0cxCT3BlbkFJeKbUpn6rHstH1MLacOvD
    public function correct() {
        $doencas = $this->db->get('doencascronicas')->result();
  
        foreach($doencas as $doenca) { 
            $message = $doenca->recomendacoes_leve;
            $testopenai = fetchOpenAIResponse($message);
          
            $doenca->recomendacoes_leve = $testopenai;
            $this->db->where('id', $doenca->id);
            $this->db->update('doencascronicas', $doenca);
        
        }
      return   printJSON($doencas);
    }



    public function loadBase($context)
    {
  
      $user = loggedInUser();
  
      if (isset($context['breadcumbs'])) {
        $context['breadcumbs'] = generatePageBreadcrumb($context['title'], $context['breadcumbs']);
      }
  
      $context['user'] = $user;
  
      $context['user'] = $user;
      $context['notifications'] = $this->notifications_model->get($user->id, 5);
      $context['content'] = $this->load->view($context['content'], $context, true);
      return $this->load->view('dashboard/template/base_template_view', $context, TRUE);
    }
  

}
