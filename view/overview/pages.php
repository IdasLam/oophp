<?php
// Get essentials
namespace Anax\View;

// var_dump($resultset);
?>
<?php if ($page === "index") : ?>
<a href="../overview">Back</a>
<h1>All pages</h1>
<table>
    <tr>
        <th>id</th>
        <th>Title</th>
        <th>Filter</th>
        <th>Path</th>
        <th>Slug</th>
    </tr>
    <?php foreach($resultset as $row) : ?>
        <tr>
            <td><?= $row->id ?></td>

            <?php if ($row->path != "") : ?>
                <td><a href="route?page=<?= $row->path ?>&id=<?= $row->id ?>"><?= $row->title ?></a></td>
            <?php else : ?>
                <td><a href="route?page=<?= $row->slug ?>&id=<?= $row->id ?>"><?= $row->title ?></a></td>
            <?php endif; ?>

            <td><?= $row->filter ?></td>
            <td><?= $row->path ?></td>
            <td><?= $row->slug ?></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <th></th>
        <td><a href="route?page=blog">Blog</a></td>
        <th></th>
        <th></th>
        <th></th>
    </tr>
</table>
<?php elseif ($page === "blog") : ?>
    <?php if ($path === null) : ?>
    <a href="../overview">Back</a>
    <h1>Blog</h1>
    <?php foreach($resultset as $row) : ?>
        <h2><?= $row->title ?></h2>
        <p>Published: <?= $row->published ?></p>
        <a href="route?page=blog&path=<?= $row->slug ?>">Read more</a>
    <?php endforeach; ?>
    <?php else : ?>
    <a href="../overview/route?page=blog">Back</a>
    <h1><?= $resultset->title ?></h1>
    <p>Published: <?= $resultset->published ?></p>
    <p>Using filters: <mark><?= $resultset->filter ?></mark></p>
    <?= $data ?>
    <?php endif; ?>
<?php else : ?>
<a href="../overview">Back</a>
<h1><?= $resultset->title ?></h1>
<p>Using filters: <mark><?= $resultset->filter ?></mark></p>
<?= $data ?>
<?php endif; ?>

