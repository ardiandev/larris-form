<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

$inputHeight = $attributes["inputHeight"]

?>
<div <?php echo get_block_wrapper_attributes(); ?>>
	<form action="">
		<ul>
			<li>
				<label for="yourname">Your Name</label>
				<input style="height: <?php echo esc_attr($inputHeight); ?>" value="" type="text" id='yourname' name="yourname" />
			</li>
		</ul>
	</form>
</div>
