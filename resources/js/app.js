import './bootstrap';
import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import 'flowbite';

Alpine.plugin(intersect);

window.Alpine = Alpine;
Alpine.start();