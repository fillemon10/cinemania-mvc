<?php $this->title = "Manage Reviews" ?>

<div class="container mt-20">

        <!-- Display records from DB-->
        <div class="table-div">


            <?php if (empty($reviews)) : ?>
                <h1 style="text-align: center; margin-top: 20px;">No reviews in the database.</h1>
            <?php else : ?>
                <table class="table table-hover table-bordered">
                    <tr>
                        <thead>
                            <th>N</th>
                            <th>Author</th>

                            <th>Cinemania Rating</th>
                            <th>Title Of</th>
                            <th>Title</th>
                            <th>Views</th>
                            <th><small>Published</small></th>
                            <th><small>Edit</small></th>
                            <?php if (in_array($_SESSION['user']['role'], ["Admin"])) { ?>
                                <th><small>Delete</small></th>
                            <?php } ?>
                        </thead>
                    </tr>
                    <tbody>
                        <?php foreach ($reviews as $key => $review) : ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $review['author']; ?></td>
                                <td><?php echo $review['our_rating']; ?></td>
                                <td><?php echo $review['title_of']; ?></td>
                                <td>
                                    <a class="red" target="_blank" href="/review/<?php echo $review['slug'] ?>">
                                        <?php echo $review['title']; ?>
                                    </a>
                                </td>
                                <td><?php echo $review['views']; ?></td>
                                <td>
                                    <?php
                                    if ($review['published'] == true) : ?>
                                        <a class="publish  btn btn-success" href="/reviews?publish=<?php echo $review['id'] ?>">
                                            <i class="fas fa-check"></i> </a>
                                    <?php else : ?>
                                        <a class="unpublish btn btn-warning" href="/reviews?unpublish=<?php echo $review['id'] ?>">
                                            <i class="fas fa-times"></i> </a>
                                    <?php endif ?>
                                </td>
                                <td>
                                    <a class="edit btn btn-primary" href="/create_review?edit-review=<?php echo $review['id'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <?php if (in_array($_SESSION['user']['role'], ["Admin"])) { ?>
                                    <td>
                                        <a class="delete btn btn-danger" href="/create_review?delete-review=<?php echo $review['id'] ?>">
                                            <i class=" fas fa-trash"></i>
                                        </a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php endif ?>
        </div>
        <!-- // Display records from DB -->

    </div>
