<?
function print_structure($data, $indent = 0) {
	if (is_array($data)) {
		foreach ($data as $key => $value) {
			$type = gettype($value);
			echo(
				str_repeat("&nbsp;&nbsp;", $indent) . 
				"[<span class='dd-key'>{$key}</span>] <span class='dd-sep'>=></span> "
			);
			print_structure($value, $indent + 1);
		}
	} elseif (is_object($data)) {
		$props = get_object_vars($data);
		foreach ($props as $key => $value) {
			echo(
				str_repeat("&nbsp;&nbsp;", $indent) . 
				"\n<span class='dd-sep'>-></span> <span class='dd-key'>{$key}</span> <span class='dd-sep'>=></span> "
			);
			print_structure($value, $indent + 1);
		}
	} else {
		$type = gettype($data);
		if($type == "boolean"){
			$data = $data ? "true" : "false";
		}
		echo "<span class='dd-type'>{$type}</span> <span class='dd-val'>{{$data}}</span><br>";
	}
}

function dd($array) {
	echo '
		<style>
			.dd-code {
				background: #ccc;
				color: #111;
				padding: 10px;
			}

			.dd-sep {
				font-weight: bold;
			}

			.dd-key {
				color: #088;
			}

			.dd-type {
				color: #05f;
				text-transform: uppercase;
			}

			.dd-val {
				color: #333;
			}
		</style>
	';
	echo '<pre class="dd-code">';
	print_structure($array);
	echo '</pre>';
	die();
}

function get_product_attrs($product) {
	$product_attributes = array();

	// Display weight and dimensions before attribute list.
	$display_dimensions = apply_filters( 'wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions() );

	if ( $display_dimensions && $product->has_weight() ) {
		$product_attributes['weight'] = array(
			'label' => __( 'Weight', 'woocommerce' ),
			'value' => wc_format_weight( $product->get_weight() ),
		);
	}

	if ( $display_dimensions && $product->has_dimensions() ) {
		$product_attributes['dimensions'] = array(
			'label' => __( 'Dimensions', 'woocommerce' ),
			'value' => wc_format_dimensions( $product->get_dimensions( false ) ),
		);
	}

	// Add product attributes to list.
	$attributes = array_filter( $product->get_attributes(), 'wc_attributes_array_filter_visible' );

	foreach ( $attributes as $attribute ) {
		$values = array();

		if ( $attribute->is_taxonomy() ) {
			$attribute_taxonomy = $attribute->get_taxonomy_object();
			$attribute_values   = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );

			foreach ( $attribute_values as $attribute_value ) {
				$value_name = esc_html( $attribute_value->name );

				if ( $attribute_taxonomy->attribute_public ) {
					$values[] = [
						"url" => esc_url( get_term_link( $attribute_value->term_id, $attribute->get_name() ) ),
						"value" => $value_name
					];
				} else {
					$values[] = [
						"value" => $value_name
					];
				}
			}
		} else {
			$values = $attribute->get_options();

			foreach ( $values as &$value ) {
				$value = make_clickable( esc_html( $value ) );
			}
		}

		$product_attributes[ 'attribute_' . sanitize_title_with_dashes( $attribute->get_name() ) ] = array(
			'label' => wc_attribute_label( $attribute->get_name() ),
			'value' => $values
		);
	}

	$product_attributes = apply_filters( 'woocommerce_display_product_attributes', $product_attributes, $product );

	// die(print_r($product_attributes));
	return $product_attributes;
}