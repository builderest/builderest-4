<section class="admin-header">
    <div>
        <h1>Users</h1>
        <p>Manage admin and editor access.</p>
    </div>
    <a class="btn btn-primary" href="/admin/users/create">Add user</a>
</section>
<section class="admin-section">
    <div class="table">
        <div class="table-row table-head">
            <div>Name</div>
            <div>Email</div>
            <div>Role</div>
            <div>Actions</div>
        </div>
        <?php foreach ($users as $user): ?>
            <div class="table-row">
                <div><?php echo htmlspecialchars($user['name']); ?></div>
                <div><?php echo htmlspecialchars($user['email']); ?></div>
                <div><?php echo htmlspecialchars(ucfirst($user['role'])); ?></div>
                <div class="table-actions">
                    <a class="btn btn-link" href="/admin/users/<?php echo $user['id']; ?>/edit">Edit</a>
                    <form method="post" action="/admin/users/<?php echo $user['id']; ?>/delete" onsubmit="return confirm('Delete this user?');">
                        <button type="submit" class="btn btn-link danger">Delete</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
