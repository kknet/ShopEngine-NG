(function(l, l2, s) {

l2 = l2 || 6;

NodeList.prototype.forEach = [].forEach;
NodeList.prototype.slice = [].slice;

var toc = document.createElement('div');
var headerLevel = l || 2;
var tocStyle = s || 'ul';
var headers = document
  .querySelector('.article')
  .querySelectorAll('h1 h2 h3 h4 h5 h6'.split(' ').slice(headerLevel - 1).join());
  
for (var i = 0; i < headers.length; i++) {
    var id_text = translit(headers[i].innerHTML.toLowerCase());
    headers[i].id = id_text;
}

function buildList(header) {
  var li = document.createElement('li');
  var a = document.createElement('a');
  var a_ = header.id;
  a.href = '#' + a_;
  a.innerHTML = header.innerText;
  li.appendChild(a);
  return li;
}

(function buildTocTree(tree, headers, level) {
  var i, m,
      indices = [],
      hx = 'H' + level,
      n = headers.length,
      ul = document.createElement(tocStyle);

  if(!n || level > l2) return;
  tree.appendChild(ul);

  function set(start, end) {
    var li = buildList(headers[start]);
    ul.appendChild(li);
    buildTocTree(li, headers.slice(start + 1, end), level + 1);
  }

  for(i = 0; i < n; ++i) if(headers[i].tagName === hx) indices.push(i);
  for(i = 0, m = indices.length - 1; i < m; ++i) set(indices[i], indices[i + 1]);
  if(indices.length) set(indices[m], n);
})(toc, headers, headerLevel);

if(headers.length < 3) {
    var block = document.getElementById("summary_block");
    block.parentNode.removeChild(block);

    var article = document.querySelector('.article');
    article.style.width = "100%";

    return false;
  }

var block = document.getElementById("summary_block");
var title = document.createElement('span');
title.classList.add("summary_title");
title.innerHTML = "Содержание";

mainInner = title.outerHTML + toc.innerHTML;

block.innerHTML = mainInner;
})(2, 6, 'ul');

function translit(str){

var space = '-'; 

var text = str;
     
var transl = {
'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e', 'ж': 'zh', 
'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
'о': 'o', 'п': 'p', 'р': 'r','с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h',
'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'sh','ъ': space, 'ы': 'y', 'ь': space, 'э': 'e', 'ю': 'yu', 'я': 'ya',
' ': space, '_': space, '`': space, '~': space, '!': space, '@': space,
'#': space, '$': space, '%': space, '^': space, '&': space, '*': space, 
'(': space, ')': space,'-': space, '\=': space, '+': space, '[': space, 
']': space, '\\': space, '|': space, '/': space,'.': space, ',': space,
'{': space, '}': space, '\'': space, '"': space, ';': space, ':': space,
'?': space, '<': space, '>': space, '№':space
}
                
var result = '';
var curent_sim = '';
                
for(i=0; i < text.length; i++) {
    if(transl[text[i]] != undefined) {
         if(curent_sim != transl[text[i]] || curent_sim != space){
             result += transl[text[i]];
             curent_sim = transl[text[i]];
                                                        }                                                                             
    }
    else {
        result += text[i];
        curent_sim = text[i];
    }                              
}          
                
result = TrimStr(result);               
                
return result;
    
}
function TrimStr(s) {
    s = s.replace(/^-/, '');
    return s.replace(/-$/, '');
}
$(function(){
    $('#name').keyup(function(){
         translit();
         return false;
    });
});