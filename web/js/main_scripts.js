window.onload = function() {
    
    var gallery_blocks = document.querySelectorAll(".product-single__thumbnail-item");
   
    cartload();
    
    var metas =     document.getElementsByTagName("meta"),
        btn_ac    =  document.getElementById("AddToCart"),
        minus     =  document.querySelectorAll(".cart_minus"),
        plus      =  document.querySelectorAll(".cart_plus"),
        min_ac    =  document.querySelector(".add_to_cart_minus"), 
        pls_ac    =  document.querySelector(".add_to_cart_plus"),
        quant_ac  =  document.getElementById("Quantity"),
        quant     =  document.querySelectorAll(".cart_update"),
        search    =  document.querySelector(".site-header__search-input"),
        search2   =  document.querySelector(".stick_search-header"),
        add_del   =  document.querySelectorAll(".delete_address"),
        add_sel   =  document.getElementById("checkout_shipping_address_id"),
        point_ch  =  document.getElementById("checkout_buyer_accepts_marketing"),
        del_0     =  document.getElementById("checkout_different_billing_address_false"),
        del_1     =  document.getElementById("checkout_different_billing_address_true"),
        del_bl    =  document.querySelector(".checkout_billing_block"),
        show_fil  =  document.getElementById("show_filter");
        gallery   =  document.querySelectorAll(".gallery-item"),
        s_country =  document.getElementById("checkout_shipping_address_country"),
        sticky_st =  document.querySelector('.sticky--active');

    if(sticky_st) {
        $("#search-results1").hide();
    }

    document.body.addEventListener("click", function(e){
        var elem = e.target;
        if(elem.classList.contains("javascript_no_hide")) {
            return false;
        } else {
            HideSearch();
        }
    });
    
    if(s_country) { 
        var data = {
            csrf   : s_country.getAttribute('data-csrf')
        };

        s_country.prototype = data;

        s_country.addEventListener("change", function(e) {
            SelectRegion(s_country.value, this.prototype.csrf);
        });   
    }
    
    if(gallery_blocks) {
        for(var i = 0; i < gallery_blocks.length; i++) {
            gallery_blocks[i].style.display = "block";
        }
    }
    
    if(gallery) { 
        for(var i = 0; i < gallery.length; i++) {
            
            gallery[i].prototype = {
                href : gallery[i].getAttribute("href")
            }
            
            gallery[i].addEventListener("click", function(e){
                var lnk  = document.getElementById("MainImageLink");
                var img  = document.querySelector(".ProductPhotoImg");
                
                lnk.href = this.prototype.href;
                img.src = this.prototype.href;
            });
        }
    }

    if(show_fil) {
        show_fil.addEventListener("click", function(){
            ShowFilter();
        });
    }

    if(del_0) {
        del_0.addEventListener("change", function(){
            if(del_0.checked) {
                del_bl.classList.add("hidden");
            }
        });
    }

    if(del_1) {
        del_1.addEventListener("change", function(){
            if(del_1.checked) {
                del_bl.classList.remove("hidden");
            }
        });
    }

    if(point_ch) {
        var data = {
            csrf : point_ch.getAttribute('data-csrf')
        };
        
        point_ch.prototype = data;
        
        point_ch.addEventListener("change", function(e){
            
            if(point_ch.checked) 
            {
                StartPoint(point_ch.prototype.csrf);
            }
            else 
            {
                ErasePoint(point_ch.prototype.csrf);
            }
            
        });
    }

    if(add_sel) {
        
        var data = {
            csrf : add_sel.getAttribute('data-csrf')
        };
        
        add_sel.prototype = data;
        
        add_sel.addEventListener("change", function(e){
            
            AddressChange(this.value, add_sel.prototype.csrf);
            
        });
    }

    if(add_del) {
        
        for(var i = 0; i < add_del.length; i++) { 
            var data = {
                add_id : add_del[i].getAttribute('data-id'),
                csrf   : add_del[i].getAttribute('data-csrf')
            };

            add_del[i].prototype = data;

            add_del[i].addEventListener("click", function(e) {
                DeleteAddress(this.prototype.add_id, this.prototype.csrf);
            });
         }   
    }

    if(min_ac) {
        min_ac.addEventListener("click", function(e){
            Minus_ac(quant_ac);
        });
    }
    
    if(pls_ac) {
        pls_ac.addEventListener("click", function(e){
            Plus_ac(quant_ac);
        });
    }
    
    if(search) {
        search.oninput = function(){
            if(!search2.classList.contains("site-header__search-input--visible"))
            {
                search2.classList.add("site-header__search-input--visible");
            }
            search2.value = search.value;
            AjaxSearch(search.value, search.getAttribute('data-csrf'));
        };
        search.onblur = function(e){
            console.log(e);
            //HideSearch();
        };
    }
    
    if(search2) {
        search2.oninput = function(){
            if(!search.classList.contains("site-header__search-input--visible"))
            {
                search.classList.add("site-header__search-input--visible");
            }
            search.value = search2.value;
            AjaxSearch(search2.value, search2.getAttribute('data-csrf'));
        };
        search2.onblur = function(e){
            console.log(e);
            //HideSearch();
        };
    }
    
    for(var i = 0; i < quant.length; i++) {
        var data = {
            cart_id : quant[i].getAttribute("data-temp-id"),
            csrf: quant[i].getAttribute("data-csrf")
        };
        
        quant[i].prototype = data;
        
        quant[i].addEventListener("change", function(e) {
            e.preventDefault;
            if(this.value == 0) {
                return Delete(this.prototype.cart_id, this.prototype.csrf);
            }
            if(this.value < 0) {
                this.value = 1;
            }
            if(this.value > 999) {
                this.value = 999;
            }
            this.value = parseInt(this.value, 10);
            return Change(this.value, this.prototype.cart_id, this.prototype.csrf);
        });
        
        quant[i].removeAttribute("data-temp-id");
    }
    
    for (var i = 0; i < minus.length; i++) {   
        
        minus[i].style.display = 'none';
        
        var data = {
            cart_id : minus[i].getAttribute("data-temp-id"),
            csrf: minus[i].getAttribute("data-csrf")
        };
        
        minus[i].prototype = data;
        
        minus[i].addEventListener("click", function(e) {
            return Minus(this.prototype.cart_id, this.prototype.csrf);
        });
        minus[i].removeAttribute("data-temp-id");
        minus[i].style.display = 'block';
    }
    
    for (var i = 0; i < plus.length; i++) {  
        
        plus[i].style.display = 'none';
        
        var data = {
            cart_id: plus[i].getAttribute("data-temp-id"),
            csrf: plus[i].getAttribute("data-csrf")
        };
        
        plus[i].prototype = data;
        
        plus[i].addEventListener("click", function(e) {
            return Plus(this.prototype.cart_id, this.prototype.csrf);
        });
        plus[i].removeAttribute("data-temp-id");
        plus[i].style.display = 'block';
    }
    
    if(btn_ac !== null) {
        var data = {
            csrf: btn_ac.getAttribute("data-csrf")
        };
        
        btn_ac.prototype = data;
        
        btn_ac.addEventListener("click", function(e){
            addToCart(this.prototype.csrf);
        });
    }
    
};

function addToCart(csrf) {
    var form  = document.getElementById("AddToCartForm");
    var hand  = form.getAttribute("data-handle");
    var count = document.getElementById("Quantity").value;
    
    /* jQuery Zone */
        
        $.ajax({
            type:'POST',
            url:'../ajax/addtocart',
            data:{
                'hand':hand,
                'csrf':csrf,
                'coun':count
            },
            dataType:'html',
            success: function(data) {
                if(data === '1') {
                    //alert(data);
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    cartload();
                    showMessage();
                }
                else {
                    //alert(data);
                    throw Error('Произошла ошибка ' + data);
                }
            }
        });
        
    /* End Of jQuery Zone */
};

function cartload() {

    var cart_el = document.getElementById("cartIndicatorAjax");
    if(cart_el) {
         var csrf = cart_el.getAttribute("data-csrf");
         var indi  = document.querySelector(".site-header__cart-indicator");
         var indi2 = document.querySelector(".sticky_indicator");
    }
    else {
        return false;
    }
    
    $.ajax({
        type: 'POST',
        url: '/ajax/cartload',
        data:{
            'csrf':csrf
        },
        dataType: 'html',
        cache: false,
        success: function(data) {
            if(data === '1') {
                indi.classList.remove("hide");
                indi2.classList.remove("hide");
            }
            else {
                indi.classList.add("hide");
                indi2.classList.add("hide");
            }
        }
    });
}

function showMessage() {
    var message = document.querySelector(".notification--success");
    message.classList.add("notification--active");
    
    setTimeout(closeMessage, 5000);
}

function closeMessage() {
    var message = document.querySelector(".notification--success");
    message.classList.remove("notification--active");
}

function Minus(id, csrf) {
    var inpt  = document.getElementById("CartUpdate_"+id);
    var count = inpt.value;
    
    if((inpt.value - 1) == 0) {
        return Delete(id, csrf);
    }
    if((inpt.value - 1) < 0) {
        inpt.value = 1;
    }
    
    /* jQuery */
    
        $.ajax({
            type:'POST',
            url:'/ajax/countminus',
            data:{
                'id':id,
                'count':count,
                'csrf':csrf
            },
            dataType: 'html',
            cache:false,
            beforeSend: function () {
                //$('#pre_loading').fadeIn(50);
            },
            success: function(data) {
                if(data === '1') {
                    window.location.reload();
                }
                else {
                    throw Error("Произошла ошибка " + data);
                }
            }
        });
    /* End of jQuery */
};

function Plus(id, csrf) {
    
    var inpt  = document.getElementById("CartUpdate_"+id);
    var count = inpt.value;
    
    if((inpt.value + 1) > 999) {
        inpt.value = 999;
    }
    
    /* jQuery */
    
        $.ajax({
            type:'POST',
            url:'/ajax/countplus',
            data:{
                'id':id,
                'count':count,
                'csrf':csrf
            },
            dataType: 'html',
            cache:false,
            beforeSend: function () {
                //$('#pre_loading').fadeIn(50);
            },
            success: function(data) {
                if(data === '1') {
                    window.location.reload();
                }
                else {
                    throw Error("Произошла ошибка " + data);
                }
            }
        });
    /* End of jQuery */  
};

function Change(val, id, csrf) {
    
    /* jQuery */
    
        $.ajax({
            type:'POST',
            url:'/ajax/countchange',
            data:{
                'id':id,
                'count':val,
                'csrf':csrf
            },
            dataType: 'html',
            cache:false,
            beforeSend: function () {
                //$('#pre_loading').fadeIn(50);
            },
            success: function(data) {
                if(data === '1') {
                    window.location.reload();
                }
                else {
                    throw Error("Произошла ошибка " + data);
                }
            }
        });
    /* End of jQuery */
}

function Delete(id, csrf) {
    
    /* jQuery */
    
        $.ajax({
            type:'POST',
            url:'/ajax/cartdelete',
            data:{
                'id':id,
                'csrf':csrf
            },
            dataType: 'html',
            cache:false,
            beforeSend: function () {
                //$('#pre_loading').fadeIn(50);
            },
            success: function(data) {
                if(data === '1') {
                    window.location.reload();
                }
                else {
                    throw Error("Произошла ошибка " + data);
                }
            }
        });
    /* End of jQuery */
}

function Minus_ac(e) {
    e.value--;
    if(e.value < 1) {
        e.value = 1;
    }
};

function Plus_ac(e) {
    e.value++;
    if(e.value > 99) {
        e.value = 99;
    }
};

function DeleteAddress(id, csrf) {
    var status = confirm("Вы уверены, что хотите удалить этот адрес?");
    
    if(!status)
    {
        return false;
    }
    
    /* jQuery */
    
        $.ajax({
            type:'POST',
            url:'/ajax/addressdelete',
            data:{
                'id':id,
                'csrf':csrf
            },
            dataType: 'html',
            cache:false,
            beforeSend: function () {
                //$('#pre_loading').fadeIn(50);
            },
            success: function(data) {
                if(data === '1') {
                    window.location.reload();
                }
                else {
                    throw Error("Произошла ошибка " + data);
                }
            }
        });
        
    /* End of jQuery */
}

function AddressChange(id, csrf) {
    
    var nodeName     = document.getElementById("checkout_shipping_address_first_name"),
        nodeLastName = document.getElementById("checkout_shipping_address_last_name"),
        nodeCompany  = document.getElementById("checkout_shipping_address_company"),
        nodeAddress  = document.getElementById("checkout_shipping_address_address1"),
        nodeFlat     = document.getElementById("checkout_shipping_address_address2"),
        nodeCity     = document.getElementById("checkout_shipping_address_city"),
        nodeIndex    = document.getElementById("checkout_shipping_address_zip"),
        nodePhone    = document.getElementById("checkout_shipping_address_phone");
    
    if(id === '0')
    {
        nodeName.value = "";
        nodeLastName.value = "";
        nodeCompany.value = "";
        nodeAddress.value = "";
        nodeFlat.value = "";
        nodeCity.value = "";
        nodeIndex.value = "";
        nodePhone.value = "";
        
        return;
        
    }
    
    $.ajax({
        type:'POST',
        url:'/ajax/addresschange',
        data:{
            'id':id,
            'csrf':csrf
        },
        dataType: 'html',
        cache:false,
        beforeSend: function () {
            //$('#pre_loading').fadeIn(50);
        },
        success: function(data) {
            if(data !== null) {
                try {
                    decoded =JSON.parse(data);
                    
                    if(decoded.address_name) nodeName.value = decoded.address_name;
                    if(decoded.address_last_name) nodeLastName.value = decoded.address_last_name;
                    if(decoded.address_company) nodeCompany.value = decoded.address_company;
                    if(decoded.address) nodeAddress.value = decoded.address;
                    if(decoded.address_flat) nodeFlat.value = decoded.address_flat;
                    if(decoded.address_city) nodeCity.value = decoded.address_city;
                    if(decoded.address_index) nodeIndex.value = decoded.address_index;
                    if(decoded.address_phone) nodePhone.value = decoded.address_phone;
   
                } catch(e) {
                    throw Error(e);
                }
            }
            else {
                throw Error("Произошла неизвестная ошибка в функции AddressChange");
            }
        }
    });
}

function StartPoint(csrf) {
    $.ajax({
        type:'POST',
        url:'/ajax/buybypoints',
        data:{
            'csrf':csrf
        },
        dataType: 'html',
        cache:false,
        beforeSend: function () {
            //$('#pre_loading').fadeIn(50);
        },
        success: function(data) {
            if(data === '1') {
                window.location.reload();
            }
            else {
                throw Error("Произошла ошибка " + data);
            }
        }
    });
}

function ErasePoint(csrf) {
    $.ajax({
        type:'POST',
        url:'/ajax/buybyown',
        data:{
            'csrf':csrf
        },
        dataType: 'html',
        cache:false,
        beforeSend: function () {
            //$('#pre_loading').fadeIn(50);
        },
        success: function(data) {
            if(data === '1') {
                window.location.reload();
            }
            else {
                throw Error("Произошла ошибка " + data);
            }
        }
    });
    
}

function ShowFilter() {
    var block = document.querySelector('.filter_contailer');
    
    var style = getComputedStyle(block).display;
    
    if(style === 'block') {
        block.style.display = 'none';
    } else if(style === 'none') {
        block.style.display = 'block';
    } else {
        return false;
    }
}

function HideSearch() {
    $("#search-results1").hide();
    $("#search-results2").hide();
}

function AjaxSearch(value, csrf) {
    if(value.length <= 2) {
        HideSearch();
        return false;
    }
    
    $.ajax({
        type:'POST',
        url:'/ajax/ajaxsearch',
        data:{
            'csrf' : csrf,
            'value': value
        },
        dataType: 'html',
        cache:false,
        beforeSend: function () {
            //$('#pre_loading').fadeIn(50);
        },
        success: function(data) {
            if(data === '500') {
                HideSearch();
            }
            else {
                if(!document.querySelector('.sticky--active'))
                {
                    $("#search-results1").show().html(data);
                }
                $("#search-results1").html(data);
                $("#search-results2").show().html(data);
            }
        }
    });
};

function SelectRegion(id, csrf) {

    $.ajax({
        type:'POST',
        url:'/ajax/selectregion',
        data:{
            'id':id,
            'csrf':csrf
        },
        dataType: 'html',
        cache:false,
        beforeSend: function () {
            //$('#pre_loading').fadeIn(50);
        },
        success: function(data) {
            if(data !== '500') {
                var select = document.getElementById("checkout_shipping_address_province");
                select.innerHTML = data;
                select.disabled = false;
            }
            else {
                var select = document.getElementById("checkout_shipping_address_province");
                select.innerHTML = null;
                var option = document.createElement("option");
                option.innerHTML = "Регион";
                select.appendChild(option);
                select.disabled = true;
            }
        }
    });
    
}

