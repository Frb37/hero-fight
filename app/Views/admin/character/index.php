<div class="card">
    <div class="card-header">
        <h1> Bienvenue, <?= isset($user)? $user->username: 'invité'; ?> ! </h1>
        <h2> Voici la liste des personnages disponibles </h2>
    </div>
</div>
<div class="card mt-4">
    <div class="card-body">
        <table id="tableCharacters" class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Name</th>
                <th>Strength</th>
                <th>Constitution</th>
                <th>Agility</th>
                <th>Experience</th>
                <th>Level</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
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
                "url": "<?= base_url('/admin/characters/SearchCharacter'); ?>",
                "type": "POST",
                "dataSrc": function(response) {
                    console.log("Response Data:" + response);
                    return response.data;
                },
                "error": function(xhr, error, code) {
                    alert("An error occurred" + error);
                    console.log("Response code:" + code);
                    console.log("Response:" + xhr.responseText);
                }
            },
            "columns": [
                {"data": "id"},
                {"data": "username"},
                {"data": "name"},
                {"data": "strength"},
                {"data": "constitution"},
                {"data": "agility"},
                {"data": "experience"},
                {"data": "level"}
            ]
        });
    });

</script>
