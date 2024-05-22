<?php 

function getAnamneseFields() {
 
    return array(
        'doencas_cronicas' => array(
            'display' => 'Doenças Crônicas',
            'type' => 'multiselect',
            'options' => array(
                'diabetes' => 'Diabetes',
                'hipertensao' => 'Hipertensão',
                'asma' => 'Asma',
                // Adicione outras doenças crônicas aqui
            )
        ),
        'problemas_cardiacos' => array(
            'display' => 'Problemas Cardíacos',
            'type' => 'multiselect',
            'options' => array(
                'insuficiencia_cardiaca' => 'Insuficiência Cardíaca',
                'arritmia' => 'Arritmia',
                'angina' => 'Angina',
                // Adicione outros problemas cardíacos aqui
            )
        ),
        'problemas_respiratorios' => array(
            'display' => 'Problemas Respiratórios',
            'type' => 'multiselect',
            'options' => array(
                'bronquite' => 'Bronquite',
                'pneumonia' => 'Pneumonia',
                'dpoc' => 'DPOC',
                // Adicione outros problemas respiratórios aqui
            )
        ),
        'peso' => array(
            'display' => 'Peso',
            'type' => 'text',
            'validations' => 'required|numeric',
            'mask' => '999.99'
        ),
        'altura' => array(
            'display' => 'Altura',
            'type' => 'text',
            'validations' => 'required|numeric',
        ),
        'pressao_arterial' => array(
            'display' => 'Pressão Arterial',
            'type' => 'text',
            'validations' => 'required',
        ),
        'fumante' => array(
            'display' => 'Fumante',
            'type' => 'text',
            'validations' => 'required',
        ),
        'alergias' => array(
            'display' => 'Alergias',
            'type' => 'text',
            'validations' => 'required',
        ),
        'medicamentos' => array(
            'display' => 'Medicamentos',
            'type' => 'text',
            'validations' => 'required',
        ),
        'cirurgias' => array(
            'display' => 'Cirurgias',
            'type' => 'text',
            'validations' => 'required',
        ),
        'alzheimer' => array(
            'display' => 'Alzheimer',
            'type' => 'option',
            'options' => array(
                array(
                    'label' => 'Sim',
                    'value' => '1'
                ),
                array(
                    'label' => 'Não',
                    'value' => '0'
                )
            ),
            'validations' => 'required',
        ),
    );
} 
    