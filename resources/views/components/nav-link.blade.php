@props(['active' => false])


<li class="nav-item">
    <a class="nav-link  mx-lg-2 {{ $active? "svetliCss" : ""}}" {{$attributes}}>{{$slot}}</a>
</li>