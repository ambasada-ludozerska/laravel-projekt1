<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = DB::select('select * from Items;');
        foreach($items as $item) {
            echo "<pre>ID przedmiotu: ".$item->id."    Nazwa: ".$item->name."    Opis: ".$item->description."    Cena: ".$item->price."    ";
        }    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        echo "<br><br><form method='get' action=''>
                <label for='name'>Nazwa:</label><br>
                <input type='text' id='name' name='name'><br>
                <label for='description'>Opis:</label><br>
                <input type='text' id='description' name='description'><br>
                <label for='price'>Cena:</label><br>
                <input type='number' id='price' name='price'><br>
                <input type='submit' value='Dodaj przedmiot'>
            </form>";
        $name = $_GET['name'];
        $description = (string)$_GET['description'];
        $price = $_GET['price'];
        if(isset($_GET['name']) && isset($_GET['description']) && isset($_GET['price'])) {
            DB::update("insert into Items(name, description, price) values('$name', '$description', $price);");
        }       
    

        return redirect()->action([CRUDController::class, 'index']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = DB::select('select * from Items where id='.$id.';')[0];
        echo "ID przedmiotu: ".$item->id."&nbsp;&nbsp;&nbsp;&nbsp;
        Nazwa: ".$item->name."&nbsp;&nbsp;&nbsp;&nbsp;
        Opis: ".$item->description."&nbsp;&nbsp;&nbsp;&nbsp;
        Cena: ".$item->price;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = DB::select('select * from Items where id='.$id.';')[0];

        echo "<br><form method='get' action=''>
                <label for='id'>ID przedmiotu:</label><br>
                <input type='text' id='id' name='id' value=$item->id><br>
                <label for='name'>Nazwa:</label><br>
                <input type='text' id='name' name='name' value='$item->name'><br>
                <label for='description'>Opis:</label><br>
                <input type='text' id='description' name='description' value='$item->description'><br>
                <label for='price'>Cena:</label><br>
                <input type='number' id='price' name='price' value='$item->price'><br>
                <input type='submit' value='Zapisz'>
            </form>";
        $id = $item->id;
        $newName = $_GET['name'];
        $newDescription = (string)$_GET['description'];
        $newPrice = $_GET['price'];
        if(isset($_GET['name']) && isset($_GET['description']) && isset($_GET['price'])) {
            DB::update("update Items set name='$newName', description='$newDescription', price='$newPrice' where id=$id;");
        }       
    

        return redirect()->action([CRUDController::class, 'index']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = DB::select('select * from Items where id='.$id.';')[0];
        echo "<h3>Czy na pewno chcesz usunąć ten przedmiot?</h3><br>
        ID przedmiotu: ".$item->id."&nbsp;&nbsp;&nbsp;&nbsp;
        Nazwa: ".$item->name."&nbsp;&nbsp;&nbsp;&nbsp;
        Opis: ".$item->description."&nbsp;&nbsp;&nbsp;&nbsp;
        Cena: ".$item->price;

        echo "<form method='get' action=''>
              <input type='submit' name='yes' value='TAK' >
              <input type='submit' name='no' value='NIE'>
              </form>
        ";
        if(isset($_GET['no'])) {
            return redirect()->action([CRUDController::class, 'index']);
        } else if(isset($_GET['yes'])) {
            DB::delete('delete from Items where id='.$id.';');
            return redirect()->action([CRUDController::class, 'index']);
        }
    }
}
