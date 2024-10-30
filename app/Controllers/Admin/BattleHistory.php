<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class BattleHistory extends BaseController
{
    public function getindex($id_user = null) {
        $bhm = Model("BattleHistoryModel");
        $battle_history = $bhm->getAllBattleHistory();
        return $this->view('/admin/battles/index', ['battle_history' => $battle_history], true);
    }

    public function postSearchBattleHistory()
    {
        $CharacterModel = model('App\Models\BattleHistoryModel');

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
        $data = $CharacterModel->getPaginatedBattleHistory($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Obtenez le nombre total de lignes sans filtre
        $totalRecords = $CharacterModel->getTotalBattleHistory();

        // Obtenez le nombre total de lignes filtrées pour la recherche
        $filteredRecords = $CharacterModel->getFilteredBattleHistory($searchValue);

        $result = [
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];
        return $this->response->setJSON($result);
    }
}