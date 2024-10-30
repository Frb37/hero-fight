<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Battles extends BaseController
{
    public function getindex($id = null) {
        $bm = Model("BattlesModel");

        if ($id == null) {
            $battles = $bm->getAllBattles();
            return $this->view('/admin/battles/index', ['battles' => $battles], true);
        } else {
            $battles = $bm->getBattleByFirstId($id);
            return $this->view('/admin/battles/index', ['battles' => $battles], true);
        }
    }

    public function postSearchBattles()
    {
        $CharacterModel = model('App\Models\BattlesModel');

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
        $data = $CharacterModel->getPaginatedBattles($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Obtenez le nombre total de lignes sans filtre
        $totalRecords = $CharacterModel->getTotalBattles();

        // Obtenez le nombre total de lignes filtrées pour la recherche
        $filteredRecords = $CharacterModel->getFilteredBattles($searchValue);

        $result = [
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];
        return $this->response->setJSON($result);
    }
}