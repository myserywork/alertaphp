<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dash extends CI_Controller {

    public function index() {
        // Load the database
        $this->load->database();

        // Query to get the count of patients
        $query = $this->db->query('SELECT COUNT(*) AS total_pacientes FROM pacientes');
        $data['total_pacientes'] = $query->row()->total_pacientes;

        // Query to get the distribution of patients by gender
        $query = $this->db->query('SELECT genero, COUNT(*) AS count FROM pacientes GROUP BY genero');
        $data['genero_distribution'] = $query->result_array();

        // Query to get the distribution of chronic diseases
        $query = $this->db->query('
            SELECT d.nome, COUNT(pd.doenca_id) AS count
            FROM doencascronicas d
            JOIN paciente_doencas pd ON d.id = pd.doenca_id
            GROUP BY d.nome
        ');
        $data['doencas_distribution'] = $query->result_array();

        // Query to get the distribution of patients by age group
        $query = $this->db->query('
            SELECT 
                CASE 
                    WHEN TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) < 18 THEN "0-17"
                    WHEN TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) BETWEEN 18 AND 35 THEN "18-35"
                    WHEN TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) BETWEEN 36 AND 50 THEN "36-50"
                    ELSE "51+" 
                END AS age_group,
                COUNT(*) AS count 
            FROM pacientes
            GROUP BY age_group
        ');
        $data['age_group_distribution'] = $query->result_array();

        // Load the view
        echo $this->loadBase(
            array(
                'title' => 'Dashboard',
                'content' => 'dashboard/index/index_view',
                'breadcrumbs' => array('INÍCIO'),
                'data' => $data,
            )
        );
    }

     public function monit()
  {

    echo $this->loadBase(
      array(
        'title' => 'Dashboard',
        'content' => "dashboard/monit_view",
        'breadcumbs' => array("INÍCIO"),
      )
    );

    // show_alert('success', 'Teste de alerta', 'warning');
  }


  public function notifications()
  {

    echo $this->loadBase(
      array(
        'title' => 'Notificações',
        'content' => 'dashboard/notifications/notifications_view',
        'breadcumbs' => array("INÍCIO"),
      )
    );

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
