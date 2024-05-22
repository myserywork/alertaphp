<?php

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function update_user()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $lastname = $this->input->post('lastName');
        $email = $this->input->post('email');
        $cpf = $this->input->post('cpf');

        // Validação dos dados de entrada (opcional)

        // Atualizar o usuário no banco de dados
        $data = array(
            'first_name' => $name,
            'email' => $email,
            'last_name' => $lastname,
            'cpf' => $cpf,
        );
        $this->users_model->update($id, $data);

        // Retornar a resposta
        $response = array(
            'status' => 'success',
            'message' => 'Usuário atualizado com sucesso'
        );

        $users = $this->users_model->get(); // Obtém todos os usuários do modelo

        $data = array();
        $i = 0;

        foreach ($users as $user) {
            $data[$i]['id'] = $user->id;
            $data[$i]['name'] = $user->first_name;
            $data[$i]['email'] = $user->email;
            $data[$i]['lastname'] = $user->last_name;
            $data[$i]['cpf'] = $user->cpf;
            $i++;
        }

        $response = array(
            'draw' => 1,
            'recordsTotal' => count($users),
            'recordsFiltered' => count($users),
            'data' => $data
        );

        echo json_encode($response);
    }




}