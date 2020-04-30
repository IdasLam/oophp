<?php
// Get essentials
namespace Anax\View;

// var_dump($data["resultset"]);

?>
<?php foreach ($resultset as $row) :?>
<h1>Edit movie: <?= $row->title ?></h1>
    <form action="" method="post" class="search-bar-movie">
        <input type="hidden" name="id" value="<?= $row->id ?>">
        <label for="title">Title</label>
        <input type="text" name="title" value="<?= $row->title ?>">
        <label for="Year">Year</label>
        <input type="text" name="year" value="<?= $row->year ?>">
        <input type="submit" name="edit" value="Edit">
        <input type="submit" name="remove" value="Remove movie">
    </form>
<?php endforeach; ?>
