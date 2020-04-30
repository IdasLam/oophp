<?php
// Get essentials
namespace Anax\View;

?>
<form action="" method="get" class="search-bar-movie">
    <input type="text" placeholder="Search title or year" name="search">
    <button>Search</button>
</form>
<table>
    <tr class="first">
        <th>Row</th>
        <th>Id</th>
        <th>Picture</th>
        <th>Title</th>
        <th>Year</th>
        <th></th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img class="thumb" src="img/movie/<?= $row->image ?>" width="200px"></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
        <td>
            <form action="" method="post">
                <input type="hidden" name="id" value=<?= $row->id ?>>
                <input type="submit" name="edit" value="Edit">
            </form>
        </td>
    </tr>
<?php endforeach; ?>
</table>
<form action="" method="post" class="search-bar-movie">
    <input type="submit" name="add" value="Add movie">
</form>
