<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>User list</h4>
        <a href="/admin/user/create"><i class="fa-solid fa-user-plus"></i></a>
    </div>
    <div class="card-body">
        <table id="tableUsers" class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>profile_pic</th>
                    <th>username</th>
                    <th>mail</th>
                    <th>permission_name</th>
                    <th>created_at</th>
                    <th>last_updated</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        var baseUrl = "<?= base_url(); ?>";
        var dataTable = $('#tableUsers').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "language": {
                url: '<?= base_url("/js/datatable/datatable-2.1.4-fr-FR.json") ?>',
            },
            "ajax": {
                "url": "<?= base_url('/admin/user/SearchUser'); ?>",
                "type": "POST"
            },
            "columns": [
                {"data": "id"},
                {
                    data : 'avatar_url',
                    sortable : false,
                    render : function(data) {
                        if (data) {
                            return `<img src="${baseUrl}/${data}" alt="Avatar" style="max-width: 20px; height: auto;">`;
                        } else {
                            // Retourne une image par défaut si data est vide
                            return '<img src="' + baseUrl + '/assets/img/avatars/1.jpg" alt="Default Avatar" style="max-width: 20px; height: auto;">';
                        }
                    }
                },
                {"data": "username"},
                {"data": "email"},
                {"data": "permission_name"},
                {"data": "created_at"},
                {"data": "updated_at"},
                {
                    data : 'id',
                    sortable : false,
                    render : function(data) {
                        return `<a href="/admin/user/${data}"><i class="fa-solid fa-pencil"></i></a>`;
                    }
                },
                {
                    data : 'id',
                    sortable : false,
                    render : function(data, type, row) {
                        return (row.deleted_at === null ?
                            `<a title="Désactiver l'utilisateur" href="/admin/user/deactivate/${row.id}"><i class="fa-solid fa-xl fa-toggle-off text-success"></i></a>`: `<a title="Activer un utilisateur" href="/admin/user/activate/${row.id}"><i class="fa-solid fa-toggle-on fa-xl text-danger"></i></a>`);
                    }
                }
            ]
        });
    });

</script>