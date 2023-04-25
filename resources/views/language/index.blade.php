{{view("layers/header")}}

<h1>Idiomas</h1>

<select id="list_languages"></select>

<form id="form" action="{{route('language.store')}}" method="POST">
    @csrf
    <input type="text" name="iso_code" readonly required>
    <input type="text" name="name" readonly required>
    <button type="submit">Guardar</button>
    @if(Session::has('message'))
        <p>{{Session::pull('message')}}</p>
    @endif
</form>

<table border="1">
    <tr>
        <th>ISO CODE</th>
        <th>NOMBRE</th>
    </tr>
    @foreach($languages as $language)
        <tr>
            <td>{{$language->iso_code}}</td>
            <td>{{$language->name}}</td>
            <td><a href="{{route('language.delete',$language->id)}}">Eliminar</a></td>
        </tr>
    @endforeach
</table>

{{view("layers/footer")}}

<script src="{{asset('js/language.js')}}"></script>