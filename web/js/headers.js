$(document).ready(function() { 
  menuAffix.init(); 
}); 
window.addEventListener("hashchange", function () { 
  window.scrollTo(window.scrollX, window.scrollY - 100); 
}); 

var menuAffix = { 
  limit: 3, 
  mainBlock: ".textForAffixMenu", 
  menu: {}, 
  menuHtml: "", 

  init: function(){ 
    if($(this.mainBlock).length > 0){ 
      this.genMenu($(this.mainBlock)); 
    } 
  }, 

  genMenu: function(elem){ 
    this.getData(elem); 
    if(Object.keys(menuAffix.menu).length >= menuAffix.limit) 
      this.drawMenu(elem); 
    else{ 
      console.log("off limit"); 
      elem.addClass("col-sm-12"); 
    }	
  }, 

  getData: function(elem){ 
    var i = 1; 
    var newID = "main"; 
    menuAffix.menu[newID] = {"elem": "", "id": newID, "sub": {}}; 

    elem.find("h2, h3").each(function(){ 
      if($(this).is("h2")){ 
        if($(this).text().length > 0){ 
          newID = "h2"+i; 
          $(this).attr("id", newID); 
          menuAffix.menu[newID] = {"elem": $(this), "id": newID, "sub": {}}; 
        } 
      } 
      else{ 
        if($(this).text().length > 0){ 
          var subID = "h3"+i; 
          $(this).attr("id", subID); 
          menuAffix.menu[newID]["sub"][subID] = {"elem": $(this), "id": subID, "parrent": newID}; 
        }    
      } 
      i++; 
    }); 
  }, 

  drawMenu: function(elem){ 
    var params = this.getSearchParameters(); 

    var offset_top = parseInt(elem.offset().top)-70; 
    var offset_bottom = parseInt($("body").height()) - (offset_top + parseInt(elem.height())) + (elem.is(".full") ? 0 : 500); 
    var offset_bottom_top = offset_top + parseInt(elem.height()); 
    menuAffix.menuHtml = '<nav class="col-sm-3 " id="menuScrollSpy">'; 
      menuAffix.menuHtml += '<button type="button" class="collapsButton text-link collapsed" data-toggle="collapse" data-target="#menuAffixCollapse" aria-expanded="false">'; 
      menuAffix.menuHtml += '<span>'; 
      menuAffix.menuHtml += '<svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 32 32" class="icon icon-hamburger"><path fill="#444" d="M4.889 14.958h22.222v2.222H4.889v-2.222zM4.889 8.292h22.222v2.222H4.889V8.292zM4.889 21.625h22.222v2.222H4.889v-2.222z"></path></svg>'; 
      menuAffix.menuHtml += '</span>'; 
      menuAffix.menuHtml += '</button>'; 

    menuAffix.menuHtml += '<ul class="nav nav-pills nav-stacked" id="menuAffixCollapse" data-spy="affix" data-offset-top="'+offset_top+'" data-offset-bottom="'+offset_bottom+'">'; 
    var i=1; 
    for(var key in menuAffix.menu){ 
      if(key == 'main') 
        continue; 

      if(Object.keys(menuAffix.menu[key]["sub"]).length == 0) 
        menuAffix.menuHtml += '<li '+(i==1 ? 'class="active"' : '')+'><a href="#'+menuAffix.menu[key].id+'">'+menuAffix.menu[key].elem.text()+'</a></li>'; 
      else{ 
        menuAffix.menuHtml += '<li>'; 
        menuAffix.menuHtml += '<a href="#'+menuAffix.menu[key].id+'">'+menuAffix.menu[key].elem.text()+'</a>'; 
        menuAffix.menuHtml += '<ul class="nav nav-pills nav-stacked">'; 
        for(var subKey in menuAffix.menu[key]["sub"]){ 
          menuAffix.menuHtml += '<li><a href="#'+menuAffix.menu[key]["sub"][subKey].id+'">'+menuAffix.menu[key]["sub"][subKey].elem.text()+'</a></li>'; 
        } 
        menuAffix.menuHtml += '</ul>'; 
        menuAffix.menuHtml += '</li>'; 
      } 

      i=0; 
    } 
    menuAffix.menuHtml += '</ul>';	
    menuAffix.menuHtml += '</nav>'; 

    elem.addClass("col-sm-9").after(menuAffix.menuHtml); 

    if(parseInt($( window ).width()) <= 768){ 
      $("ul#menuAffixCollapse").addClass("collapse"); 
      $("#menuScrollSpy button.collapsButton").on("click", function(){ 
        if($("ul#menuAffixCollapse").is(".in")) 
          $("ul#menuAffixCollapse").css("padding-top", "0"); 
        else 
          $("ul#menuAffixCollapse").css("padding-top", "42px"); 
      }); 
      
      var scrolled = window.pageYOffset || document.documentElement.scrollTop; 
      if(scrolled < offset_top || scrolled > offset_bottom_top){ 
        $("ul#menuAffixCollapse").hide(); 
        $("#menuScrollSpy button.collapsButton").hide(); 
      } 
      window.onscroll = function() { 
        scrolled = window.pageYOffset || document.documentElement.scrollTop; 
        if(scrolled < offset_top || scrolled > offset_bottom_top){ 
          $("ul#menuAffixCollapse").hide(); 
          $("#menuScrollSpy button.collapsButton").hide(); 
        } 
        else{ 
          $("ul#menuAffixCollapse").show(); 
          $("#menuScrollSpy button.collapsButton").show().addClass("collapsed"); 
          $("ul#menuAffixCollapse").css("height", "0").removeClass("in").css("padding-top", "0"); 
        } 
      } 
    } 
  }, 

  getSearchParameters: function() { 
    var prmstr = window.location.search.substr(1); 
    return prmstr != null && prmstr != "" ? this.transformToAssocArray(prmstr) : {}; 
  }, 

  transformToAssocArray: function( prmstr ) { 
    var params = {}; 
    var prmarr = prmstr.split("&"); 
    for ( var i = 0; i < prmarr.length; i++) { 
      var tmparr = prmarr[i].split("="); 
      params[tmparr[0]] = tmparr[1]; 
    } 
    return params; 
  } 
}

