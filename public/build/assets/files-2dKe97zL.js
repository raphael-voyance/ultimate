import{a as d}from"./axios-B4uVmeYG.js";/* empty css              */window.addEventListener("load",()=>{const o=document.querySelectorAll("[data-btn-download-file]"),n=document.querySelectorAll("[data-btn-remove-file]");o.length>=1&&o.forEach(e=>{e.addEventListener("click",function(t){t.preventDefault();let l=this.getAttribute("data-btn-download-file");console.log(l),d({method:"get",url:l}).then(function(a){console.log(a.data.message)})})}),n.length&&n.forEach(e=>{e.addEventListener("click",function(t){t.preventDefault(),console.log(this)})})});
