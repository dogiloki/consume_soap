{{view("layers/header")}}

<h1>Personas</h1>

<form id="form_person" action="{{route(isset($person)?'person.update':'person.store')}}" method="POST">
    @csrf
    @if(isset($person))
        @method('PUT')
    @endif
    <input type="text" name="name" value="{{$person->name??''}}" required>
    <input type="text" name="surname" value="{{$person->surname??''}}" required>
    <select name="country_id">
        @foreach($countries as $country)
            @if(isset($person))
                <option value="{{$country->id}}" {{$person->country->id==$country->id?'seleted':''}}>{{$country->name}}</option>
            @else
                <option value="{{$country->id}}">{{$country->name}}</option>
            @endif
        @endforeach
    </select>
    <select name="languages_id[]" multiple hidden ></select>
    <select name="languages_leves[]" multiple hidden ></select>
    @if(isset($person))
        <input type="hidden" name="id" value="{{$person->id}}">
        <button type="submit">Guardar cambios</button>
    @else
        <button type="submit">Guardar</button>
    @endif
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

<section id="content_languages">
    @if(isset($person))
        @foreach($person->languages as $language)
            <p onclick="removeLanguage(this)" language_id="{{$language->id}}" language_level="{{$language->pivot->level}}" title="Eliminar">{{$language->name}} - {{$language->pivot->level}}%</p>
        @endforeach
    @endif
</section>

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
            <td>
                <a href="{{route('person.index',$person->id)}}">Editar</a>
                <a href="{{route('person.delete',$person->id)}}">Eliminar</a>
            </td>
        </tr>
    @endforeach
</table>

{{view("layers/footer")}}

<script src="{{asset('js/person.js')}}"></script>