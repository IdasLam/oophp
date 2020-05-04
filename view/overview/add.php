<?php
// Get essentials
namespace Anax\View;

?>
<h1>Add content</h1>
<?php if ($matchedSlug === true) : ?>
    <p><mark>Slug or path already exists in table.</mark></p>
<?php endif; ?>
<form action="" method="post" class="search-bar-movie">
    <label for="title">Title</label>
    <input type="text" name="title" placeholder="Smulpaj" required>
    <br>
    <label for="path">Path</label>
    <input type="test" name="path" placeholder="blogpost-4">
    <br>
    <label for="slug">Slug</label>
    <input type="test" name="slug" placeholder="smulpaj" required>
    <br>
    <label for="type">type</label>
    <select name="type" name="type" required>
        <option value="page">page</option>
        <option value="post">post</option>
    </select>
    <br>
    <label for="textfilter">Textfilter</label>
    <input type="test" name="textfilter" placeholder="link" required>
    <p>Options: bbcode, link, markdown, nl2br. (comma seperated)</p>
    <br>
    <label for="data">Data</label>
    <input type="textarea" name="data">
    <br>
    <button>Add</button>
</form>
