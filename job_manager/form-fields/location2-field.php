<?php global $municipality; ?>
<select name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>" id="<?php echo esc_attr( $key ); ?>" <?php if ( ! empty( $field['required'] ) ) echo 'required'; ?> class="selectable">
	<?php foreach ( $municipality as $name ) : ?>
		<option value="<?php echo $name[0]; ?>" class="<?php echo $name[1]; ?>"<?php if( isset($field['value']) && $name[0] == $field['value']) echo ' selected'; ?>><?php echo $name[0]; ?></option>
	<?php endforeach; ?>
</select>
<?php if ( ! empty( $field['description'] ) ) : ?><small class="description"><?php echo $field['description']; ?></small><?php endif; ?>
