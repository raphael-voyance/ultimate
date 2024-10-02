import './bootstrap';


import {Alpine, Livewire} from '../../vendor/livewire/livewire/dist/livewire.esm';

import ToastComponent from '../../vendor/usernotnull/tall-toasts/resources/js/tall-toasts';

import { themeChange } from 'theme-change';

import './primaryNavigation';
import './loadingPage';
import './appointmentCalendar';
import './refreshPage';
import './notifications';

Alpine.plugin(ToastComponent);
Livewire.start();

themeChange();
