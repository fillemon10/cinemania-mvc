<?php $this->title = "Create Post" ?>

<div class="container mt-20">

		<!-- Middle form - to create and edit  -->
		<div class="action create-post-div">
			<h2>Create/Edit Post</h2>

			<form method="post" enctype="multipart/form-data" action="">
				<!-- if editing post, the id is required to identify that post -->
				<?php if ($isEditingPost === true) : ?>
					<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
				<?php endif ?>
				<label class="mt-10" for="title">Title</label>
				<input class="form-control mb-10" type="text" name="title" value="<?php echo $title; ?>" placeholder="Title">
				<label for="image">Image URL</label>
				<input class="form-control mb-10" type="text" name="image" value="<?php echo $image; ?>" placeholder="Image URL">
				<label for="body">Body</label>

				<textarea class="form-control " name="body" id="body" cols="30" rows="10"><?php echo $body; ?></textarea>

				<select class="form-select mb-20 mt-20" name="topic_id">
					<option value="" selected disabled>Choose topic</option>
					<?php foreach ($topics as $topic) : ?>
						<option value="<?php echo $topic['id']; ?>">
							<?php echo $topic['name']; ?>
						</option>
					<?php endforeach ?>
				</select>

				<!-- if editing post, display the update button instead of create button -->
				<?php if ($isEditingPost === true) : ?>
					<button type="submit" class="btn btn-primary float-right mb-20" name="update_post">Update Post</button>
				<?php else : ?>
					<button type="submit" class="btn btn-primary float-right mb-20" name="create_post">Create Post</button>
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
