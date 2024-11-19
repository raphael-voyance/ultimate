import axios from 'axios';
import { loader } from "../../helpers/utils.js";
import { createAlert } from "../../Alert/alert.js";

window.addEventListener('load', () => {

    let createTimeslotsBtn = document.getElementById('create_timeslots');
    let addTimeslotBtn = document.getElementById('add_timeslot');
    
    if(addTimeslotBtn) {
        addTimeslotBtn.addEventListener('click', function(e) {
            e.preventDefault();
            let timeStart = document.getElementById('timeStart').value;
            let timeEnd = document.getElementById('timeEnd').value;
            let date = document.getElementById('date').value;
            
            let datas = {
                addUniqueTimeSlot : true,
                start_time : timeStart, 
                end_time : timeEnd, 
                date : date
            };

            axios.post(window.location.href + '/create', datas)
            .then(function (response) {
                createAlert(response.data.message, 'success', function() {
                    window.location.reload();
                }, true);
            })
            .catch(function (error) {
                createAlert(error.response.data.message, 'error', null, true);
                console.error('Erreur lors de la création du créneau:', error);
            });

        });
    }

    if(createTimeslotsBtn) {
        createTimeslotsBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            let time = document.getElementById('time').value;
            let interval = document.getElementById('interval').value;
            let start_time = document.getElementById('start_time').value;
            let end_time = document.getElementById('end_time').value;
            let startModel = document.getElementById('startModel').value;
            let dateStart = null;

            let mtofOrWe = document.getElementById('mtofOrWe').value;
            let nbWeeks = document.getElementById('weeks').value;

            if(startModel === 'date') {
                dateStart = document.getElementById('dateStart').value;
            }

            if(mtofOrWe === '' || nbWeeks === '') {
                return createAlert('Merci de saisir le nombre semaines à générer.', 'error', null, false);
            }
            
            let datas = {
                addUniqueTimeSlot : false,
                time : time, 
                interval : interval, 
                start_time : start_time, 
                end_time : end_time, 
                mtofOrWe : mtofOrWe, 
                nbWeeks : nbWeeks,
                dateStart : dateStart,
                startModel : startModel
            };

                // console.log(data);

                // return;

            axios.post(window.location.href + '/create', datas)
            .then(function (response) {
                createAlert(response.data.message, 'success', function() {
                    window.location.reload();
                }, true);
            })
            .catch(function (error) {
                createAlert(error.response.data.message, 'error', null, true);
                console.error('Erreur lors de la création des créneaux:', error);
            });

        });
    }

    
});