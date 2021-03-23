<?php $this->title = "Manage Users" ?>
<div class="container">

            <!-- Middle form - to create and edit  -->
            <div class="action mt-20">
                <div class="container">
                    <h2 class="page-title">Create/Edit Admin User</h2>
                    <div class="row">
                        <div class="col">
                            <form method="post" action="">


                                <!-- if editing user, the id is required to identify that user -->
                                <?php if ($isEditingUser === true) : ?>
                                    <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
                                <?php endif ?>
                                <label for="username">Username</label>
                                <input class="form-control mb-10" type="text" name="username" value="<?php echo $username; ?>" placeholder="Username">
                                <label for="email">Email</label>
                                <input class="form-control mb-10" type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
                                <label for="password">Password</label>
                                <input class="form-control mb-10" type="password" name="password" placeholder="Password">
                                <label for="passwordConfirmation">Password confirmation</label>
                                <input class="form-control mb-20" type="password" name="passwordConfirmation" placeholder="Password confirmation">

                                <select class="form-select mb-20 " name="role">
                                    <option value="" selected disabled>Assign role</option>
                                    <?php foreach ($roles as $role) : ?>
                                        <option value="<?php echo $role; ?>">
                                            <?php echo $role; ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>

                                <!-- if editing user, display the update button instead of create button -->
                                <?php if ($isEditingUser === true) : ?>
                                    <button type="submit" class="btn btn-primary float-right" name="update_admin">UPDATE</button>
                                <?php else : ?>
                                    <button type="submit" class="btn btn-primary float-right" name="create_admin">Save User</button>
                                <?php endif ?>

                            </form>
                        </div>
                        <div class="col">

                            <?php if (empty($admins)) : ?>
                                <h1>No admins in the database.</h1>
                            <?php else : ?>
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <th>#</th>
                                        <th>Admin</th>
                                        <th>Role</th>
                                        <th>Edit</th>
                                        <th>Delete</th>

                                    </thead>
                                    <tbody>
                                        <?php foreach ($admins as $key => $admin) : ?>
                                            <tr>
                                                <td><?php echo $key + 1; ?></td>
                                                <td>
                                                    <?php echo $admin['username']; ?>, &nbsp;
                                                    <?php echo $admin['email']; ?>
                                                </td>
                                                <td><?php echo $admin['role']; ?></td>
                                                <td>
                                                    <a class="btn btn-primary edit" href="<?php  ?>/users?edit-admin=<?php echo $admin['id'] ?>">
                                                        <i class="fas fa-edit"></i>

                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-danger delete" href="<?php  ?>/users?delete-admin=<?php echo $admin['id'] ?>">
                                                        <i class="fas fa-trash"></i>

                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // Middle form - to create and edit -->
        </div>
