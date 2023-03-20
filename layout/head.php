<!DOCTYPE html>
<html <? language_attributes(); ?>>
<head>
	<meta charset="<? bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="/wp-content/themes/morkvynka/images/logo-fav.png" />
	<? wp_head(); ?>
	<script>
		if(document.location.pathname.indexOf("shop/") !== -1) {
			document.location = "/products/";
		}
	</script>	
</head>
<body <? body_class(); ?>>
	<? get_header(); ?>