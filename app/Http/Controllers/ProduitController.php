<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Produit;
use Input ;
use App\Operation;
class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produits = Produit::paginate(10);
		return view('produit.index', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
		$this->validate($request, [
    			'nom' => 'required',
    			'code' => 'required',
			'description' => 'required',				
			'quantite' => 'required|integer',				
			'prix_unitaire' => 'required|integer',
			]);

				$produit = new Produit ; 
					$produit->nom = $request->nom;
					$produit->code = $request->code;
					$produit->description = $request->description;
					$produit->quantite = $request->quantite;
					$produit->prix_unitaire = $request->prix_unitaire;
					$produit->save();

	
    		$request->session()->flash('alert-success', 'Votre Produit à été ajouter avec succes !');
		return redirect()->route('produit.index');
    }


    public function showaddform()
    {
       	return view('produit.add');
    }

    public function showmodifier($id)
    {

		$produit = Produit::where('id',$id)->get() ; 
		return view('produit.modifier',compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
		$this->validate($request, [
    			'nom' => 'required',
    			'code' => 'required',
			'description' => 'required',				
			'prix_unitaire' => 'required|integer',
			]);

				$produit = Produit::find($request->id); 
					$produit->nom = $request->nom;
					$produit->code = $request->code;
					$produit->description = $request->description;
					$produit->prix_unitaire = $request->prix_unitaire;
					$produit->save();

		
    		$request->session()->flash('alert-success', 'Votre Produit à été modifier avec succes !');
		return redirect()->route('produit.index');        





    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function operation(Request $request)
    {
	if ($request->type == 'ajouts') {
		$this->validate($request, [
    			'newquantite' => 'required|integer|min:0',
			'description' => 'required'
			]);
	$newquantite = $request->newquantite;
	if ($newquantite == 0) { return view('produit.index'); }
	$id = $request->id;
	$p = Produit::find($id);
	$p->quantite = $p->quantite + $newquantite ;
	$p->save();
	$op = new Operation ;

	$op->type = $request->type ;
	$op->id_produit = $request->id;
	$op->qauntite = $newquantite ;
	$op->description = $request->description ;
	$op->save();

	$request->session()->flash('alert-success', 'Vous avez ajouter une quantité avec succes !');      		
		return view('produit.index');
    

					}
else if ($request->type == 'retraits') {

			/* $this->validate($request, [
    			'newquantite' => 'required|integer|min:0',
			'description' => 'required'
			]); */
	$retraitsquantite = $request->retraitsquantite;
	 // if ($newquantite == 0) { return view('produit.index'); }
	$id = $request->id;
	$p = Produit::find($id);
	$p->quantite = $p->quantite - $newquantite ;
	$p->save();
	$op = new Operation ;

	$op->type = $request->type ;
	$op->id_produit = $request->id;
	$op->qauntite = $retraitsquantite ;
	$op->description = $request->description ;


}


}


    public function destroy(Request $request)
    {
	$produit = Produit::find($request->id);
		$produit->delete();
	if ($produit) {
		$request->session()->flash('alert-success', 'Votre Produit à été supprimer avec succes !');      
			}		
		return redirect()->route('produit.index');

    }

	public function statics () {

		return view('statics.index');
	

}



	public function showstatics(Request $request) {

	$month = $request->month ;
	$year = $request->year ;
	$type = $request->type ;
	if ( $type == 'ajouts' || $type == 'retraits') {
	$operations = Operation::whereRaw("MONTH(created_at) = '$month' ")->whereRaw("YEAR(created_at) = '$year' ")->where('type',$type)->get();
	
	$produit_data = array();
	foreach ($operations as $op)
		 {
			$s = Produit::find($op->id_produit);
			//$k = compact('s');
			$b = array();
			$b[0] = $s->nom ;
			$b[1] = $s->code ;
			array_push($produit_data , $b);
		 }

		return view('statics.index')->with('operations',$operations)->with('produit_data',$produit_data);

}

else if ( $type == 'retraitsetajouts' ) {

	$operations = Operation::whereRaw("MONTH(created_at) = '$month' ")->whereRaw("YEAR(created_at) = '$year' ")->get();
	
	$produit_data = array();
	foreach ($operations as $op)
		 {
			$s = Produit::find($op->id_produit);
			//$k = compact('s');
			$b = array();
			$b[0] = $s->nom ;
			$b[1] = $s->code ;
			array_push($produit_data , $b);
		 }

		return view('statics.index')->with('operations',$operations)->with('produit_data',$produit_data);


}

else if ( $month == 'nothing' || $type == 'nothing' ) {

		$request->session()->flash('alert-warning', 'Essayer de choisir un mois ou une option svp .');      
			
		return redirect()->route('statics.index');

}




}

}
