<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Characters extends BaseController
{
    public function getindex($id = null) {
        $cm = Model("CharacterModel");

        if ($id == null) {
            $characters = $cm->getAllCharacters();
            return $this->view('/admin/character/index', ['characters' => $characters], true);
        } else {
            $characters = $cm->getCharacterByUserId($id);
            return $this->view('/admin/character/index', ['characters' => $characters], true);
        }
    }

    public function postSearchCharacter()
    {
        $CharacterModel = model('App\Models\CharacterModel');

        // Paramètres de pagination et de recherche envoyés par DataTables
        $draw        = $this->request->getPost('draw');
        $start       = $this->request->getPost('start');
        $length      = $this->request->getPost('length');
        $searchValue = $this->request->getPost('search')['value'];

        // Obtenez les informations sur le tri envoyées par DataTables
        $orderColumnIndex = $this->request->getPost('order')[0]['column'] ?? 0;
        $orderDirection = $this->request->getPost('order')[0]['dir'] ?? 'asc';
        $orderColumnName = $this->request->getPost('columns')[$orderColumnIndex]['data'] ?? 'id';


        // Obtenez les données triées et filtrées
        $data = $CharacterModel->getPaginatedCharacter($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Obtenez le nombre total de lignes sans filtre
        $totalRecords = $CharacterModel->getTotalCharacter();

        // Obtenez le nombre total de lignes filtrées pour la recherche
        $filteredRecords = $CharacterModel->getFilteredCharacter($searchValue);

        $result = [
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];
        return $this->response->setJSON($result);
    }
}