<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>User rights list</h4>
        <a href="/admin/userpermission/create"><i class="fa-solid fa-user-plus"></i></a>
    </div>
    <div class="card-body">
        <table id="tableUserPermissions" class="table table-hover">
            <thead>
                <th>ID</th>
                <th>name</th>
                <th>slug</th>
            </thead>
            <tbody>
                <?php foreach($all_perms as $p): ?>
                <tr>
                    <td><?= $p['id']; ?></td>
                    <td><?= $p['name']; ?></td>
                    <td><?= $p['slug']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>