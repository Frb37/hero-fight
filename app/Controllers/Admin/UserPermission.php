<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class UserPermission extends BaseController
{
    protected $require_auth = true;
    protected $requiredPermissions = ['administrateur'];
    public function getindex($id = null) {
        if ($id == null) {
            $all_perms = Model('UserPermissionModel')->getAllPermissions();
            return $this->view('/admin/user/index-permission', ["all_perms" => $all_perms], true);
        } else {
            $upm = Model("/UserPermissionModel");
            if ($id == "new") {
                return $this->view('/admin/user/user-permission', [], true);
            }
            $permission = $upm->getUserPermissionById($id);
            return $this->view('/admin/user/user-permission', ["permission" => $permission], true);
        }
    }
    public function postSearchPermission()
    {
        $UserModel = model('App\Models\UserPermissionModel');

        // Paramètres de pagination et de recherche envoyés par DataTables
        $draw        = $this->request->getPost('draw');
        $start       = $this->request->getPost('start');
        $length      = $this->request->getPost('length');
        $searchValue = $this->request->getPost('search')['value'];

        // Obtenez les informations sur le tri envoyées par DataTables
        $orderColumnIndex = $this->request->getPost('order')[0]['column'];
        $orderDirection = $this->request->getPost('order')[0]['dir'];
        $orderColumnName = $this->request->getPost('columns')[$orderColumnIndex]['data'];

        // Obtenez les données triées et filtrées
        $data = $UserModel->getPaginatedPermission($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Obtenez le nombre total de lignes sans filtre
        $totalRecords = $UserModel->getTotalPermission();

        // Obtenez le nombre total de lignes filtrées pour la recherche
        $filteredRecords = $UserModel->getFilteredPermission($searchValue);

        $result = [
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];
        return $this->response->setJSON($result);
    }
}