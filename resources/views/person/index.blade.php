{{view("layers/header")}}

<h1>Personas</h1>

<form id="form_person" action="{{route('person.store')}}" method="POST">
    @csrf
    <input type="text" name="name" required>
    <input type="text" name="surname" required>
    <select name="country_id">
        @foreach($countries as $country)
            <option value="{{$country->id}}">{{$country->name}}</option>
        @endforeach
    </select>
    <select name="languages_id[]" multiple hidden>
        @foreach($languages as $language)
            <option value="{{$language->id}}">{{$language->name}}</option>
        @endforeach
    </select>
    <select name="languages_leves[]" multiple hidden>
        @foreach($languages as $language)
            <option value="0">0</option>
        @endforeach
    </select>
    <button type="submit">Guardar</button>
    @if(Session::has('message'))
        <p>{{Session::pull('message')}}</p>
    @endif
</form>

<form id="form_language">
    <select name="language_id" required>
        @foreach($languages as $language)
            <option value="{{$language->id}}">{{$language->name}}</option>
        @endforeach
    </select>
    <input type="number" name="language_level" min="1" max="100" placeholder="Nivel en porcentaje" required>
    <button type="submit">Agregar</button>
</form>

<section id="content_languages"></section>

<table border="1">
    <tr>
        <th>NOMBRE</th>
        <th>APELLIDOS</th>
        <th>PAÍS</th>
        <th>IDIOMAS</th>
        <th>ACCIONES</th>
    </tr>
    @foreach($persons as $person)
        <tr>
            <td>{{$person->name}}</td>
            <td>{{$person->surname}}</td>
            <td>{{$person->country->name}}</td>
            <td>
                @foreach($person->languages as $language)
                    {{$language->name}} - {{$language->pivot->level}}%<br>
                @endforeach
            </td>
            <td><a href="{{route('person.delete',$person->id)}}">Eliminar</a></td>
        </tr>
    @endforeach
</table>

{{view("layers/footer")}}

<script src="{{asset('js/person.js')}}"></script>