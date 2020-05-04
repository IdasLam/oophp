<?php
// Get essentials
namespace Anax\View;

// var_dump($data["resultset"]);

?>
<?php foreach ($resultset as $row) :?>
<h1>Edit content: <?= $row->title ?></h1>
    <form action="" method="post" class="search-bar-movie">
        <input type="hidden" name="id" value="<?= $row->id ?>">
        <label for="title">Title</label>
        <input type="text" name="title" value="<?= $row->title ?>">
        <br>
        <label for="path">Path</label>
        <input type="text" name="path" value="<?= $row->path ?>">
        <br>
        <label for="slug">Slug</label>
        <input type="text" name="slug" value="<?= $row->slug ?>">
        <br>
        <label for="data">Data</label>
        <input type="text" name="data" value="<?= $row->data ?>">
        <br>

        <input type="submit" name="edit" value="Edit">
        <input type="submit" name="remove" value="Remove movie" style="background-color: #ff7979">
    </form>
<?php endforeach; ?>
