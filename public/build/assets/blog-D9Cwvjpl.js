/* empty css              */import{T as a,c as l,d as n,f as s,i as d,r as c,s as m,o as p,I as u,m as g,a as h,P as w}from"./image-CZRH7lL6.js";window.addEventListener("load",()=>{let o={};const i=document.getElementById("editor-view").getAttribute("data-post-id");(async function(t){try{let e=window.location.origin+"/admin/blog/post/get-data-editor/"+i;o=(await axios.get(e,{params:{postId:i}})).data,r(o)}catch(e){throw console.error("Erreur lors de la requête au serveur :",e.message),e}})();function r(t){console.log("initializeEditor(data)",t);let e=t.length?JSON.parse(t):{};new a({holder:"editor-view",readOnly:!0,placeholder:"Tout est bon à dire du moment que c'est fait avec le coeur",tools:{header:l,list:n,checklist:s,quote:d,warning:c,marker:m,delimiter:p,linkTool:u,embed:g,table:h,image:{class:w,config:{endpoints:{byFile:"http://localhost:8008/uploadFile",byUrl:"http://localhost:8008/fetchUrl"}}}},data:JSON.parse(e)})}});