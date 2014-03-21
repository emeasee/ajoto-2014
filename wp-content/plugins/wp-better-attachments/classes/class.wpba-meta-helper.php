<?php
class WPBA_Meta_Helper {

	public function make_form($args = array()){

	   /*
		*make_form() will cycle through your fields array, and create your form

		*Your fields array should look something like...
		*array(
		*	array(
		*		'label'	=> 'Field one',
		*		'desc'	=> 'helper text,
		*		'id'	=> 'fieldOneID',
		*		'type'	=> 'text'
		*	),
		*	array(
		*		'label'	=> 'Field Two',
		*		'desc'	=> 'helper text,
		*		'id'	=> 'fieldTwoID',
		*		'type'	=> 'text'
		*	)
		*)

		*And you can pass this array via	$args (e.g. $helper->make_form(array('meta_fields' => $fields_array);
		*/

		global $post;
		$meta_fields = isset($args['meta_fields']) ? $args['meta_fields'] : '';

		// get descriptive info
		foreach ($meta_fields as $field){
			if($field['type'] == 'info'){
				echo $field['desc'];
			}
		}

		// Use nonce for verification
		echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

		// Begin the field table and loop
		echo '<table class="form-table">';

		foreach ($meta_fields as $field) {
			// get value of this field if it exists for this post
			$meta = get_post_meta($post->ID, $field['id'], true);
			// begin a table row with
			echo '<tr>
			<th><label for="'. $field['id'] .'">'. $field['label'] .'</label></th>
				<td>';
				switch($field['type']) {

					// divider
					case 'divider':
						echo '<hr/>';
					break;

					// markup (pretty much anything goes)
					case 'markup':
						// will look for the desc key and display whatever it holds
						// this is for general markup needs... (e.g. if you need a button or image etc...)
						echo $field['desc'];
					break;

					// text
					case 'text':
						echo '<input type="text" name="'.esc_attr( $field['id'] ).'" id="'.esc_attr( $field['id'] ).'" value=\''.$meta.'\' size="30" />
						<br /><span class="description">'.esc_attr( $field['desc'] ).'</span>';
					break;

					// file
					case 'file':
						echo '<input type="text" name="'.esc_attr( $field['id'] ).'" id="'.esc_attr( $field['id'] ).'" value="'.$meta.'" size="30" />
						<a href="javascript:void(0);" class="upload-link-'.esc_attr( $field['id'] ).' button">upload</a>
						<br /><span class="description">'.esc_attr( $field['desc'] ).'</span>';
					break;

					// textarea
					case 'textarea':
						echo '<textarea name="'.esc_attr( $field['id'] ).'" id="'.esc_attr( $field['id'] ).'" cols="55" rows="4">'.$meta.'</textarea>
						<br /><span class="description">'.esc_attr( $field['desc'] ).'</span>';
					break;

					// checkbox
					case 'checkbox':
						echo '<input type="checkbox" name="'.esc_attr( $field['id'] ).'" id="'.esc_attr( $field['id'] ).'" ',$meta ? ' checked="checked"' : '','/>
						<label for="'.esc_attr( $field['id'] ).'">'.esc_attr( $field['desc'] ).'</label>';
					break;

					// select
					case 'select':
						echo '<select name="'.esc_attr( $field['id'] ).'" id="'.esc_attr( $field['id'] ).'">';
						foreach ($field['options'] as $option) {
							echo '<option', $meta == esc_attr( $option['value'] ) ? ' selected="selected"' : '', ' value="'.esc_attr( $option['value'] ).'">'.esc_attr( $option['label'] ).'</option>';
						}
						echo '</select><br /><span class="description">'.esc_attr( $field['desc'] ).'</span>';
					break;

					// chosen select (uses chosen jQuery plugin http://harvesthq.github.com/chosen/)
					case 'chosen_select':
						echo '<select name="'.esc_attr( $field['id'] ).'" id="'.esc_attr( $field['id'] ).'" class="chzn-select" style="width:200px;">';
						foreach ($field['options'] as $option) {
							echo '<option', $meta == esc_attr( $option['value'] ) ? ' selected="selected"' : '', ' value="'.esc_attr( $option['value'] ).'">'.esc_attr( $option['label'] ).'</option>';
						}
						echo '</select><br /><span class="description">'.esc_attr( $field['desc'] ).'</span>';
					break;

					//date (Uses jQuery UI datepicker widget with Smoothness theme http://jqueryui.com/datepicker/)
					case 'date':
						echo '<input type="text" class="datepicker" name="'.esc_attr( $field['id'] ).'" id="'.esc_attr( $field['id'] ).'" value="'.$meta.'" size="30" />
						<br /><span class="description">'.esc_attr( $field['desc'] ).'</span>';
					break;

					//line break
					case 'line':
						echo '</td></tr></table><hr/><table class="form-table">';
					break;

					//Title
					case 'title':
						echo '<div class="form-group-title">'.esc_attr( $field['label'] ).'</div>';
					break;

					case 'attachments':
						$args = array(
							'field'	=>	$field,
							'meta'	=>	$meta
						);
						echo $this->output_post_attachments( $args );
					break;
				} //end switch
				echo '</td></tr>';
			} // end foreach
			echo '</table>'; // end table

	}

	/**
	* Output Post Attachments
	*/
	protected function output_post_attachments( $args = array() )
	{
		extract( $args );
		return 'test';
	} // output_post_attachments()


	/**
	*	Save Custom Meta
	*/
	public function save_custom_meta($args = array())
	{

		/*
		 * save_custom_meta() will save your custom meta when the post is saved
		 * You should pass it the post_id and the meta fields in an array as an argument
		 * something like...
		 *	$meta_helper->save_custom_meta(array(
		 *		'post_id'				=> 12,
		 *		'custom_meta_fields'	=> $meta_fields_array
		 *	));
		 *
		 */


		$post_id 			= isset($args['post_id']) ? $args['post_id'] : '';
		$custom_meta_fields = isset($args['custom_meta_fields']) ? $args['custom_meta_fields'] : '';

		// verify nonce
		$mb_nonce = isset($_POST['custom_meta_box_nonce']) ? $_POST['custom_meta_box_nonce'] : '';
		if (!wp_verify_nonce($mb_nonce, basename(__FILE__)))
			return $post_id;

			// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return $post_id;

		// loop through fields and save the data
		foreach ($custom_meta_fields as $field) {
			$old = get_post_meta($post_id, esc_attr( $field['id'] ), true);
			$new = isset($_POST[esc_attr( $field['id'] )]) ? $_POST[esc_attr( $field['id'] )] : '';
			if ($new && $new != $old) {
				update_post_meta($post_id, esc_attr( $field['id'] ), $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, esc_attr( $field['id'] ), $old);
			}
		} // end foreach
	} // save_custom_meta()


	/**
	* Get Custom Meta
	*/
	public function get_custom_meta($args)
	{

		// this method is for use on the front end
		// it will iterated through the fields in the backend ->
		// then match those to fields that have content ->
		// then return an array of the custom meta ->

		// We need to look at all fields first to get the titles from them

		// initialize args
		$post_id 		= isset($args['post_id']) 		? $args['post_id'] : '';
		$meta_fields 	= isset($args['meta_fields']) 	? $args['meta_fields'] : '';

		// get possible available custom meta (see inc/custom-meta.php)
		$custom_meta_fields = $meta_fields;

		// get actual saved custom meta
		$custom_meta_data 	= get_post_custom($post_id);

		// create array of custom meta based on what's
		// available and whats been entered
		$actual_meta = array();

		// iterate through the available meta, adding data to our array
		// if it exists as saved meta
		foreach($custom_meta_fields as $meta_field){

			if(array_key_exists($meta_field['id'], $custom_meta_data)){
				$value = isset($custom_meta_data[ $meta_field['id'] ][0]) ? $custom_meta_data[ $meta_field['id'] ][0] : '';
				$visible = isset($meta_field['visible']) ? $meta_field['visible'] : true;
				$item = array(
					'id'		=> $meta_field['id'],
					'title'		=> $meta_field['label'],
					'value'		=> $value,
					'visible'	=> $visible
				);

				array_push($actual_meta, $item);

			} // end if

		} // end foreach

		return $actual_meta;
	} // get_custom_meta()


}