@props(['name'])

@error($name)
<div>
     <span class="upozorenje">{{ $message }}</span>
</div>
     
@enderror