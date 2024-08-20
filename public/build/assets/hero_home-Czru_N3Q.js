import{g as O}from"./index-DjKJqAo0.js";import{c as ne,g as re}from"./_commonjsHelpers-Cpj98o6Y.js";var B={exports:{}};(function(E,H){(function(i,g){E.exports=g()})(ne,function(){var i=document,g=i.createTextNode.bind(i);function w(e,t,n){e.style.setProperty(t,n)}function u(e,t){return e.appendChild(t)}function f(e,t,n,o){var r=i.createElement("span");return t&&(r.className=t),n&&(!o&&r.setAttribute("data-"+t,n),r.textContent=n),e&&u(e,r)||r}function p(e,t){return e.getAttribute("data-"+t)}function h(e,t){return!e||e.length==0?[]:e.nodeName?[e]:[].slice.call(e[0].nodeName?e:(t||i).querySelectorAll(e))}function y(e){for(var t=[];e--;)t[e]=[];return t}function c(e,t){e&&e.some(t)}function C(e){return function(t){return e[t]}}function A(e,t,n){var o="--"+t,r=o+"-index";c(n,function(a,l){Array.isArray(a)?c(a,function(s){w(s,r,l)}):w(a,r,l)}),w(e,o+"-total",n.length)}var L={};function N(e,t,n){var o=n.indexOf(e);if(o==-1){n.unshift(e);var r=L[e];if(!r)throw new Error("plugin not loaded: "+e);c(r.depends,function(l){N(l,e,n)})}else{var a=n.indexOf(t);n.splice(o,1),n.splice(a,0,e)}return n}function m(e,t,n,o){return{by:e,depends:t,key:n,split:o}}function S(e){return N(e,0,[]).map(C(L))}function v(e){L[e.by]=e}function F(e,t,n,o,r){e.normalize();var a=[],l=document.createDocumentFragment();o&&a.push(e.previousSibling);var s=[];return h(e.childNodes).some(function(d){if(d.tagName&&!d.hasChildNodes()){s.push(d);return}if(d.childNodes&&d.childNodes.length){s.push(d),a.push.apply(a,F(d,t,n,o,r));return}var b=d.wholeText||"",T=b.trim();if(T.length){b[0]===" "&&s.push(g(" "));var ee=n===""&&typeof Intl.Segmenter=="function";c(ee?Array.from(new Intl.Segmenter().segment(T)).map(function(D){return D.segment}):T.split(n),function(D,te){te&&r&&s.push(f(l,"whitespace"," ",r));var q=f(l,t,D);a.push(q),s.push(q)}),b[b.length-1]===" "&&s.push(g(" "))}}),c(s,function(d){u(l,d)}),e.innerHTML="",u(e,l),a}var x=0;function j(e,t){for(var n in t)e[n]=t[n];return e}var _="words",z=m(_,x,"word",function(e){return F(e,"word",/\s+/,0,1)}),R="chars",k=m(R,[_],"char",function(e,t,n){var o=[];return c(n[_],function(r,a){o.push.apply(o,F(r,"char","",t.whitespace&&a))}),o});function I(e){e=e||{};var t=e.key;return h(e.target||"[data-splitting]").map(function(n){var o=n["🍌"];if(!e.force&&o)return o;o=n["🍌"]={el:n};var r=e.by||p(n,"splitting");(!r||r=="true")&&(r=R);var a=S(r),l=j({},e);return c(a,function(s){if(s.split){var d=s.by,b=(t?"-"+t:"")+s.key,T=s.split(n,l,o);b&&A(n,b,T),o[d]=T,n.classList.add(d)}}),n.classList.add("splitting"),o})}function G(e){e=e||{};var t=e.target=f();return t.innerHTML=e.content,I(e),t.outerHTML}I.html=G,I.add=v;function M(e,t,n){var o=h(t.matching||e.children,e),r={};return c(o,function(a){var l=Math.round(a[n]);(r[l]||(r[l]=[])).push(a)}),Object.keys(r).map(Number).sort(W).map(C(r))}function W(e,t){return e-t}var Y=m("lines",[_],"line",function(e,t,n){return M(e,{matching:n[_]},"offsetTop")}),$=m("items",x,"item",function(e,t){return h(t.matching||e.children,e)}),U=m("rows",x,"row",function(e,t){return M(e,t,"offsetTop")}),V=m("cols",x,"col",function(e,t){return M(e,t,"offsetLeft")}),J=m("grid",["rows","cols"]),P="layout",K=m(P,x,x,function(e,t){var n=t.rows=+(t.rows||p(e,"rows")||1),o=t.columns=+(t.columns||p(e,"columns")||1);if(t.image=t.image||p(e,"image")||e.currentSrc||e.src,t.image){var r=h("img",e)[0];t.image=r&&(r.currentSrc||r.src)}t.image&&w(e,"background-image","url("+t.image+")");for(var a=n*o,l=[],s=f(x,"cell-grid");a--;){var d=f(s,"cell");f(d,"cell-inner"),l.push(d)}return u(e,s),l}),Q=m("cellRows",[P],"row",function(e,t,n){var o=t.rows,r=y(o);return c(n[P],function(a,l,s){r[Math.floor(l/(s.length/o))].push(a)}),r}),X=m("cellColumns",[P],"col",function(e,t,n){var o=t.columns,r=y(o);return c(n[P],function(a,l){r[l%o].push(a)}),r}),Z=m("cells",["cellRows","cellColumns"],"cell",function(e,t,n){return n[P]});return v(z),v(k),v(Y),v($),v(U),v(V),v(J),v(K),v(Q),v(X),v(Z),I})})(B);var oe=B.exports;const ie=re(oe);window.addEventListener("DOMContentLoaded",()=>{});window.addEventListener("load",()=>{const E=ie(),H=document.getElementById("hero_messages"),i=[...document.querySelectorAll(".content__text")],g=i.map(c=>[...c.querySelectorAll(".word")].map(A=>A.querySelectorAll(".char")));let w=i.length-1,u=0,f=!1;i[u].classList.add("content__text--current");const p=()=>{if(f)return!1;f=!0,u>w&&(u=0);const c=u+1>w?0:u+1,C=E[u].words,A=E[c].words,L=O.timeline({onComplete:()=>{u++,f=!1}});C.forEach((N,m)=>{const S=O.timeline().fromTo(g[u][m],{willChange:"transform, opacity",scale:1},{duration:.2,ease:"power1.in",opacity:0,scale:0,stagger:{each:.03,from:"edges"}});L.add(S,Math.random()*.5)}),L.add(()=>{i[u].classList.remove("content__text--current"),i[c].classList.add("content__text--current")}).addLabel("previous",">"),A.forEach((N,m)=>{const S=O.timeline().fromTo(g[c][m],{willChange:"transform, opacity",opacity:0,scale:1.7},{duration:.5,ease:"power3.out",opacity:1,scale:1,stagger:{each:.03,from:"edges"}});L.add(S,`previous+=${Math.random()*.5}`)})},h=6500;let y=setInterval(p,h);H.addEventListener("mouseenter",function(){clearInterval(y)}),H.addEventListener("mouseleave",function(){y=setInterval(p,h)})});window.addEventListener("load",()=>{const E=document.getElementById("home-hero"),H=document.getElementById("sub-header"),i=document.getElementById("header");let g=H.offsetHeight,w=E.offsetHeight,u=i.offsetHeight,f=w-g,p=()=>{E.style.height="calc(100vh - "+g+"px)"},h=()=>{i.classList.contains("isFixed")?(i.style.bottom="auto",i.style.top=g+"px"):i.classList.contains("isAbsolute")&&(i.style.bottom="0",i.style.top="auto")},y=()=>{h(),window.scrollY>=f-u?(i.classList.add("isFixed"),i.style.bottom="auto",i.classList.remove("isAbsolute")):(i.classList.add("isAbsolute"),i.style.bottom=0,i.classList.remove("isFixed"))};window.addEventListener("scroll",c=>{y()}),window.addEventListener("resize",()=>{p()}),p(),y(),h()});