<div class="container">

    <!-- Battle character selection menu -->
    <div class="row">
        <div class="col-6">
            <select>
                <?php foreach($characters as $char): ?>
                    <option value=<?= $char['id']; ?>><?= $char['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-6">
            <select>
                <?php foreach($characters as $char): ?>
                    <option value=<?= $char['id']; ?>><?= $char['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <!-- Displays the successive rounds of the battle -->
    <div class="row">

    </div>
</div>

<!-- PHP calculation routines for displaying and updating in-battle params -->
<?php
/* Must be replaced with characters parsed by controller after calling CharacterModel */
$first_char = null;
$second_char = null;

function whogetsfirst($first_char, $second_char) {
    if ($first_char['agility'] > $second_char['agility']) {
        echo $first_char['name'] . "attacks" . $second_char['name'];
    } else if ($first_char['agility'] < $second_char['agility']) {
        echo $second_char['name'] . "attacks" . $first_char['name'];
    } else {
        $first = rand(1,2);
        if ($first == 1) {
            echo $first_char['name'] . "attacks" . $second_char['name'];
        } else {
            echo $second_char['name'] . "attacks" . $first_char['name'];
        }
    }
}

?>

<script>
    // Insert here JS script to add the "selected" value to the option in the second character choice slot
    // adding the 'disabled' keyword. For this, I need to retrieve the id selected in the first col (where
    // the value 'selected' is set in the option)
</script>