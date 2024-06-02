<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attendances_model extends MY_Model
{

    public $table = 'attendances';
    public $primary_key = 'id';
    public $timestamps = TRUE;
    public $soft_deletes = TRUE;
    public $protected = array('id');


    function __construct()
    {

        $this->has_one['pacient'] = array('Pacient_model', 'id', 'pacient_id');

        parent::__construct();
    }
}