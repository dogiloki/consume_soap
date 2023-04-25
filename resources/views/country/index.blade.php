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

{{view("layers/footer")}}

<script src="{{asset('js/country.js')}}"></script>