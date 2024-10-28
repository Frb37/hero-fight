<div class="row">
    <div class="col">
        <form action="<?= isset($utilisateur) ? base_url("/admin/user/update") : base_url("/admin/user/create") ?>" method="POST" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">
                        <?= isset($utilisateur) ? "Editer " . $utilisateur['username'] : "Créer un utilisateur" ?>
                    </h4>
                    <?php
                    if (isset($utilisateur) && $utilisateur['deleted_at'] == null) { ?>
                        <a title="Désactiver l'utilisateur" href="<?= base_url('admin/user/deactivate/') . $utilisateur['id']; ?>">
                            <i class="fa-solid fa-xl fa-toggle-on text-success"></i>
                        </a>
                        <?php
                    } else { ?>
                        <a title="Activer un utilisateur"href="<?= base_url('admin/user/activate/') . $utilisateur['id']; ?>">
                            <i class="fa-solid fa-toggle-off fa-xl text-danger"></i>
                        </a>
                        <?php
                    }
                    ?>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profil-tab" data-bs-toggle="tab" data-bs-target="#profil" type="button" role="tab" aria-controls="profil" aria-selected="true">Profil</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="comments-tab" data-bs-toggle="tab" data-bs-target="#comments" type="button" role="tab" aria-controls="comments" aria-selected="false">Commentaires</button>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content border p-3">
                        <div class="tab-pane active" id="profil" role="tabpanel" aria-labelledby="profil-tab" tabindex="0">
                            <div class="mb-3">
                                <label for="username" class="form-label">Pseudo</label>
                                <input type="text" class="form-control" id="username" placeholder="username" value="<?= isset($utilisateur) ? $utilisateur['username'] : ""; ?>" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="mail" class="form-label">E-mail</label>
                                <input type="text" class="form-control" id="mail" placeholder="mail" value="<?= isset($utilisateur) ? $utilisateur['email'] : "" ?>" <?= isset($utilisateur) ? "readonly" : "" ?> >
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" placeholder="password" value="" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="id_permission" class="form-label">Rôle</label>
                                <select class="form-select" id="id_permission" name="id_permission">
                                    <option disabled <?= !isset($utilisateur) ? "selected":""; ?> >Selectionner un role</option>
                                    <?php foreach($permissions as $p): ?>
                                        <option value="<?= $p['id']; ?>" <?= ( isset($utilisateur) && $p['id'] == $utilisateur['id_permission']) ? "selected" : "" ?> >
                                            <?= $p['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Avatar</label>
                                <input class="form-control" type="file" name="profile_image" id="image">
                            </div>
                        </div>

                        <div class="tab-pane" id="comments" role="tabpanel" aria-labelledby="comments-tab" tabindex="0">
                            <table class="table table-sm table-hover table-auto w-100" id="tableComments">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Reponse</th>
                                    <th>Commentaire</th>
                                    <th>Nom de l'objet</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="card-footer text-end">
                    <?php if (isset($utilisateur)): ?>
                        <input type="hidden" name="id" value="<?= $utilisateur['id']; ?>">
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary">
                        <?= isset($utilisateur) ? "Sauvegarder" : "Enregistrer" ?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        var baseUrl = "<?= base_url(); ?>";
        var dataTable = $('#tableComments').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "autoWidth": false,
            "language": {
                url: '<?= base_url("/js/datatable/datatable-2.1.4-fr-FR.json") ?>',
                "emptyTable": "Aucun commentaire trouvé pour cet utilisateur" // Message personnalisé
            },
            "ajax": {
                "url": "<?= base_url('/admin/comment/searchdatatable'); ?>",
                "type": "POST",
                "data": { 'filter': 'user', 'filter_value': '<?= $utilisateur['id']; ?>' }
            },
            "columns": [
                {"data": "id"},
                {"data": "id_comment_parent"},
                {"data": "content"},
                {
                    data: 'item_name',
                    sortable: false,
                    render: function(data, type, row) {
                        return `<a class="link-underline link-underline-opacity-0" href="${baseUrl}admin/item/${row.id_item}">${row.item_name}</a>`;
                    }
                },
                {"data": "created_at"}
            ]
        });
    });
</script>