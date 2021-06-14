<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteFormRequest;
use App\Models\Cliente;
use App\Models\Plano;
use App\Models\Relationships\ClientePlano;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Throwable;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::with('planos')->get();

        return $clientes->isEmpty()
                    ? response()->json([], 204)
                    : response()->json($clientes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ClienteFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteFormRequest $request)
    {
        DB::beginTransaction();
        try {

            if($request->has('imagem')) {
                if(!$storagePath = $request->file('imagem')->store('avatares')) {
                    throw new FileException(__('Não foi possível salavar a imagem enviada'));
                }

                $request->merge(['avatar' => $storagePath]);
            }

            if(!$request->has('ativo')) {
                $request->merge(['ativo' => true]);
            }

            $cliente = Cliente::create($request->all());

            // caso não seja informado o plano será atribuído o plano free
            if(!$request->has('planos')) {
                $request->merge(['planos' => Plano::where('tipo', 'Free')->pluck('id')->toArray()]);
            }

            // vinculação do plano(s) com o cliente
            foreach($request->planos as $plano) {
                ClientePlano::create([
                    'cliente_id' => $cliente->id,
                    'plano_id' => $plano
                ]);
            }

            DB::commit();
        } catch (Throwable $th) {
            DB::rollBack();

            return response()->json(['message' => $th->getMessage()], 500);
        }

        return response()->json($cliente->load('planos'), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return response()->json($cliente->load('planos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        DB::beginTransaction();
        try {

            $cliente->fill($request->all());
            $cliente->save();

            if($request->has('planos')) {
                foreach($request->planos as $planoId) {
                    // adiciona plano que não estava vinculado com o usuário até o momento
                    if($cliente->planos()->where('id', $planoId)->doesntExist()) {
                        ClientePlano::create([
                            'cliente_id' => $cliente->id,
                            'plano_id' => $planoId
                        ]);
                    }

                    // planos que estavam vinculado com o usuário que serão removidos
                    $planosParaRemover = $cliente
                                            ->planos()
                                            ->whereNotIn('id', $request->planos);

                    if($planosParaRemover->get()->isNotEmpty()) {
                        $cliente->planos()->detach($planosParaRemover->pluck('id')->toArray());
                    }
                }
            }

            DB::commit();
        } catch (Throwable $th) {
            DB::rollBack();

            return response()->json(['message' => $th->getMessage()], 500);
        }

        return response()->json($cliente->load('planos'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Cliente $cliente)
    {
        if($cliente->estado == 'SP' && $cliente->planos->contains('tipo','Free')) {
            return response()->json(['message' => __('http.403')], 403);
        }

        DB::beginTransaction();
        try {

            $cliente->planos()->detach();
            $cliente->delete();

            DB::commit();
        } catch (Throwable $th) {
            DB::rollBack();

            return response()->json(['message' => $th->getMessage()], 500);
        }

        return response()->json(true);
    }
}
