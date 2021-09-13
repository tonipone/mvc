<?php $this->start('head'); ?>
	<!--    <script>alert("head content loaded")</script>-->
<?php $this->end(); ?>

<?php $this->start('content'); ?>
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2>Categories</h2>
        <a href="<?=ROOT?>admin/category/new" class="btn btn sm btn-primary">New Category</a>
    </div>
    <div class="poster">
        <table class="table table-hover table-stripped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->categories as $cat): ?>
                    <tr>
                        <td><?= $cat->id ?></td>
                        <td><?= $cat->name ?></td>
                        <td class="text-right">
                            <a href="<?= ROOT ?>admin/category/<?= $cat->id; ?>" class="btn btn-sm btn-info">Edit</a>
                            <button class="btn btn-sm btn-danger" onclick="confirmCategory('<?=$cat->id ?>')">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php $this->partial('partials/pager'); ?>
    </div>

    <script>
        function confirmCategory(catId){
            if(window.confirm("Are you sure you want to delete the Category? This cannot be undone!")){
                window.location.href = `<?=ROOT?>admin/deleteCategory/${catId}`;
            }
        }
    </script>

<?php $this->end(); ?>