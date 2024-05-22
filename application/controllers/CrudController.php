<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->dbforge();
    }

    public function index() {
        $this->load->view('crud_view');
    }

    public function handle_request() {
        $action = $this->input->post('action') ?: $this->input->get('action');
        $table = $this->input->post('table') ?: $this->input->get('table');
        $database = $this->input->post('database') ?: $this->input->get('database');
        $id = $this->input->post('id') ?: $this->input->get('id');
        $data = $this->input->post('data');
        $field = $this->input->post('field');
        $columns = $this->input->post('columns');
        $column = $this->input->post('column');
        $ids = $this->input->post('ids');
        $query = $this->input->post('query');

        switch ($action) {
            case 'create':
                $result = $this->create($table, $data);
                break;
            case 'read':
                $result = $this->read($table, $id);
                break;
            case 'update':
                $result = $this->update($table, $id, $data);
                break;
            case 'delete':
                $result = $this->delete($table, $id);
                break;
            case 'get_all':
                $result = $this->get_all($table);
                break;
            case 'add_custom_field':
                $result = $this->add_custom_field($table, $field);
                break;
            case 'remove_custom_field':
                $result = $this->remove_custom_field($table, $field['name']);
                break;
            case 'list_tables':
                $result = $this->list_tables($database);
                break;
            case 'list_columns':
                $result = $this->list_columns($table);
                break;
            case 'add_foreign_key':
                $result = $this->add_foreign_key($data);
                break;
            case 'create_table':
                $result = $this->create_table($table, $columns);
                break;
            case 'delete_table':
                $result = $this->delete_table($table);
                break;
            case 'rename_column':
                $result = $this->rename_column($table, $column);
                break;
            case 'add_column':
                $result = $this->add_column($table, $column);
                break;
            case 'remove_column':
                $result = $this->remove_column($table, $column);
                break;
            case 'export_json':
                $result = $this->export_json($table);
                break;
            case 'import_json':
                $result = $this->import_json($table, $data);
                break;
            case 'multi_delete':
                $result = $this->multi_delete($table, $ids);
                break;
            case 'generate_report':
                $result = $this->generate_report($query, $table);
                break;
            case 'list_databases':
                $result = $this->list_databases();
                break;
            case 'create_database':
                $result = $this->create_database($database);
                break;
            case 'delete_database':
                $result = $this->delete_database($database);
                break;
            default:
                $result = ['status' => 'error', 'message' => 'Invalid action'];
                break;
        }

        echo json_encode($result);
    }

    private function create($table, $data) {
        if ($this->db->insert($table, $data)) {
            return ['status' => 'success', 'message' => 'Record created successfully'];
        }
        return ['status' => 'error', 'message' => 'Failed to create record'];
    }

    private function read($table, $id = null) {
        if ($id !== null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get($table);
        return $query->result();
    }

    private function update($table, $id, $data) {
        $this->db->where('id', $id);
        if ($this->db->update($table, $data)) {
            return ['status' => 'success', 'message' => 'Record updated successfully'];
        }
        return ['status' => 'error', 'message' => 'Failed to update record'];
    }

    private function delete($table, $id) {
        $this->db->where('id', $id);
        if ($this->db->delete($table)) {
            return ['status' => 'success', 'message' => 'Record deleted successfully'];
        }
        return ['status' => 'error', 'message' => 'Failed to delete record'];
    }

    private function multi_delete($table, $ids) {
        $this->db->where_in('id', $ids);
        if ($this->db->delete($table)) {
            return ['status' => 'success', 'message' => 'Records deleted successfully'];
        }
        return ['status' => 'error', 'message' => 'Failed to delete records'];
    }

    private function get_all($table) {
        if ($this->db->table_exists($table)) {
            $query = $this->db->get($table);
            return $query->result_array();
        }
        return ['status' => 'error', 'message' => 'Table does not exist'];
    }

    private function list_tables($database) {
        $this->db->query("USE $database");
        return $this->db->list_tables();
    }

    private function list_columns($table) {
        if ($this->db->table_exists($table)) {
            $fields = $this->db->field_data($table);
            $columns = [];
            foreach ($fields as $field) {
                $columns[] = $field->name;
            }
            return $columns;
        }
        return ['status' => 'error', 'message' => 'Table does not exist'];
    }

    private function add_custom_field($table, $field) {
        if (!$this->db->field_exists($field['name'], $table)) {
            $this->dbforge->add_column($table, [$field['name'] => ['type' => $field['definition']]]);
            return ['status' => 'success', 'message' => 'Field added successfully'];
        }
        return ['status' => 'error', 'message' => 'Field already exists'];
    }

    private function remove_custom_field($table, $field_name) {
        if ($this->db->field_exists($field_name, $table)) {
            $this->dbforge->drop_column($table, $field_name);
            return ['status' => 'success', 'message' => 'Field removed successfully'];
        }
        return ['status' => 'error', 'message' => 'Field does not exist'];
    }

    private function add_foreign_key($data) {
        $table = $data['table'];
        $column = $data['column'];
        $ref_table = $data['ref_table'];
        $ref_column = $data['ref_column'];

        $sql = "ALTER TABLE $table ADD FOREIGN KEY ($column) REFERENCES $ref_table($ref_column)";
        if ($this->db->query($sql)) {
            return ['status' => 'success', 'message' => 'Foreign key added successfully'];
        }
        return ['status' => 'error', 'message' => 'Failed to add foreign key'];
    }

    private function create_table($table, $columns) {
        if (!$this->db->table_exists($table)) {
            $this->dbforge->add_field('id');
            foreach ($columns as $column) {
                $this->dbforge->add_field([$column['name'] => ['type' => $column['type'], 'constraint' => $column['constraint']]]);
            }
            if ($this->dbforge->create_table($table)) {
                return ['status' => 'success', 'message' => 'Table created successfully'];
            }
            return ['status' => 'error', 'message' => 'Failed to create table'];
        }
        return ['status' => 'error', 'message' => 'Table already exists'];
    }

    private function delete_table($table) {
        if ($this->db->table_exists($table)) {
            if ($this->dbforge->drop_table($table, TRUE)) {
                return ['status' => 'success', 'message' => 'Table deleted successfully'];
            }
            return ['status' => 'error', 'message' => 'Failed to delete table'];
        }
        return ['status' => 'error', 'message' => 'Table does not exist'];
    }

    private function rename_column($table, $column) {
        if ($this->db->table_exists($table) && $this->db->field_exists($column['old_name'], $table)) {
            $fields = [
                $column['old_name'] => [
                    'name' => $column['new_name'],
                    'type' => $column['type'],
                    'constraint' => $column['constraint'],
                ]
            ];
            if ($this->dbforge->modify_column($table, $fields)) {
                return ['status' => 'success', 'message' => 'Column renamed successfully'];
            }
            return ['status' => 'error', 'message' => 'Failed to rename column'];
        }
        return ['status' => 'error', 'message' => 'Table or column does not exist'];
    }

    private function add_column($table, $column) {
        if ($this->db->table_exists($table)) {
            if (!$this->db->field_exists($column['name'], $table)) {
                $this->dbforge->add_column($table, [$column['name'] => ['type' => $column['type'], 'constraint' => $column['constraint']]]);
                return ['status' => 'success', 'message' => 'Column added successfully'];
            }
            return ['status' => 'error', 'message' => 'Column already exists'];
        }
        return ['status' => 'error', 'message' => 'Table does not exist'];
    }

    private function remove_column($table, $column_name) {
        if ($this->db->table_exists($table)) {
            if ($this->db->field_exists($column_name, $table)) {
                $this->dbforge->drop_column($table, $column_name);
                return ['status' => 'success', 'message' => 'Column removed successfully'];
            }
            return ['status' => 'error', 'message' => 'Column does not exist'];
        }
        return ['status' => 'error', 'message' => 'Table does not exist'];
    }

    private function export_json($table) {
        if ($this->db->table_exists($table)) {
            $query = $this->db->get($table);
            $data = $query->result_array();
            return json_encode($data);
        }
        return ['status' => 'error', 'message' => 'Table does not exist'];
    }

    private function import_json($table, $data) {
        if ($this->db->table_exists($table)) {
            $records = json_decode($data, true);
            foreach ($records as $record) {
                $this->db->insert($table, $record);
            }
            return ['status' => 'success', 'message' => 'Data imported successfully'];
        }
        return ['status' => 'error', 'message' => 'Table does not exist'];
    }

    private function generate_report($query, $table) {
        // Configure your OpenAI API key
        $api_key = 'YOUR_OPENAI_API_KEY';

        $data = $this->get_all($table);

        $data_string = json_encode($data);

        $prompt = "Generate a SQL report for the following table '$table' and query: '$query'.\n\n$data_string";

        $response = $this->call_openai_api($api_key, $prompt);

        return ['status' => 'success', 'message' => 'Report generated successfully', 'data' => $response];
    }

    private function call_openai_api($api_key, $prompt) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/completions");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'model' => 'text-davinci-003',
            'prompt' => $prompt,
            'max_tokens' => 1000,
            'temperature' => 0.7
        ]));

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true)['choices'][0]['text'];
    }

    private function list_databases() {
        $query = $this->db->query("SHOW DATABASES");
        return $query->result_array();
    }

    private function create_database($database) {
        if ($this->db->query("CREATE DATABASE $database")) {
            return ['status' => 'success', 'message' => 'Database created successfully'];
        }
        return ['status' => 'error', 'message' => 'Failed to create database'];
    }

    private function delete_database($database) {
        if ($this->db->query("DROP DATABASE $database")) {
            return ['status' => 'success', 'message' => 'Database deleted successfully'];
        }
        return ['status' => 'error', 'message' => 'Failed to delete database'];
    }
}
