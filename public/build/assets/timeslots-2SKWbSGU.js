import{a as f}from"./axios-CCb-kr4I.js";import{c as t}from"./alert-C7YwuTJn.js";/* empty css              */window.addEventListener("load",()=>{let i=document.getElementById("create_timeslots"),m=document.getElementById("add_timeslot");m&&m.addEventListener("click",function(a){a.preventDefault();let l=document.getElementById("timeStart").value,d=document.getElementById("timeEnd").value,r=document.getElementById("date").value,o={addUniqueTimeSlot:!0,start_time:l,end_time:d,date:r};f.post(window.location.href+"/create",o).then(function(e){t(e.data.message,"success",function(){window.location.reload()},!0)}).catch(function(e){t(e.response.data.message,"error",null,!0),console.error("Erreur lors de la création du créneau:",e)})}),i&&i.addEventListener("click",function(a){a.preventDefault();let l=document.getElementById("time").value,d=document.getElementById("interval").value,r=document.getElementById("start_time").value,o=document.getElementById("end_time").value,e=document.getElementById("startModel").value,s=null,u=document.getElementById("mtofOrWe").value,c=document.getElementById("weeks").value;if(e==="date"&&(s=document.getElementById("dateStart").value),u===""||c==="")return t("Merci de saisir le nombre semaines à générer.","error",null,!1);let E={addUniqueTimeSlot:!1,time:l,interval:d,start_time:r,end_time:o,mtofOrWe:u,nbWeeks:c,dateStart:s,startModel:e};f.post(window.location.href+"/create",E).then(function(n){t(n.data.message,"success",function(){window.location.reload()},!0)}).catch(function(n){t(n.response.data.message,"error",null,!0),console.error("Erreur lors de la création des créneaux:",n)})})});
