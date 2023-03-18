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
