{{view("layers/header")}}

<h1>Países</h1>

<select id="list_countries"></select>

<form id="form" action="{{route('country.store')}}" method="POST">
    @csrf
    <img src="" name="img_src_flag" alt="">
    <input type="hidden" name="src_flag" readonly required>
    <input type="text" name="iso_code" readonly required>
    <input type="text" name="name" readonly required>
    <input type="text" name="capital" readonly required>
    <input type="text" name="phone_code" readonly required>
    <input type="text" name="currency_iso_code" readonly required>
    <input type="text" name="continent_iso_code" readonly required>
    <button type="submit">Guardar</button>
    @if(Session::has('message'))
        <p>{{Session::pull('message')}}</p>
    @endif
</form>

<table border="1">
    <tr>
        <th>ISO CODE</th>
        <th>NOMBRE</th>
        <th>CAPITAL</th>
        <th>CÓDIGO TELEFÓNICO</th>
        <th>ISO CODE MONEDA</th>
        <th>ISO CODE CONTINENTE</th>
        <th>BANDERA</th>
        <th>ACCIONES</th>
    </tr>
    @foreach($countries as $country)
        <tr>
            <td>{{$country->iso_code}}</td>
            <td>{{$country->name}}</td>
            <td>{{$country->capital}}</td>
            <td>{{$country->phone_code}}</td>
            <td>{{$country->currency_iso_code}}</td>
            <td>{{$country->continent_iso_code }}</td>
            <td><img src='{{$country->src_flag}}'></td>
            <td><a href="{{route('country.delete',$country->id)}}">Eliminar</a></td>
        </tr>
    @endforeach
</table>

{{view("layers/footer")}}

<script src="{{asset('js/country.js')}}"></script>