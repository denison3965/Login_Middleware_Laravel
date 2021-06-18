<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ProdutoAmin;
use Illuminate\Http\Request;

class ProdutoControlador extends Controller
{

    private $produtos = ["Televisao 40", "Notebook", "Impresora", "HD Externo"];

    public function __construct()
    {
        $this->middleware(ProdutoAmin::class);
    }
    
    public function index() 
    {
        echo "<h3>Produtos</h3>";

        echo "<ol>";

            foreach( $this->produtos as $produto)
            {
                echo '<li>' . $produto . '</li>';
            }

        echo "</ol>";
    }
}
