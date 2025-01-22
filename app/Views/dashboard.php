<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

    <div>
        <p>Welcome User | <a href="/logout">Logout</a></p>
    </div>

    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($userdata as $row): ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['firstname']; ?></td>
                        <td><?= $row['lastname']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td>
                            <a href="/editUser/<?= $row['id']; ?>">Edit</a> |
                            <a href="/deleteUser/<?= $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
