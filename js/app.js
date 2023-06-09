document.addEventListener("DOMContentLoaded", e => {
	document.querySelectorAll(".dropdown-toggle.nav-link").forEach(i => {
		i.addEventListener("click", e => {
			const dmenu = e.currentTarget.parentNode.querySelector("ul.dropdown-menu");
			setTimeout(() => {
				if(dmenu.classList.contains("show")) {
					dmenu.classList.remove("show");
				}else {
					dmenu.classList.add("show");
				}
			}, 50);
		});
	})

	document.addEventListener(
		"click", 
		e => document.querySelectorAll(".dropdown-menu.show").forEach(i => i.classList.remove("show"))
	);

	document.querySelectorAll(`[data-toggle="dropdown"]`).forEach(i => i.addEventListener("click", e => e.preventDefault()))

	jQuery('.add-to-cart').click(function(e) {
    e.preventDefault();
    var product_id = jQuery(this).data('product_id');
  	const btn = this;
  	let data = {
      'action': 'woocommerce_add_to_cart',
      'product_id': product_id,
    };
  	if(btn.classList.contains("already")){
  		// Заглушка 
  		return false;

  		data = {
        'action': 'woocommerce_remove_cart_item',
      	'product_id': product_id,
      	'quantity': 10,
        'cart_item_key': btn.getAttribute("data-cart_item_key")
      }
  		btn.classList.remove("already");
  	} else {
			btn.classList.add("already");
  	}

    jQuery.ajax({
      url: wc_add_to_cart_params.ajax_url,
      type: 'POST',
      data: data,
      success: function(response) {
      	const cont = document.createElement("DIV");
      	cont.innerHTML = response.fragments["div.widget_shopping_cart_content"];
      	const cart_item_key = cont.querySelector("a[data-cart_item_key]").getAttribute("data-cart_item_key");
      	jQuery(btn).attr("data-cart_item_key", cart_item_key);
        console.log(`${product_id} was added to cart`)
        cart_btn_control();
      },
      error: function(error) {
  			if(btn.classList.contains("already")){
		  		btn.classList.remove("already");
		  	} else {
					btn.classList.add("already");
		  	}
        console.error(`ID${product_id} Operation err`)
      }
    });
	});

	refreshCartBtnByRemoveBtn();
	cart_btn_control();
});

function refreshCartBtnByRemoveBtn() {
	document.querySelectorAll(".product-remove .remove").forEach(i => i.addEventListener(
		"click", 
		e => setTimeout(() => {
			refreshCartBtnByRemoveBtn();
			cart_btn_control();
		}, 2000)
	))
}

function cart_btn_control() {
	jQuery.ajax({
    type: 'POST',
    url: '/wp-admin/admin-ajax.php',
    data: {
      action: 'get_cart_contents'
    },
    success: function (data) {
    	data = JSON.parse(data);
    	const total = typeof data == "object" ? Object.keys(data).length : 0;
    	const cartBtn = document.querySelector(".go-cart-btn");
    	if(total) {
				cartBtn.querySelector(".counter").innerHTML = total > 9 ? "9+" : total;
				cartBtn.classList.add("show");
    	} else {
				cartBtn.classList.remove("show");
    	}
    },
    error: function (error) {
      console.log(error);
    }
	});
}