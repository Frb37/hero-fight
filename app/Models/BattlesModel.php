<?php

namespace App\Models;

use CodeIgniter\Model;

class BattlesModel extends Model
{
    protected $table            = 'battles';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['character1_id', 'character2_id', 'winner_id', 'loser_id', 'date'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getBattleByFirstId($id) {
        $this->select("*")
            ->where("character1_id", $id1)
            ->find();
    }
    public function getBattleByParticipants($id1, $id2) {
        $this->select("*")
            ->where("character1_id", $id1)
            ->where("character2_id", $id2)
            ->find();
    }
    public function getAllBattles() {
        $this->findAll();
    }
    public function insertBattle($data) {
        $this->insert($data);
    }
    public function deleteBattle($data) {
        $this->delete($data);
    }
    public function updateBattle($data) {
        $this->update($data);
    }

}
