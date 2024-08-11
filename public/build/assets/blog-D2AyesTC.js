import{a as p}from"./axios-B4uVmeYG.js";import{f as B}from"./utils-DPqQJ3U5.js";import{c as L}from"./alert-maf5A8O9.js";import{T as w,c as C,d as T,f as A,i as x,r as _,s as D,o as S,I as P,m as q,a as M,P as R}from"./image-CZRH7lL6.js";/* empty css              */window.addEventListener("load",()=>{const I=document.getElementById("blog-index"),g=document.getElementById("blog-create"),s=document.getElementById("blog-edit");let m={};if(I){let t=document.querySelectorAll("[data-copy-link]"),n=document.querySelectorAll("[data-btn-post-del]");t.length>0&&t.forEach(e=>{e.addEventListener("click",function(l){l.preventDefault(),k(e)})}),n&&n.forEach(e=>{e.addEventListener("click",l=>{const d=e.getAttribute("data-btn-post-del");l.preventDefault(),L("Vous êtes sur le point de supprimer un article, êtes-vous sûr(e) ?","default",function(r){r?(console.log(r),p.delete(d).then(function(o){o.data.status=="success"&&(window.location=o.data.redirectRoute)}).catch(function(o){console.log(o),Toast.danger("Il y a eu une erreur dans le processus de suppression de l'article, merci de réessayer après avoir rafraichi votre navigateur.")})):console.log("Suppression annulée !")})})})}if(g||s){const t=document.getElementById("add-categorie"),n=document.getElementById("add-categorie-input-container");document.getElementById("add-categorie-input"),document.getElementById("add-categorie-submit-btn");const e=document.getElementById("add-categorie-cancel-btn"),l=document.getElementById("published_at_select_date"),d=document.getElementById("published_at_input"),r=document.getElementById("published_at_input_container"),o=document.getElementById("published_at_input_submit_btn"),c=document.getElementById("published_at_input_cancel_btn"),b=document.getElementById("published_at_text");t.addEventListener("click",function(i){i.preventDefault(),this.classList.add("hidden"),n.classList.remove("hidden")}),e.addEventListener("click",function(i){i.preventDefault(),t.classList.remove("hidden"),n.classList.add("hidden")}),d.addEventListener("input",B),l.addEventListener("click",function(){r.classList.remove("hidden")}),o.addEventListener("click",function(i){i.preventDefault(),r.classList.add("hidden"),b.innerText="Publier le "+d.value}),c.addEventListener("click",function(i){i.preventDefault(),r.classList.add("hidden")})}if(s){const t=s.getAttribute("data-post-id");(async function(n){try{let e=window.location.origin+"/admin/blog/post/get-data-editor/"+t;m=(await p.get(e,{params:{postId:t}})).data,y(m,t)}catch(e){throw console.error("Erreur lors de la requête au serveur :",e.message),e}})()}g&&(console.log("blogCreate"),y(m));function y(t,n){console.log("initializeEditor(data)",t);let e=t.length?JSON.parse(t):{},l=document.getElementById("title"),d=document.getElementById("excerpt"),r=document.getElementById("slug"),o;const c=document.getElementById("btn-submit-post"),b=new w({holder:"editor",readOnly:!1,placeholder:"Tout est bon à dire du moment que c'est fait avec le coeur",tools:{header:C,list:T,checklist:A,quote:x,warning:_,marker:D,delimiter:S,linkTool:P,embed:q,table:M,image:{class:R,config:{endpoints:{byFile:"http://localhost:8008/uploadFile",byUrl:"http://localhost:8008/fetchUrl"}}}},data:e,i18n:{messages:{ui:{Search:"Rechercher",popover:{Filter:"Filtrer","Convert to":"Convertir en"},blockTunes:{toggler:{"Click to tune":"Cliquer pour valider","or drag to move":"ou le faire glisser pour le déplacer"}},inlineToolbar:{converter:{"Convert to":"Convertir en"}},toolbar:{toolbox:{Add:"Ajouter"}}},toolNames:{Text:"Paragraphe",Heading:"Titre",List:"Liste",Warning:"Alerte",Checklist:"Checklist",Quote:"Citation",Delimiter:"Séparation",Table:"Tableau",Link:"Lien",Marker:"Marqueur",Bold:"Gras",Italic:"Italic"},tools:{warning:{Title:"Titre",Message:"Message"},link:{"Add a link":"Ajouter un lien"},stub:{"The block can not be displayed correctly.":"Le block ne peut pas s'afficher correctement."}},blockTunes:{delete:{Delete:"Supprimer","Click to delete":"Confirmer"},moveUp:{"Move up":"Monter d'un cran"},moveDown:{"Move down":"Descendre d'un cran"}}}}});c&&c.addEventListener("click",function(i){i.preventDefault(),b.save().then(u=>{let f=l.value,h=d.value,v=r.value;if(o=u,console.log(f,h,v,o),g){let E=window.location.origin+"/admin/blog/post/store";p.post(E,{content:o,title:f,excerpt:h,slug:v}).then(function(a){a.data.status=="success"&&(window.location=a.data.redirectRoute)}).catch(function(a){Toast.danger(a.response.data.message)})}if(s){let E=window.location.origin+"/admin/blog/post/update/"+n;p.post(E,{content:u,title:f,excerpt:h,slug:v}).then(function(a){a.data.status=="success"&&(window.location=a.data.redirectRoute)}).catch(function(a){Toast.danger(a.response.data.message)})}}).catch(u=>{console.log("Saving failed: ",u)})})}function k(t){const n=t.getAttribute("data-copy-link");navigator.clipboard&&navigator.clipboard.writeText?navigator.clipboard.writeText(n).then(()=>{alert("Le texte a bien été copié dans le presse-papiers : "+n)}).catch(e=>{console.error("Erreur lors de la copie du texte : ",e)}):(console.error("L'API Clipboard n'est pas supportée par ce navigateur."),alert("Votre navigateur ne supporte pas l'API Clipboard."))}});
