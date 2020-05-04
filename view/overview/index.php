<?php
// Get essentials
namespace Anax\View;

// var_dump($resultset);
?>
<a href="overview/route?page=index">Pages</a>
<?php if ($slug === true) : ?>
    <p><mark>Could not edit, same slug or path already exist.</mark></p>
<?php endif; ?>

<form  method="post">
    <input type="submit" name="add" value="Add new content">
</form>
<table>
<tr>
    <th>id</th>
    <th>path</th>
    <th>slug</th>
    <th>title</th>
    <th>Published</th>
    <th>Created</th>
    <th>Updated</th>
    <th>Deleted</th>
    <th>Type</th>
</tr>
<?php foreach($resultset as $row) : ?>
<tr>
    <td><?= $row->id ?></td>
    <td><?= $row->path ?></td>
    <td><?= $row->slug ?></td>
    <td><?= $row->title ?></td>
    <td><?= $row->published ?></td>
    <td><?= $row->created ?></td>
    <td><?= $row->updated ?></td>
    <td><?= $row->deleted ?></td>
    <td><?= $row->type ?></td>
    <td>
        <form method="post">
            <input type="hidden" name="id" value=<?= $row->id ?>>
            <input type="submit" name="edit" value="Edit">
        </form>
    </td>
</tr>
<?php endforeach; ?>
</table>
