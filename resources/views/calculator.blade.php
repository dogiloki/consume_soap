<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Calculadora por SOAP</title>
</head>
<body>

    <h1>Calculadora por SOAP</h1>

    <form action="{{route('calculator')}}" method="POST">
        @csrf
        <input type="text" name="intA" placeholder="Primer número" required>
        <input type="text" name="intB" placeholder="Segundo número" required>
        <select name="operation" required>
            @foreach(Session::pull('operations') as $key=>$value)
                <option value="{{$key}}">{{$value}}</option>
            @endforeach
        </select>
        <input type="submit" value="Calcular">
    </form>

    @if(Session::has('result'))
        <h2>Resultado: {{Session::pull('result')}}</h2>
    @endif

    @if(Session::has('error'))
        <h2>Error: {{Session::pull('error')}}</h2>
    @endif

    @if(Session::has('valitator_error'))
        <h2>Error: {{Session::pull('valitator_error')}}</h2>
    @endif

</body>
</html>