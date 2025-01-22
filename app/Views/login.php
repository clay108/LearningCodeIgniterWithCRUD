<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="/login" method="post">
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" id="email" name="email" required>

            <?php if (isset($validation) && $validation->getError('email')): ?>
                <div class="text-danger">
                    <?= $validation->getError('email') ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" name="password" required>

            <?php if (isset($validation) && $validation->getError('password')): ?>
                <div class="text-danger">
                    <?= $validation->getError('password') ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="checkbox">
            <a href="/signup">Sign up</a>
        </div>
        <button type="submit" class="btn btn-default">Login</button>
    </form>
</body>

</html>