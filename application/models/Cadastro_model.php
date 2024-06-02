<?php
class Cadastro_model extends CI_Model {
   public function insert($dados) {
        // Inserir dados do paciente
        $this->db->insert('pacientes', [
            'nome' => $dados['nome'],
            'genero' => $dados['genero'],
            'data_nascimento' => $dados['data_nascimento'],
            'cpf' => $dados['cpf'],
            'email' => $dados['email'],
            'naturalidade' => $dados['naturalidade'],
            'peso' => $dados['peso'],
            'altura' => $dados['altura'],
            'pin' => $dados['pin'],
            'cep' => $dados['cep'],
            'endereco' => $dados['endereco'],
            'numero' => $dados['numero'],
            'estado' => $dados['estado'],
            'cidade' => $dados['cidade'],
            'complemento' => $dados['complemento'],
            'telefone' => $dados['telefone'],
            'telefone_fixo' => $dados['telefone'],
            'bebida' => $dados['bebida'],
            'alergia' => $dados['alergia'],
            'mobilidade' => $dados['mobilidade'],
            'terapia' => $dados['terapia'],
            'plano' => $dados['plano'],
            'plano_saude' => $dados['plano_saude'],
            'cuidador' => '',
            'nome_cuidador' => $dados['nome_cuidador'],
            'celular_cuidador' => $dados['celular_cuidador'],
            'telefone_fixo_cuidador' => $dados['telefone_fixo_cuidador'],
            'observacoes' => $dados['observacao'],
            'created_at' => date('Y-m-d H:i:s'),
            'deleted_at' => NULL
        ]);

        // Obter o ID do paciente recém-inserido
        $paciente_id = $this->db->insert_id();

        // Inserir dias da semana
        if (isset($dados['days'])) {
            foreach ($dados['days'] as $dia) {
                $this->db->insert('dias_semana', [
                    'paciente_id' => $paciente_id,
                    'dia' => $dia
                ]);
            }
        }

        if(isset($dados['doencas_cronicas'])) {
            foreach ($dados['doencas_cronicas'] as $doenca) {
                $this->db->insert('paciente_doencas', [
                    'paciente_id' => $paciente_id,
                    'doenca_id' => $doenca
                ]);
            }
        }

        return $paciente_id;
    }

public function get_paciente($pacienteId) {
    $this->db->where('id', $pacienteId);
    $paciente = $this->db->get('pacientes')->row();

    if ($paciente) {
        $paciente->doencas = $this->db->select('doencascronicas.nome as nome, doencascronicas.foto as foto')
                                      ->from('paciente_doencas')
                                      ->join('doencascronicas', 'paciente_doencas.doenca_id = doencascronicas.id')
                                      ->where('paciente_doencas.paciente_id', $pacienteId)
                                      ->get()
                                      ->result();
        $paciente->diasSemana = $this->db->get_where('dias_semana', ['paciente_id' => $pacienteId])->result();
    }

    return $paciente;
}



}


