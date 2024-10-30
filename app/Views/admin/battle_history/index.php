<div class="card">
    <div class="card-header">
        <h1> Bienvenue, <?= isset($user)? $user->username: 'invité'; ?> ! </h1>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card mt-4">
            <div class="card-header">
                <h2> Voici l'historique des combats et action de vos personnages </h2>
            </div>
            <div class="card-body">
                <table id="tableBattleHistory" class="table table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>User_id</th>
                        <th>Character_id</th>
                        <th>Action</th>
                        <th>Result</th>
                        <th>Timestamp</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
            </div>
        </div>
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
                {"data": "user_id"},
                {"data": "character_id"},
                {"data": "action"},
                {"data": "result"},
                {"data": "timestamp"},
            ]
        });
    });

</script>