<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>

<body>

    <!-- Display validation errors if available -->
    <?php if (isset($validation)): ?>
        <div class="col-12">
            <div class="alert alert-danger" role="alert">
                <?= $validation->listErrors() ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Signup form -->
    <form action="/signup" method="post">
        <div class="form-group">
            <label for="firstname">First Name:</label>
            <input type="text" class="form-control" name="firstname" value="<?= set_value('firstname') ?>">
            <!-- Display individual validation error for this field -->
            <?php if (isset($validation) && $validation->getError('firstname')): ?>
                <div class="text-danger">
                    <?= $validation->getError('firstname') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="lastname">Last Name:</label>
            <input type="text" class="form-control" name="lastname" value="<?= set_value('lastname') ?>">
            <!-- Display individual validation error for this field -->
            <?php if (isset($validation) && $validation->getError('lastname')): ?>
                <div class="text-danger">
                    <?= $validation->getError('lastname') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="<?= set_value('email') ?>">
            <!-- Display individual validation error for this field -->
            <?php if (isset($validation) && $validation->getError('email')): ?>
                <div class="text-danger">
                    <?= $validation->getError('email') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" value="">
            <!-- Display individual validation error for this field -->
            <?php if (isset($validation) && $validation->getError('password')): ?>
                <div class="text-danger">
                    <?= $validation->getError('password') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="password_confirm">Confirm Password:</label>
            <input type="password" class="form-control" name="password_confirm" value="">
            <!-- Display individual validation error for this field -->
            <?php if (isset($validation) && $validation->getError('password_confirm')): ?>
                <div class="text-danger">
                    <?= $validation->getError('password_confirm') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="checkbox">
            <a href="login">
                <label> Sign In </label>
            </a>
        </div>

        <button type="submit" class="btn btn-default">Submit</button>
    </form>

</body>

</html>