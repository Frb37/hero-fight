<?php

namespace App\Models;

use CodeIgniter\Model;

class BattleHistoryModel extends Model
{
    protected $table            = 'battle_history';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'character_id', 'action', 'result', 'timestamp'];

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

    public function getAllBattleHistory() {
        return $this->findAll();
    }

    public function getBattleHistoryByUserID($user_id) {
        return $this->where('user_id', $user_id)->findAll();
    }

    public function getBattleHistoryByCharacterID($character_id) {
        return $this->where('character_id', $character_id)->findAll();
    }

    public function insertBattleHistory($data) {
        return $this->insert($data);
    }

    public function updateBattleHistory($data) {
        return $this->update($data);
    }

    public function deleteBattleHistory($id) {
        return $this->delete($id);
    }
}
