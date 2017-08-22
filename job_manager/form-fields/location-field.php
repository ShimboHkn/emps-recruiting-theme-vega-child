<?php global $pref; ?>
<select name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>" id="<?php echo esc_attr( $key ); ?>" <?php if ( ! empty( $field['required'] ) ) echo 'required'; ?> class="selectable">
	<?php foreach ( $pref as $prefname ) : ?>
		<option value="<?php echo $prefname[0]; ?>" title="<?php echo $prefname[1]; ?>"<?php if(isset($field['value']) && $prefname[0] == $field['value']) echo ' selected'; ?>><?php echo $prefname[0]; ?></option>
	<?php endforeach; ?>
</select>
<?php if ( ! empty( $field['description'] ) ) : ?><small class="description"><?php echo $field['description']; ?></small><?php endif; ?>
