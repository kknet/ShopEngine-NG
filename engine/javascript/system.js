window.onload = function() {
   
    cartload();
    
    var metas =     document.getElementsByTagName("meta"),
        btn_ac   =  document.getElementById("AddToCart"),
        minus    =  document.querySelectorAll(".cart_minus"),
        plus     =  document.querySelectorAll(".cart_plus"),
        min_ac   =  document.querySelector(".add_to_cart_minus"), 
        pls_ac   =  document.querySelector(".add_to_cart_plus"),
        quant_ac =  document.getElementById("Quantity"),
        quant    =  document.querySelectorAll(".cart_update"),
        search   =  document.querySelector(".site-header__search-input"),
        add_del  =  document.querySelectorAll(".delete_address");

    if(add_del) {
        
        console.log(add_del);
        
        for(var i = 0; i < add_del.length; i++) { 
            var data = {
                add_id : add_del[i].getAttribute('data-id'),
                csrf   : add_del[i].getAttribute('data-csrf')
            }

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
            console.log(search.value);
        }
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
        
        var data = {
            cart_id : minus[i].getAttribute("data-temp-id"),
            csrf: minus[i].getAttribute("data-csrf")
        };
        
        minus[i].prototype = data;
        
        minus[i].addEventListener("click", function(e) {
            return Minus(this.prototype.cart_id, this.prototype.csrf);
        });
        minus[i].removeAttribute("data-temp-id");
    }
    
    for (var i = 0; i < plus.length; i++) {   
        
        var data = {
            cart_id : plus[i].getAttribute("data-temp-id"),
            csrf: plus[i].getAttribute("data-csrf")
        };
        
        plus[i].prototype = data;
        
        plus[i].addEventListener("click", function(e) {
            return Plus(this.prototype.cart_id, this.prototype.csrf);
        });
        plus[i].removeAttribute("data-temp-id");
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
    
    var csrf = document.getElementById("cartIndicatorAjax").getAttribute("data-csrf");
    var indi = document.querySelector(".site-header__cart-indicator");
    
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
            }
            else {
                indi.classList.add("hide");
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
