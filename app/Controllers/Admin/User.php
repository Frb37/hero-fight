<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class User extends BaseController
{
    protected $require_auth = true;
    protected $requiredPermissions = ['administrateur'];
    public function getindex($id = null)
    {
        $um = Model("UserModel");
        $upm = Model("UserPermissionModel");
        if ($id == null) {
            $users = $um->getPermissions();
            return $this->view("/admin/user/index.php", ["users" => $users], true);
        } else {
            $permissions = $upm->getAllPermissions();
            if ($id == "new") {
                return $this->view("/admin/user/user", ["permissions" => $permissions], true);
            }
            $user = $um->getUserById($id);
            if ($user) {
                return $this->view("/admin/user/user", ['user' => $user, 'permissions' => $permissions], true);
            } else {
                $this->error("User ID could not be found in database");
                $this->redirect("/admin/user");
            }
        }
    }

    public function postSearchUser()
    {
        $UserModel = model('App\Models\UserModel');

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
        $data = $UserModel->getPaginatedUser($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Obtenez le nombre total de lignes sans filtre
        $totalRecords = $UserModel->getTotalUser();

        // Obtenez le nombre total de lignes filtrées pour la recherche
        $filteredRecords = $UserModel->getFilteredUser($searchValue);

        $result = [
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];
        return $this->response->setJSON($result);
    }
}