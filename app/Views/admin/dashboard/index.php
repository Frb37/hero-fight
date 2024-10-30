<?php
/*var_dump($user->id, $user->username, $user->email);
*/?>

<div class="card">
    <div class="card-header">
      <h1> Bienvenue, <?= isset($user)? $user->username: 'invité'; ?> ! </h1>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-8">
        </div>
        <div class="col-4">

        </div>
    </div>
</div>