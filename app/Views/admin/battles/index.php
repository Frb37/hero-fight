<div class="card">
    <div class="card-header">
        <h1> Bienvenue, <?= isset($user)? $user->username: 'invité'; ?> ! </h1>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card mt-4">
            <div class="card-header">
                <h2> Voici la liste des combats déjà menés </h2>
            </div>
            <div class="card-body">
                <table id="tableBattles" class="table table-hover">
                    <thead>
                    <tr>
                        <th>1er opposant</th>
                        <th>2e opposant</th>
                        <th>Gagnant</th>
                        <th>Perdant</th>
                        <th>Date</th>
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
                {"data": "character1_name"},
                {"data": "character2_name"},
                {"data": "winner_name"},
                {"data": "loser_name"},
                {"data": "date"},
            ]
        });
    });

</script>

