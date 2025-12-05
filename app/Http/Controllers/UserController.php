<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function indexAdmin()
    {
        $vsusuarios = User::where('activo', '=', 1)->get();
        $usuarios = $this->cargarDT($vsusuarios);
        return view('usuarios.indexAdmin', compact('usuarios'));
    }
    public function cargarDT($consulta)
    {
        $usuario = [];

        foreach ($consulta as $key => $value) {

            $ruta = "eliminar" . $value['id'];
            $eliminar = route('usuarios.destroy', $value->id);
            $actualizar =  route('usuarios.edit', $value->id);


            $acciones = view('partials.acciones', compact('value', 'ruta', 'eliminar', 'actualizar'))->render();



            $libro[$key] = array(
                $value['name'],
                $value['email'],
                $acciones,
            );
        }

        return $libro;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $usuario = new User();
        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');
        $usuario->password = Hash::make($request->input('password'));
        $usuario->rol = $request->input('rol');

        $usuario->save();


        return redirect()->route('usuarios.indexAdmin')->with(array(
            'message' => 'El usuario se creó correctamente'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['max:255', 'unique:users'],
        ]);

        $usuario = User::find($id);
        $usuario->name = $request->input('name');
        $email = $request->input('email');
        if ($email) {
            $usuario->email = $email;
        }
        $usuario->rol = $request->input('rol');

        $usuario->update();


        return redirect()->route('usuarios.indexAdmin')->with(array(
            'message' => 'El usuario se actualizó correctamente'
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        if ($usuario) {
            $usuario->activo = 0;
            $usuario->delete();
            return redirect()->route('usuarios.indexAdmin')->with(array(
                "message" => "El usuario se ha eliminado correctamente"
            ));
        } else {
            return redirect()->route('home')->with(array(
                "message" => "El usuario que trata de eliminar no existe"
            ));
        }
    }
}
