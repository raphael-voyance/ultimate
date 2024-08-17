import axios from 'axios';
import { loader } from "../../helpers/utils.js";
import { createAlert } from "../../Alert/alert.js";

window.addEventListener('load', () => {
    const dataBtnDownloadFile = document.querySelectorAll('[data-btn-download-file]');
    const dataBtnRemoveFile = document.querySelectorAll('[data-btn-remove-file]');

    if(dataBtnDownloadFile.length >= 1) {
        dataBtnDownloadFile.forEach((btn) => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                let url = this.getAttribute('data-btn-download-file');
                console.log(url)
                axios({
                    method: 'get',
                    url: url
                  })
                    .then(function (response) {
                      console.log(response.data.message)
                    });
            })
        });
    }

    if(dataBtnRemoveFile.length) {
        dataBtnRemoveFile.forEach((btn) => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                console.log(this)
            })
        });
    }
    
});