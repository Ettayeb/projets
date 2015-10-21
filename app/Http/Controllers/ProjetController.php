<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Projet ;
use App\Produit;
use App\Models\Client;
use App\ProduitProjet;
use App\Operation;
use Validator;
use Redirect ;
class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	$projets = Projet::paginate(10);        

	$projet_data = array();
	foreach ($projets as $p)
		 {
			$s = Client::find($p->id_client);
			$b = array();
			$b[0] = $s->name ;
			array_push($projet_data , $b);
		 }

		return view('projets.index')->with('projets',$projets)->with('projet_data',$projet_data);


    }
	
	public function add() {


				$produits = Produit::all();
				$clients = Client::all();

					return view('projets.add')->with('produits',$produits)->with('clients',$clients);


}

	public function addprojet(Request $request) {


$ar = array('clients' => $request->clients , 'description' => $request->description ,'date_debut' => $request->date_debut);
$rules = array('clients' => 'integer','description' => 'required','date_debut' => 'required');
$messages = array( 'integer' => 'Essayer de choisir un client svp .' , 'required' => 'Le champ " :attribute " est requis' );

$validator = Validator::make($ar , $rules , $messages);

if ($validator->fails()) {

return Redirect::to('/projets/add')->withInput()->withErrors($validator);


}

		$code = $request->clients.$request->date_debut.$request->date_fin ;
	$projet = new Projet;
	$projet->id_client = $request->clients ;
	$projet->code = $code ;
	$projet->description = $request->description ;
	$projet->date_debut = $request->date_debut;
	$projet->date_fin = $request->date_fin;
	$projet->save();
		
	if ($request->type == 'retraits') {

		$retraitsquantite = $request->retraitsquantite;


// testing for products if the quantity okey

	if (count($request->produits) ){
	for ($i=0; $i<count($retraitsquantite);$i++) {

		$id_produit = $request->produits[$i];
		$quantite = $retraitsquantite[$i];
		if ( intval($id_produit) ) {

		$p = Produit::find($id_produit);
if ( intval($quantite) > $p->quantite )
{


return Redirect::back()->withErrors(['Produit '.$p->nom.' :', 'Quantité insuffisante .']);

}



}

}}

// end test quantity



	$des = 'retrait de quantité pour projet : '.$code ;
	$retraitsquantite = $request->retraitsquantite;

	$pr = Projet::where('code',$code)->get();
	$pe = compact('pr',$pr);
	if (count($request->produits)){
	for ($i=0; $i<count($retraitsquantite);$i++) {

		$id_produit = $request->produits[$i];
		$quantite = $retraitsquantite[$i];
		if ( intval($id_produit) ) {
		$p = Produit::find($id_produit);
		$p->quantite = $p->quantite - $quantite ;
		$p->save();

			$op = new Operation ;
		$op->type = $request->type ;
		$op->id_produit = $id_produit;
		$op->qauntite = $quantite ;
		$op->description = $des ;
		$op->save();
			$pp = new ProduitProjet ;
		$pp->id_projet = $pr[0]->id ;
		$pp->id_produit = $id_produit;
		$pp->quantite = $quantite;
			$pp->save();
	}
	}


}
}
	$request->session()->flash('alert-success', 'Vous avez ajouter un projet avec succes !');      		
		return redirect()->route('projets.index');

}


    public function show($id)
    {

		$projet = Projet::where('id',$id)->get() ; 
		$pp = ProduitProjet::where('id_projet',$id)->get();
			$produits_noms = array();

			foreach ($pp as $s) {
				$pro = Produit::where('id',$s->id_produit)->get();
					array_push($produits_noms , $pro[0]->nom);

			}

				$produits = Produit::all();
				$clients = Client::all();


		return view('projets.afficher')->with('projet',$projet)->with('pp',$pp)->with('produits',$produits)->with('produits_noms',$produits_noms)->with('clients',$clients);


}

 
    public function edit(Request $request)
    {

$ar = array('clients' => $request->clients , 'description' => $request->description ,'date_debut' => $request->date_debut);
$rules = array('clients' => 'integer','description' => 'required','date_debut' => 'required');
$messages = array( 'integer' => 'Essayer de choisir un client svp .' , 'required' => 'Le champ " :attribute " est requis' );

$validator = Validator::make($ar , $rules , $messages);

if ($validator->fails()) {

return Redirect::back()->withInput()->withErrors($validator);


}
        
				if ($request->type == 'retraits') {

		$retraitsquantite = $request->retraitsquantite;


// testing for products if the quantity okey

	if (isset($request->produits)){
	for ($i=0; $i<count($retraitsquantite);$i++) {

		$id_produit = $request->produits[$i];
		$quantite = $retraitsquantite[$i];
		if ( intval($id_produit) ) {
		$p = Produit::find($id_produit);
if ( $quantite > $p->quantite )
{


return Redirect::back()->withErrors(['Produit '.$p->nom.' :', 'Quantité insuffisante .']);

}


}}}

// end test quantity


		$code = $request->clients.$request->date_debut.$request->date_fin ;
	$projet = Projet::find($request->id);
	$projet->id_client = $request->clients ;
	$projet->code = $code ;
	$projet->description = $request->description ;
	$projet->date_debut = $request->date_debut;
	$projet->date_fin = $request->date_fin;
	$projet->save();

	$des = 'retrait de quantité pour projet : '.$code ;
	$retraitsquantite = $request->retraitsquantite;

	$pr = Projet::where('code',$code)->get();

	if (isset($request->produits)){
	for ($i=0; $i<count($retraitsquantite);$i++) {

		$id_produit = $request->produits[$i];
		$quantite = $retraitsquantite[$i];
		if ( intval($id_produit) ) {
		$p = Produit::find($id_produit);
		$p->quantite = $p->quantite - $quantite ;

			//return Redirect::back()->withErrors(['msg', '']);
		$p->save();

			$op = new Operation ;
		$op->type = $request->type ;
		$op->id_produit = $id_produit;
		$op->qauntite = $quantite ;
		$op->description = $des ;
		$op->save();
			$pp = new ProduitProjet ;
		$pp->id_projet = $pr[0]->id ;
		$pp->id_produit = $id_produit;
		$pp->quantite = $quantite;
			$pp->save();
	}
	}
}


}
	$request->session()->flash('alert-success', 'Vous avez modifier votre projet avec succes !');      		
		return redirect()->route('projets.index');




    }

  
    public function destroy(Request $request)
    {
        	$projet = Projet::find($request->id);
		$projet->delete();
	if ($projet) {
		$request->session()->flash('alert-success', 'Votre Projet à été supprimer avec succes !');      
			}		
		return redirect()->route('projets.index');

    }

    public function showmodifier($id)
    {

		$projet = Projet::where('id',$id)->get() ; 
		$pp = ProduitProjet::where('id_projet',$id)->get();
			$produits_noms = array();

			foreach ($pp as $s) {
				$pro = Produit::where('id',$s->id_produit)->get();
					array_push($produits_noms , $pro[0]->nom);

			}

				$produits = Produit::all();
				$clients = Client::all();


		return view('projets.modifier')->with('projet',$projet)->with('pp',$pp)->with('produits',$produits)->with('produits_noms',$produits_noms)->with('clients',$clients);
    }



}
