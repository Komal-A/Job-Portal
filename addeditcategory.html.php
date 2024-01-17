<form action="/Category/edit" method="POST">
    <input type="hidden" name="cats[id]" value="<?= $cats->id ?? '' ?>" />

    <label for="Name">Add Category:</label>
    <textarea id="name" name="cats[name]" rows="3" cols="40"><?= $cats->name ?? '' ?></textarea>

    <input type="submit" name="addEdit_cats" value="Add">
</form>