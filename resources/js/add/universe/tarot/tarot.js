import { createAlert } from "../../../Alert/alert.js";

window.addEventListener('load', () => {

//Page View
let transformInputEls = document.querySelectorAll('[data-transform-input]');

if(transformInputEls) {
    const updateRoute = document.querySelector('[data-update-route]').getAttribute('data-update-route');
    
    transformInputEls.forEach((el) => {
        let jsonString = el.getAttribute('data-transform-input');

        if(jsonString == '') {
            console.log('data-transform-input is empty');
            return;
        }
            
        let data = JSON.parse(jsonString);
        let containerInput = document.createElement('div');
        let input;
        if(data.inputType == 'textarea') {
            input = document.createElement('textarea');
        }else {
            input = document.createElement('input');
        }
        
        let submitBtn = document.createElement('btn');
        let cancelBtn = document.createElement('btn');

        el.classList.add('cursor-pointer');

        containerInput.classList.add('flex', 'gap-2', 'hidden', 'items-end');

        input.classList.add('bg-transparent', 'border-0', 'focus:outline-none', 'focus:shadow-none', 'focus:ring-0', 'border-slate-600', 'border-b-2', 'py-1', 'px-0', 'focus:border-slate-300', 'text-slate-300', 'focus:text-white', 'transition-all' );
        submitBtn.innerHTML = `<i class='fal fa-check'></i>`;
        cancelBtn.innerHTML = `<i class='fal fa-times'></i>`;
        submitBtn.classList.add('btn', 'btn-sm', 'btn-outline', 'btn-ghost', 'btn-circle');
        cancelBtn.classList.add('btn', 'btn-sm', 'btn-outline', 'btn-ghost', 'btn-circle');

        if(data.inputType == 'textarea') {
            containerInput.classList.add('w-full');
            input.innerText = data.value;
            input.setAttribute('name', data.inputType);
            input.classList.add('w-full', 'resize-none', 'mb-8');
            input.setAttribute('rows', 4);
        }else {
            input.value = data.value;
            input.setAttribute('name', data.inputType);
        }

        containerInput.append(input);
        containerInput.append(submitBtn);
        containerInput.append(cancelBtn);

        el.after(containerInput);

        el.addEventListener('click', function() {
            this.classList.add('hidden');
            containerInput.classList.remove('hidden');
        });

        cancelBtn.addEventListener('click', function() {
            el.classList.remove('hidden');
            containerInput.classList.add('hidden');
        });

        submitBtn.addEventListener('click', function() {
            axios.put(updateRoute, {
                value: input.value,
                field: data.field,
                draw: data.draw,
                position: data.position,
                arcanePath: data.arcanePath
              })
                .then(function (response) {
                    if (response.data.message) {
                        el.innerText = input.value;
                        el.classList.remove('hidden');
                        containerInput.classList.add('hidden');
                        Toast.success(response.data.message);
                    }
                })
                .catch(function (error) {
                    Toast.danger(error.response.data.message);
                });
        });

    });
}



});