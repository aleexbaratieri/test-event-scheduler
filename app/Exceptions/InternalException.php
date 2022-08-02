<?php

namespace App\Exceptions;

use Exception;

class InternalException extends Exception
{
     /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        if($this->getMessage()) {
            return response()->json([
                'mensagem' => $this->getMessage()
            ], $this->getCode() ?? 500);
        }
        
        return response()->json([
            'mensagem' => "Ocorreu um erro interno, caso continue entre em contato com administrador."
        ], 500);
    }
}
