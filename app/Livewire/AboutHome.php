<?php

namespace App\Livewire;

use Livewire\Component;

class AboutHome extends Component
{
    public array $aboutData = [];

    public function mount(): void
    {
        $this->aboutData = [
            'title' => 'Lajoo trans Home',
            'slug' => 'about-us',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus nec neque ut tortor auctor elementum eget at lectus. Curabitur vitae consectetur dolor. Integer tempus dui dolor, sed dignissim urna malesuada id. Mauris et urna eget orci euismod tempor commodo fermentum est. Curabitur nec rhoncus leo. Maecenas dictum imperdiet auctor. Nam tincidunt felis lorem, fringilla iaculis lacus imperdiet a. Donec at lorem placerat, cursus diam vel, eleifend diam. Sed gravida ornare sem, ut faucibus tortor ornare eget. Vestibulum nunc enim, dapibus ut elementum ac, fringilla vel purus.
                
                Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Quisque placerat sit amet dui sed vulputate. Fusce eleifend diam at lectus gravida, ac gravida risus iaculis. Mauris viverra vehicula lectus, ac facilisis nulla consequat sagittis. Aenean ut lacinia nisi. Fusce non molestie nisl, ut fermentum erat. Quisque felis enim, gravida non sollicitudin et, volutpat sit amet tellus. Nam fringilla lacus pharetra erat consectetur, sed ultricies elit consequat. Quisque pharetra nisi mattis dolor bibendum auctor. Integer non tortor mollis, luctus justo in, egestas arcu. Integer eleifend risus id neque elementum, ac posuere lorem finibus.
                
                Morbi tincidunt euismod mi, eu volutpat augue semper id. Curabitur blandit magna erat, lacinia tempor lorem vulputate vitae. Praesent mollis facilisis ipsum, vel pharetra augue aliquet in. Nullam placerat magna arcu, vitae pharetra lacus tempus at. Maecenas viverra, nulla vitae lobortis pharetra, urna augue auctor lorem, in porttitor massa enim porttitor purus. Duis a odio enim. Vivamus faucibus vehicula justo vel volutpat.
                
                Aliquam convallis odio ipsum, ut molestie mi malesuada at. Cras eu lorem elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla in molestie dolor. Vivamus non pellentesque mauris. Integer faucibus leo vitae tortor fermentum mattis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque a condimentum risus, et sagittis odio.
                
                Interdum et malesuada fames ac ante ipsum primis in faucibus. Nullam ullamcorper, magna id vehicula dictum, odio diam auctor neque, at tristique metus tellus sit amet nisl. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi bibendum, velit in iaculis finibus, purus turpis imperdiet metus, eu maximus massa nisi at orci. Phasellus at massa ultricies, tristique nisl eu, luctus eros. Nunc egestas commodo justo eu feugiat. Donec placerat nunc id lacinia auctor. Integer placerat ut augue id convallis. Sed vel nisl vel metus scelerisque mollis. Curabitur id dui vitae justo varius convallis. Curabitur ullamcorper nisl ac odio sagittis, vitae dapibus erat blandit. Nullam mi felis, luctus id sem eget, laoreet tempus ligula..',
        ];
    }

    public function render()
    {
        return view('livewire.about-home', [
            'aboutData' => $this->aboutData,
        ]);
    }
}
