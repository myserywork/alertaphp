<?php


defined('BASEPATH') or exit('No direct script access allowed');


header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");

class Paciente extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('pacientes_model');
         $this->load->model('cadastro_model');
        $this->load->library('grocery_CRUD');
        // validateRoutes('index', 'dashboard');
    }

    public function index() {
        $pacientes = $this->pacientes_model->get()->result();

        echo $this->loadBase(
            array(
                'title' => 'Paciente',
                'content' => "dashboard/paciente/index",
                'breadcumbs' => array("INÍCIO"),
                'pacientes' => $pacientes
            )
        );
    }

 public function crud() {
    try {
        $crud = new grocery_CRUD();
        $crud->set_table('pacientes');

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

        // Configurar a relação n-n entre pacientes e doenças crônicas
        $crud->set_relation_n_n(
            'doencascronicas',
            'paciente_doencas',
            'doencascronicas',
            'paciente_id',
            'doenca_id',
            'nome'
        );

        // Adicionar coluna de ação personalizada para ver perfil
        $crud->add_action('Ver Perfil', '', 'paciente/perfil', 'fa fa-eye');

        // Desativar a modificação do campo `id` da tabela intermediária
        $crud->callback_before_update(array($this, 'disable_update_id'));

        $output = $crud->render();

        $this->renderCRUD($output);

    } catch (Exception $e) {
        show_alert('danger', 'Erro ao carregar a página', 'warning');
        redirect('dashboard');
    }
}

public function disable_update_id($post_array, $primary_key) {
    unset($post_array['id']);
    return $post_array;
}

    public function link_to_profile($value, $row) {
        return '<a href="'.site_url('paciente/perfil/'.$row->id . '?framed=true').'">'.$value.'</a>';
    }


    public function perfil($pacienteId) {
       
        $this->load->model('relatorio_model');

        $paciente = $this->cadastro_model->get_paciente($pacienteId);
        
        if (!$paciente) {
            show_404();
        }

        if($this->input->get('framed')) {
           $nobody = true;
        } else {
            $nobody = false;
        }

        $relatorios = $this->relatorio_model->get_relatorios_by_paciente($paciente->id);


        echo $this->loadBase(
            array(
                'title' => 'Perfil do Paciente',
                'content' => 'dashboard/paciente/perfil_view',
                'breadcumbs' => array("INÍCIO", "PACIENTE"),
                'relatorios' => $relatorios,
                'paciente' => $paciente,
                'noBody' => $nobody
            )
        );
    }
    public function login() {
      // Receber CPF e PIN via POST
      $cpf = $this->input->get('cpf');
      $pin = $this->input->get('pin');

      // Verificar se os campos estão preenchidos
      if (empty($cpf) || empty($pin)) {
          return $this->output
                      ->set_content_type('application/json')
                      ->set_output(json_encode(['error' => 'CPF e PIN são obrigatórios.']));
      }

      // Buscar paciente com CPF e PIN
      $patient = $this->db->get_where('pacientes', ['cpf' => $cpf, 'pin' => $pin])->row();

      if (!$patient) {
          return $this->output
                      ->set_content_type('application/json')
                      ->set_output(json_encode(['error' => 'CPF ou PIN inválidos.']));
      }

      // Buscar doenças crônicas do paciente
      $this->db->select('d.*');
      $this->db->from('doencascronicas d');
      $this->db->join('paciente_doencas pd', 'pd.doenca_id = d.id');
      $this->db->where('pd.paciente_id', $patient->id);
      $diseases = $this->db->get()->result();

      // Buscar sintomas para cada doença
      foreach ($diseases as $disease) {
          $disease->sintomas = $this->db->get_where('sintomas', ['doencaId' => $disease->id])->result();
      }

      $patient->doencasCronicas = $diseases;

      return $this->output
                  ->set_content_type('application/json')
                  ->set_output(json_encode($patient));
    }



    public function getPatientWithDiseases($patient_id) {
        // Buscar dados do paciente
        $patient = $this->db->get_where('pacientes', ['id' => $patient_id])->row();

        if (!$patient) {
            show_404();
        }

        // Buscar doenças crônicas do paciente
        $this->db->select('d.*');
        $this->db->from('doencascronicas d');
        $this->db->join('paciente_doencas pd', 'pd.doenca_id = d.id');
        $this->db->where('pd.paciente_id', $patient_id);
        $diseases = $this->db->get()->result();

        // Buscar sintomas para cada doença
        foreach ($diseases as $disease) {
            $disease->sintomas = $this->db->get_where('sintomas', ['doencaId' => $disease->id])->result();
        }

        $patient->doencasCronicas = $diseases;

        return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($patient));
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

    public function notifications() {
        echo $this->loadBase(
            array(
                'title' => 'Notificações',
                'content' => 'dashboard/notifications/notifications_view',
                'breadcumbs' => array("INÍCIO"),
            )
        );
    }

    private function renderCRUD($output = null) {
        $this->load->view('crud/render_view', $output);
    }

    public function loadBase($context) {
        $user = loggedInUser();

        if (isset($context['breadcumbs'])) {
            $context['breadcumbs'] = generatePageBreadcrumb($context['title'], $context['breadcumbs']);
        }

        $context['user'] = $user;
        $context['notifications'] = $this->notifications_model->get($user->id, 5);
        $context['content'] = $this->load->view($context['content'], $context, true);
        return $this->load->view('dashboard/template/base_template_view', $context, TRUE);
    }
}

/* End of file Paciente.php and path \application\controllers\Paciente.php */
