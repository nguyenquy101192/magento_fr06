var $j = jQuery.noConflict();

jQuery(document).ready(function ($) {
    $j(function () {
        var click_event  = 1; //to know filter by ajax
        var brand        = new Array(); // get list brand to filter
        var color        = new Array(); // get color to filter
        var size         = 0; //get size to filter
        var current_url  = $j('#current-url').val(); // get current page
        var number_brand = $j('#number-brand').val(); // get total of list brand in current category
        var number_color = $j('#number-color').val(); // get total of list color in current category
        var loading_data = $j('#loading-data').val(); // get url of image when waiting for loading data by ajax
        var min_price    = parseInt($j('#min-price').val()); // get minimum price of products in current category
        var max_price    = parseInt($j('#max-price').val()) + 1; // get maximum price of products in current category
        var step_price   = 2//parseInt($j('#step-price').val()); // get step-price (auto change by minimum price and maximum price of current category)
        var low_price    = '';
        var height_price = '';
        if(number_brand > number_color) {
            var total = number_brand;
        } else {
            var total = number_color;
        }




        /*
                 *  filter checkbox brand
                 */
        for (var number = 0; number < total; number++) {
            $j("input#brand" + number).click(function () {
                if ($j(this).is(':checked')) {
                    brand.push(this.value);
                }
                else {
                    var removeItems = this.value;
                    brand = $j.grep(brand, function (value) {
                        return value != removeItems;
                    });
                }

                //get low price and heigh price
                low_price = $j("#slider-range").slider('values', 0);
                if (low_price == min_price) {
                    low_price = '';
                }
                height_price = $j("#slider-range").slider('values', 1);
                if (height_price == max_price) {
                    height_price = '';
                }

                // add image loading before send ajax
                $j('.category-products').empty();
                $j('.category-products').html("<img src=" + loading_data + " style='position: absolute; top: 200px; left: 50%;'>");

                $j.ajax({
                    url: current_url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'brand': brand,
                        'color': color,
                        'size': size,
                        'low_price': low_price,
                        'height_price': height_price,
                        'click': click_event
                    },
                    success: function (data) {
                        if (data.listproducts) {
                            $j('.category-products').empty();
                            $j('.category-products').html(data.listproducts);
                        }
                        if (data.state) {
                            $j('#filter-state').empty();
                            $j('#filter-state').html(data.state);
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });
        }


        /*
         *   filter click color
         */
        for (var number = 0; number < total; number++) {
            $j("button#color" + number).click(function () {
                // get value select
                size = $j('#select-size').val();

                // get value color
                if($j(this).attr('status')=='checked') {
                    var removeItems = this.value;
                    color = $j.grep(color, function (value) {
                        return value != removeItems;
                    });
                    $j(this).attr('status', 'unchecked').css('border', '1px solid #fff');
                } else {
                    color.push($j(this).val());
                    $j(this).attr('status', 'checked').css('border', '3px solid blue').css('opacity', '0.8');
                }

                //get low price and heigh price
                low_price = $j("#slider-range").slider('values', 0);
                if (low_price == min_price) {
                    low_price = '';
                }
                height_price = $j("#slider-range").slider('values', 1);
                if (height_price == max_price) {
                    height_price = '';
                }

                // add image loading before send ajax
                $j('.category-products').empty();
                $j('.category-products').html("<img src=" + loading_data + " style='position: absolute; top: 200px; left: 50%;'>");

                $.ajax({
                    url: current_url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'brand': brand,
                        'color': color,
                        'size': size,
                        'low_price': low_price,
                        'height_price': height_price,
                        'click': click_event
                    },
                    success: function (data) {
                        if (data.listproducts) {
                            $j('.category-products').empty();
                            $j('.category-products').html(data.listproducts);
                        }
                        if (data.state) {
                            $j('#filter-state').empty();
                            $j('#filter-state').html(data.state);
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });
        }


        /*
         *   filter select size
         */
        $j("#select-size").change(function () {
            // get value select
            size = $j('#select-size').val();

            //get low price and heigh price
            low_price = $j("#slider-range").slider('values', 0);
            if (low_price == min_price) {
                low_price = '';
            }
            height_price = $j("#slider-range").slider('values', 1);
            if (height_price == max_price) {
                height_price = '';
            }

            // add image loading before send ajax
            $j('.category-products').empty();
            $j('.category-products').html("<img src=" + loading_data + " style='position: absolute; top: 200px; left: 50%;'>");

            $j.ajax({
                url: current_url,
                type: 'POST',
                dataType: 'json',
                data: {
                    'brand': brand,
                    'color': color,
                    'size': size,
                    'low_price': low_price,
                    'height_price': height_price,
                    'click': click_event
                },
                success: function (data) {
                    if (data.listproducts) {
                        $j('.category-products').empty();
                        $j('.category-products').html(data.listproducts);
                    }
                    if (data.state) {
                        $j('#filter-state').empty();
                        $j('#filter-state').html(data.state);
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });


        /*
         *
         *   filter by price
         *
         */
        $j("#slider-range").slider({
            range: true,
            min: min_price,
            max: max_price,
            step: step_price,
            values: [ min_price, max_price ],
            slide: function (event, ui) {
                $j("#amount").val("$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ]);
            },
            change: function (event, ui) {
                low_price = ui.values[0];
                height_price = ui.values[1];

                // add image loading before send ajax
                $j('.category-products').empty();
                $j('.category-products').html("<img src=" + loading_data + " style='position: absolute; top: 200px; left: 50%;'>");

                $j.ajax({
                    url: current_url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'brand': brand,
                        'color': color,
                        'size': size,
                        'low_price': low_price,
                        'height_price': height_price,
                        'click': click_event
                    },
                    success: function (data) {
                        if (data.listproducts) {
                            $j('.category-products').empty();
                            $j('.category-products').html(data.listproducts);
                        }
                        if (data.state) {
                            $j('#filter-state').empty();
                            $j('#filter-state').html(data.state);
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
        });

        /*
         *
         *   display amount price
         *
         */
        $j("#amount").val("$" + $j("#slider-range").slider("values", 0) + " - $" + $j("#slider-range").slider("values", 1));
    });
});