import{a as u}from"./axios-B4uVmeYG.js";import{c as m}from"./alert-BjNJBOmD.js";/* empty css              */window.addEventListener("load",()=>{const i=document.querySelectorAll("[data-btn-download-file]"),a=document.querySelectorAll("[data-btn-remove-file]"),s=document.querySelectorAll("[data-uploader-img]");i.length>=1&&i.forEach(t=>{t.addEventListener("click",function(r){r.preventDefault();let l=this.getAttribute("data-btn-download-file");console.log(l),u({method:"get",url:l,responseType:"blob"}).then(function(e){const n=window.URL.createObjectURL(new Blob([e.data])),o=document.createElement("a");o.href=n,o.setAttribute("download",e.headers["content-disposition"]?e.headers["content-disposition"].split("filename=")[1]:"file"),document.body.appendChild(o),o.click(),window.URL.revokeObjectURL(n),document.body.removeChild(o)}).catch(function(e){console.error("Erreur lors du téléchargement:",e)})})}),a.length>=1&&a.forEach(t=>{t.addEventListener("click",function(r){r.preventDefault();let l=this.getAttribute("data-btn-remove-file");m("Vous êtes sur le point de supprimer un fichier, êtes-vous sûr(e) ?","default",function(e){e?u.get(l).then(function(n){location.reload()}).catch(function(n){Toast.error("Erreur lors de la suppression"),console.error("Erreur lors de la suppression:",n)}):console.log("Suppression annulée !")})})}),s.length>=1&&s.forEach(t=>{const r=t.querySelector("[data-input-file]"),l=t.querySelector("[data-img-preview]"),e=t.querySelector("[data-save-button]"),n=t.querySelector("[data-info-img]");e.style.display="none",r.addEventListener("change",function(o){var c=o.target.files[0];if(c){var d=new FileReader;d.onload=function(f){l.src=f.target.result},d.readAsDataURL(c),e.style.display="block",e.style.margin="auto",e.style.marginTop="15px",n.style.display="none"}else e.style.display="none",n.style.display="block"})})});
