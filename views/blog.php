<?php

/** @var $model \app\models\PostModel 
 * 
 * part($model, $element, $attribute, $class, $data)
*/

use app\core\blog\Post;
?>

<h1>Blog</h1>
<?php foreach ($posts as $post) : ?>
<br>
<?php echo $post->{'title'} ?>
<?php endforeach ?>
