import './bootstrap';
import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import collapse from '@alpinejs/collapse';
import 'flowbite';

Alpine.plugin(intersect);
Alpine.plugin(collapse);

window.Alpine = Alpine;
Alpine.start();