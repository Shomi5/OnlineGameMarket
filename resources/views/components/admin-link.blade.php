@props(['active' => false])


<li >
    <a class="admin-nav-link {{ $active? "svetliCss" : ""}}" {{$attributes}}>{{$slot}}</a>
</li>