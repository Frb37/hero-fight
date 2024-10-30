<?php

namespace App\Models;

use CodeIgniter\Model;

class CharacterModel extends Model
{
    protected $table            = 'characters';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'user_id', 'name', 'strength', 'constitution', 'agility', 'experience', 'level'];

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

    public function getCharacterById($id) {
        return $this->select("characters.id AS char_id, user.id AS user_id, user.username, characters.name, characters.strength, characters.constitution, characters.agility, characters.experience, characters.level")
            ->join("user", "user.id = characters.user_id")
            ->where("characters.id", $id)
            ->find();
    }

    public function getCharacterByUserId($user_id) {
        return $this->select("characters.id AS char_id, user.id AS user_id, user.username, characters.name, characters.strength, characters.constitution, characters.agility, characters.experience, characters.level")
            ->join("user", "user.id = characters.user_id")
            ->where("user_id", $user_id)
            ->find();
    }

    public function getAllCharacters() {
        return $this->select("characters.id AS char_id, user.id AS user_id, user.username, characters.name, characters.strength, characters.constitution, characters.agility, characters.experience, characters.level")
            ->join("user", "user.id = characters.user_id")
            ->find();
    }

    public function insertCharacter($data) {
        return $this->insert($data);
    }

    public function updateCharacter($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteCharacter($id) {
        return $this->delete($id);
    }

    public function getPaginatedCharacter($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();
        $builder->join('user', 'user.id = characters.user_id');
        $builder->select('characters.id AS id, user.username AS username, characters.name, characters.strength, characters.constitution, characters.agility, characters.experience, characters.level');

        // Recherche
        if ($searchValue != null) {
            $builder->groupStart()
                ->like('user.username', $searchValue)
                ->orLike('characters.name', $searchValue)
                ->orLike('characters.level', $searchValue)
                ->groupEnd();
        }

        // Tri
        if ($orderColumnName && $orderDirection) {
            $builder->orderBy($orderColumnName, $orderDirection);
        }

        $builder->limit($length, $start);

        return $builder->get()->getResultArray();
    }

    public function getTotalCharacter()
    {
        $builder = $this->builder();
        $builder->join('user', 'user.id = characters.user_id');
        return $builder->countAllResults();
    }

    public function getFilteredCharacter($searchValue)
    {
        $builder = $this->builder();
        $builder->join('user ', 'user.id = characters.user_id');
        $builder->select('characters.id, user.username, characters.name, characters.strength, characters.constitution, characters.agility, characters.experience, characters.level');

        // @phpstan-ignore-next-line
        if ($searchValue != null) {
            $builder->groupStart()
                ->like('user.username', $searchValue)
                ->orLike('characters.name', $searchValue)
                ->orLike('characters.level', $searchValue)
                ->groupEnd();
        }

        return $builder->countAllResults();
    }
}
