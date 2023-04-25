<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class Exception
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response{
        try{
            $responde=$next($request);            
        }catch(Exception $ex){
            Log::channel('error')->error('Error en el servidor Exception (catch) | Exception@handle | error: '.$ex->getMessage());
            Session::flash('message','Error en el servidor');
            return null;
            //$responde=redirect()->back();
        }
        return $responde;
    }
}
