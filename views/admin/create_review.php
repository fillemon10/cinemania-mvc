    <?php $this->title = "Create Review" ?>

    <div class="container mt-20">

        <!-- Middle form - to create and edit  -->
        <div class="action create-review-div">
            <h2>Create/Edit Review</h2>

            <form method="post" enctype="multipart/form-data" action="">
                <!-- validation errors for the form -->

                <!-- if editing review, the id is required to identify that review -->
                <?php if ($isEditingReview === true) : ?>
                    <input type="hidden" name="review_id" value="<?php echo $review_id; ?>">
                <?php endif ?>
                <label class="mt-10" for="title">Title</label>
                <input class="form-control mb-10" type="text" name="title" value="<?php echo $title; ?>" placeholder="Title">
                <label for="imdb_id">IMDb ID</label>
                <input class="form-control mb-10" type="text" name="imdb_id" value="<?php echo $imdb_id; ?>" placeholder="IMDb ID">
                <label for="our_rating">Cinemania Rating</label>
                <select class="form-select  mb-10" name="our_rating" i>
                    <option selected value="<?php echo $our_rating; ?>"><?php echo $our_rating; ?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>

                </select>
                <label for="body">Body</label>
                <textarea class="form-control" name="body" id="body" cols="30" rows="10"><?php echo $body; ?></textarea>

                <!-- if editing review, display the update button instead of create button -->
                <?php if ($isEditingReview === true) : ?>
                    <button type="submit" class="btn btn-primary mt-20 float-right" name="update_review">Update Review</button>
                <?php else : ?>
                    <button type="submit" class="btn btn-primary mt-20 float-right" name="create_review">Create Review</button>
                <?php endif ?>

            </form>
        </div>
        <!-- // Middle form - to create and edit -->

    </div>
<script>
	ClassicEditor
		.create(document.querySelector('#body'))
		.catch(error => {
			console.error(error);
		});
</script>
