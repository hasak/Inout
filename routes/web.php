<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Dobavljac;
use App\Mjerna;
use App\Ulaz;
use App\Artikal;
use App\Puzzle;
use App\Sklapalica;

Route::get('/',function(){
	return view('welcome');
});

Route::group(['middleware'=>'auth'],function(){

	Route::get('/stanje/{od}/{do}',function($od,$do){
		$skladiste=Artikal::all();
		$mjjdnce=DB::table('jedinice')->get();
		//$i=0;
		$uliz=DB::table("puzzle")->get();
		if($od=="sve"){
			$prvi=Ulaz::orderBy("id")->first();
			$pocd=$prvi->datumunosa;
		}else $pocd=$od;
		if($do=="sve")
			$krad=date("Y-m-d");
		else $krad=$do;
		$kol=null;
		$pcjn=null;
		foreach($skladiste as $a){
			$kol[$a->id]=DB::table('uliz')->where('artikal',$a->id)->where("datumunosa",">=",$od)->where("datumunosa","<=",$do)->sum('kolicina');
			$koli[$a->id]=DB::table('uliz')->where('artikal',$a->id)->where("datumunosa",">=",$od)->where("datumunosa","<=",$do)->where("kolicina",">=","0")->sum('kolicina');
			if($kol[$a->id])
				$pcjn[$a->id]=$koli[$a->id]?(DB::table('uliz')->where('artikal',$a->id)->where("datumunosa",">=",$od)->where("datumunosa","<=",$do)->where("kolicina",">=","0")->sum('cijena')/$koli[$a->id]):0;
			else $pcjn[$a->id]=0;
		}
		$dbv=DB::table('dobavljaci')->get();
		$zadnje=Ulaz::where("kolicina",">=","0")->orderBy("id","desc")->take(5)->get();
		$tajtll="Stanje artikala od ".date("d.m.Y.",strtotime($pocd))." do ".date("d.m.Y.",strtotime($krad));
		return view('stanje',compact('skladiste','mjjdnce','kol','tajtll','pcjn','uliz','dbv',"zadnje","pocd","krad"));
	});

	Route::get('/stanje',function(){
		$skladiste=Artikal::all();
		$mjjdnce=DB::table('jedinice')->get();
		//$i=0;
		$uliz=DB::table("puzzle")->get();
		$kol=null;
		$pcjn=null;
		foreach($skladiste as $a){
			$kol[$a->id]=DB::table('uliz')->where('artikal',$a->id)->sum('kolicina');
			$koli[$a->id]=DB::table('uliz')->where('artikal',$a->id)->where("kolicina",">=","0")->sum('kolicina');
			if($kol[$a->id])
				$pcjn[$a->id]=$koli[$a->id]?(DB::table('uliz')->where('artikal',$a->id)->where("kolicina",">=","0")->sum('cijena')/$koli[$a->id]):0;
			else $pcjn[$a->id]=0;
		}
		$dbv=DB::table('dobavljaci')->get();
		$zadnje=Ulaz::where("kolicina",">=","0")->orderBy("id","desc")->take(5)->get();
		$prvi=Ulaz::orderBy("id")->first();
		$pocd=$prvi->datumunosa;
		$krad=date("Y-m-d");
		$tajtll="Trenutno stanje artikala";
		return view('stanje',compact('skladiste','mjjdnce','kol','tajtll','pcjn','uliz','dbv',"zadnje","pocd","krad"));
	});

	Route::post('/unesiar',function(){
		$ubazu=new Ulaz;

		$ubazu->artikal=request('artical');
		$ubazu->kolicina=request('koliciina');
		$ubazu->cijena=request('cijenaa')*request('koliciina');
		$ubazu->dobavljac=request("dobavljac");
		$ubazu->opis=request("opis");
		$ubazu->datumunosa=request('datumzaunos');
		//$ubazu->puzla=0;
		$ubazu->user=Auth::id();

		$ubazu->save();
		return "Artikal je uspješno dodan u bazu";
	});

	Route::get('/unesiar',function(){
		return redirect('/');
	});

	Route::post('/noviar',function(){
		$in=new Artikal;
		$in->ime=request('artkl');
		$in->jedmj=request('mjdnica');
		$in->user=Auth::id();
		$in->save();
		return "Artikal dodan";
	});

	Route::get('/sklapalica',function(){
		$sk=Artikal::all();
		$mj=DB::table('jedinice')->get();
		$pz=Puzzle::all();
		$skl=Sklapalica::all();
		$kol=null;
		$pcjn=null;
		foreach($sk as $a){
			$kol[$a->id]=DB::table('uliz')->where('artikal',$a->id)->sum('kolicina');
			$koli[$a->id]=DB::table('uliz')->where('artikal',$a->id)->where("kolicina",">=","0")->sum('kolicina');
			if($kol[$a->id])
				$pcjn[$a->id]=$koli[$a->id]?(DB::table('uliz')->where('artikal',$a->id)->where("kolicina",">=","0")->sum('cijena')/$koli[$a->id]):0;
			else $pcjn[$a->id]=0;
		}
		return view("sklapalica",compact('sk','mj','pz','skl','kol','pcjn'));
	});

	Route::post('/sklopi',function(){
		//dd(request());
		$in=new Puzzle;
		$in->ime=request('imee');
		$in->cijena=request('cjna');
		$in->user=Auth::id();
		$in->save();
		$do=request("ukol");
		$i=1;
		while($i<=$do){
			if(isset($_REQUEST['k'.$i]) and $_REQUEST['k'.$i]!="" and isset($_REQUEST['artical'.$i]) and $_REQUEST['artical'.$i]!=""){
				$inn=new Sklapalica;
				$inn->idpuzle=$in->id;
				$inn->idart=request('artical'.$i);
				$inn->kolicina=request('k'.$i);
				$inn->save();
			}
			$i++;
		}
		return "Uspješno sklopljeno";
	});

	Route::get('/sklopi',function(){
		redirect('/');
	});

	Route::post('/raskl',function(){
		$id=request("ide");
		$ime=DB::table('puzzle')->where("id",$id)->value("ime");
		DB::table('sklapalica')->where("idpuzle",$id)->delete();
		DB::table('puzzle')->where("id",$id)->delete();
		return $ime;
	});

	Route::post('/raskld',function(){
		$id=request("ide");
		$ime=DB::table('dobavljaci')->where("id",$id)->value("ime");
		DB::table('dobavljaci')->where("id",$id)->delete();
		return $ime;
	});

	Route::post('/raskldd',function(){
		$id=request("ide");
		$ime=DB::table('artikli')->where("id",$id)->value("ime");
		DB::table('artikli')->where("id",$id)->delete();
		return $ime;
	});
	Route::post('/rasklddd',function(){
		$id=request("ide");
		//$ime=DB::table('uliz')->where("id",$id)->value("ime");
		DB::table('uliz')->where("id",$id)->delete();
		return "Izbb";
	});

	Route::post('/unesisklop',function(){
		$idpz=request("articalskl");
		$sk=DB::table('artikli')->get();
		foreach($sk as $a){
			$kol[$a->id]=DB::table('uliz')->where('artikal',$a->id)->sum('kolicina');
			$koli[$a->id]=DB::table('uliz')->where('artikal',$a->id)->where("kolicina",">=","0")->sum('kolicina');
			if($kol[$a->id])
				$pcjn[$a->id]=$koli[$a->id]?(DB::table('uliz')->where('artikal',$a->id)->where("kolicina",">=","0")->sum('cijena')/$koli[$a->id]):0;
			else $pcjn[$a->id]=0;
		}
		$skl=DB::table("sklapalica")->where("idpuzle",$idpz)->get();
		foreach($skl as $s){
			$nov=new Ulaz;
			$nov->artikal=$s->idart;
			$nov->kolicina=$s->kolicina*(-request("koliciinaskl"));
			$nov->datumunosa=request("datumzaunosskl");
			$nov->cijena=$pcjn[$s->idart];
			$nov->puzla=$idpz;
			$nov->user=Auth::id();
			$nov->save();
		}
		return "Izlaz dodan";
	});

	Route::get("/skladiste",function(){
		$art=DB::table("artikli")->get();
		//$inout=DB::table("uliz")->orderBy("id","desc")->get();
		$inout=Ulaz::orderBy("id","desc")->get();
		//dd($inout[0]->dobavljaci);
		$mjjdnce=DB::table("jedinice")->get();
		$puzzle=DB::table("puzzle")->get();
		$users=DB::table("users")->get();
		$dobavljaci=Dobavljac::all();

		return view("skladiste",compact('art','inout','mjjdnce','puzzle','users','dobavljaci'));
	});

	Route::get("/dobavljaci",function(){
		$art=Dobavljac::all();
		$users=DB::table("users")->get();
		return view("dobavljaci",compact('art','users'));
	});


	Route::post('/sklopid',function(){
		$in=new Dobavljac;
		$in->ime=request('imeed');
		$in->opis=request('opisd');
		$in->userid=Auth::id();
		$in->save();
		return "Dobavljač dodan";
	});

	Route::get("/artikli",function(){
		$art=Artikal::all();
		$users=DB::table("users")->get();
		$mjjdnce=Mjerna::all();
		return view("artikli",compact('art','mjjdnce','users'));
	});


	Route::post('/sklopidd',function(){
		$in=new Artikal;
		$in->ime=request('imeed');
		$in->jedmj=request('opisd');
		$in->user=Auth::id();
		$in->save();
		return "Artikal dodan";
	});

	Route::post('/jedanart',function(){
		$id=request('id');
		$od=request("od");
		$do=request("ddo");
		$koj=request("at");
		if($koj=="o1"){
			$kol=DB::table('uliz')->where('artikal',$id)->where("datumunosa",">=",$od)->where("datumunosa","<=",$do)->where("kolicina",">=","0")->sum('kolicina');
			$bl=Ulaz::where("artikal",$id)->where("datumunosa",">=",$od)->where("datumunosa","<=",$do)->where("kolicina",">=","0")->get();
		}
		else if($koj=="o3"){
			$kol=DB::table('uliz')->where('artikal',$id)->where("datumunosa",">=",$od)->where("datumunosa","<=",$do)->where("kolicina","<","0")->sum('kolicina');
			$bl=Ulaz::where("artikal",$id)->where("datumunosa",">=",$od)->where("datumunosa","<=",$do)->where("kolicina","<","0")->get();
		}
		else {
			$kol=DB::table('uliz')->where('artikal',$id)->where("datumunosa",">=",$od)->where("datumunosa","<=",$do)->sum('kolicina');
			$bl=Ulaz::where("artikal",$id)->where("datumunosa",">=",$od)->where("datumunosa","<=",$do)->get();
		}
		if(!$bl) return "<h3>Nema unosa za ovaj artikal</h3>";

		$art=DB::table("artikli")->where("id",$id)->first();
		$mjd=DB::table("jedinice")->where("id",$art->jedmj)->first();
		$zar="<table id='arttbl' class='table table-hover ntb table-sm'>
				<thead><tr class='nemoj'>
				<th><span class='fas fa-hashtag'></span> ID</th>
				<th class='text-right'><span class='fas fa-truck'></span> Dobavljač</th>
				<th class='text-center'><span class='fas fa-file-alt'></span> Opis</th>
				<th class='text-right'><span class='fas fa-calendar-alt'></span> Datum unosa</th>
				<th class='text-right'><span class='fas fa-cubes'></span> Količina</th>
				<th class='text-right'><span class='fas fa-dollar-sign'></span> Cijena</th>
				<th class='text-right'><span class='fas fa-euro-sign'></span> Vrijednost</th>
				</tr>
				</thead>";
		$zbir=0;
		$km="<span data-toggle='tooltip' data-placement='top' title='Konvertibilna Marka'>KM</span>";
		foreach($bl as $b){
			$koli=DB::table('uliz')->where('artikal',$id)->where("datumunosa",">=",$od)->where("datumunosa","<=",$do)->where("id","<=",$b->id)->where("kolicina",">=","0")->sum('kolicina');
			if($kol)
				$pcjn=$koli?(DB::table('uliz')->where('artikal',$id)->where("datumunosa",">=",$od)->where("datumunosa","<=",$do)->where("id","<=",$b->id)->where("kolicina",">=","0")->sum('cijena')/$koli):0;
			else $pcjn=0;
			$mj="<span class='font-italic' data-toggle='tooltip' data-placement='top' title='".$mjd->ime."'>".$mjd->skracenica."</span>";
			if($b->kolicina<0){
				$redd="table-warning izl";
				$secc="<span class='text-secondary mali'>".$b->puzle['ime']."</span>";
			}else{
				$redd="nenee";
				$secc="";
			}
			if($b->kolicina<0)
				$cudoo=$pcjn;
			else $cudoo=$b->cijena/$b->kolicina;
			$nestoo=$cudoo*$b->kolicina;
			$zar.="<tr class='zareddi $redd' data-date='$b->datumunosa'>
<td>$b->id</td>
<td class='text-right'>".$b->dobavljaci->ime."</td>
<td class='text-center'>$b->opis</td>
<td class='text-right'>".date("d.m.Y.",strtotime($b->datumunosa))."</td>
<td class='text-right'>$secc $b->kolicina $mj</td>
<td class='text-right'>".number_format($cudoo,2,",",".")." $km</td>
<td class='text-right'>".number_format($nestoo,2,",",".")." $km</td>
</tr>";
			$zbir+=$nestoo;
		}
		$zbir=number_format($zbir,2,",",".");
		$zar.="<tr class='ukupnored'>
									<td>Σ</td>
									<td class='text-right'>Ukupno</td>
									<td colspan='4'></td>
									<td class='text-right'><span id='stavizb'>".$zbir."</span> $km</td>
								</tr></table><input type='hidden' id='ideideide' value='".$id."'>";
		return $zar;
	});
});

Route::get('o',function(){
	return view('about');
});
Auth::routes();