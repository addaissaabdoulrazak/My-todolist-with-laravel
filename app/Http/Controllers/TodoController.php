<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Todolist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 
use RealRashid\SweetAlert\Facades\Alert;

class TodoController extends Controller
{
    /**
     *  Adding a new feature by extention in a Controller 
     */
    protected $users;

    public function __construct()
    {
        $this->users = User::getAllUser();
    }


    /**
     * Assign a todo to an user
     */
    public function affectedTo($todos_id, $user_id)
    {
        $todo = Todolist::find($todos_id);
        $todo->affectedTo_id = $user_id;
        $todo->affectedBy_id = Auth::user()->id;
        $todo->save();
        return back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Query buider
        // $datas = DB::table('Todolist')->paginate(5);

        // afficher uniquement les Todo qui sont affecter a l'utilisateur courant(celui  qui est actuelement connecter)
        $userID = Auth::user();
        // $datas = DB::table('todolist')->where('affectedTo_id', $userID)
        //     ->orderBy('id', 'desc')
        //     ->paginate(5);
        $datas=Todolist::where('affectedTo_id', $userID)
            ->orderBy('id', 'desc')
            ->paginate(5);
            
        // get all user
        $users = $this->users;
        /* la method compact qui a pour specifité de prendre  le nom de la variable entre côte et  sans compact('datas')*/
        return view('todos.index', compact('datas', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formularData = new Todolist();
        $formularData->creator_id = Auth::user()->id;
        $formularData->affectedTo_id = Auth::user()->id;
        $formularData->affectedBy_id = 0;
        $formularData->name = $request->titre;
        $formularData->description = $request->description;
        $formularData->save();
        Alert::success('Success Title', 'Success Message');
        return Redirect()->route('todos.index');
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

    public function editModel(Todolist $modelTodo)
    {
        return view('todos.edit')->with('modelTodo', $modelTodo);
    }
    # Oubien 
    public function edit(Todolist $todo)
    {
        //$todo = Todolist::find($id);
        return view("todos.edit")->with('todo', $todo);
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
        if (!isset($request->done)) {
            $request['done'] = 0;
        }

        $todo = Todolist::find($id);
        $todo->name = $request->name;
        $todo->description = $request->description;
        $todo->done = $request->done;
        $todo->save();
        //alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
        ## i don't use the save() method

        return redirect()->route("todos.index")->with('success', 'modification avec succes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // using a html element form this is a rason which one
    public function destroy($id)
    {
        DB::table('todolist')->where('id', $id)->delete();
        toast('Suppression effectuer avec succes', 'success');
        return back();
    }

    # -> Or
    public function delete(Todolist $model)
    {
        $model->delete();
        return back();
    }

    /**
     * display a listing of done's Todo
     */
    public function done()
    {
        $datas = Todolist::where('done', 1)->paginate(5);
        $users = $this->users;
        return view('todos.index', compact("datas", 'users'));
    }
    /**
     * Display a listing of undone's Todo
     */
    public function undone()
    {
        $datas = Todolist::where('done', 0)->paginate(5);
        $users = $this->users;
        return view('todos.index', compact("datas", 'users'));
    }
    // using a html element form this is a rason which one
    public function makedone($id)
    {
        $todo = Todolist::find($id);
        if ($todo->done == 1) {
            $todo->done = 0;
            $todo->update();
            notify()->warning('la todo ' . $id . ' est ouverte');
            return back();
        } else {
            $todo->done = 1;
            $todo->update();
            notify()->success('la todo ' . $id . ' a bien été terminer');
            return back();
        }
    }
}
