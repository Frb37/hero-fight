<?php
/*var_dump($user->id, $user->username, $user->email);
*/?>

<div class="card">
    <div class="card-header">
      <h1> Bienvenue, <?= isset($user)? $user->username: 'invité'; ?> ! </h1>
    </div>
</div>