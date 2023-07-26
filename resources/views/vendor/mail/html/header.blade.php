@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'AinoviQ')
<img src="https://i.ibb.co/C8c6pMc/ainoviq.webp" class="logo" alt="AinoviQ Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
