<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>User rights list</h4>
        <a href="/admin/userpermission/create"><i class="fa-solid fa-user-plus"></i></a>
    </div>
    <div class="card-body">
        <table id="tableUserPermissions" class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>slug</th>
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
        var dataTable = $('#tableUserPermissions').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "language": {
                url: '<?= base_url("/js/datatable/datatable-2.1.4-fr-FR.json") ?>',
            },
            "ajax": {
                "url": "<?= base_url('/admin/userpermission/SearchPermission'); ?>",
                "type": "POST"
            },
            "columns": [
                {"data": "id"},
                {"data": "name"},
                {"data": "slug"},
                {
                    data : 'id',
                    sortable : false,
                    render : function(data) {
                        return `<a href="/admin/userpermission/${data}"><i class="fa-solid fa-pencil"></i></a>`;
                    }
                },
                {
                    data : 'id',
                    sortable : false,
                    render : function(data) {
                        return `<a href="/admin/userpermission/delete/${data}"><i class="fa-solid fa-trash"></i></a>`;
                    }
                }
            ]
        });
    });

</script>