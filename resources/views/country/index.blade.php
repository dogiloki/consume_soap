{{view("layers/header")}}

<h1>Países</h1>

<from action="{{route('country.store')}}" method="POST">
    @csrf
    <img src="" name="src_flag" alt="">
    <input type="text" name="iso_code" readonly required>
    <input type="text" name="name" readonly required>
    <input type="text" name="capital" readonly required>
    <input type="text" name="phone_code" readonly required>
    <input type="text" name="currency_iso_code" readonly required>
    <input type="text" name="continent_iso_code" readonly required>
    <button type="submit">Enviar</button>
</from>

{{view("layers/footer")}}

<script src="{{asset('js/country.js')}}"></script>