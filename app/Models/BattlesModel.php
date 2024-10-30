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

    public function getBattlesWithCharNames() {
        $this->select("c1.name, c2.name, w.name, l.name")
            ->join("characters c1", "c1.id = battles.character1_id")
            ->join("characters c2", "c2.id = battles.character2_id")
            ->join("characters w", "w.id = battles.winner_id")
            ->join("characters l", "l.id = battles.loser_id")
            ->find();
    }
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
