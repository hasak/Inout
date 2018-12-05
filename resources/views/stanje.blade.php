<?php
/**
 * Created by PhpStorm.
 * User: Hasak
 * Date: 21.01.2019.
 * Time: 13:49
 */
?>
@extends('sablon')
@section('title')Stanje @endsection
@section('content')
	<div class="row">
		<div class="col">
			<div class="starter-template">
				<h1 class="display-4"><span class="fas fa-cubes fa-fw"></span> Stanje</h1>
				<p class="lead">U Stanju možete vidjeti, dodati ili napraviti izlaz artikala</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link" id="ulaz-tab" data-toggle="tab" href="#ulaz" role="tab" aria-controls="ulaz"
					   aria-selected="true"><span class="fas fa-arrow-down fa-fw"></span> Ulaz</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" id="stanje-tab" data-toggle="tab" href="#stanje" role="tab"
					   aria-controls="stanje" aria-selected="false"><span class="fas fa-cubes fa-fw"></span> Na
						Stanju</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="izlaz-tab" data-toggle="tab" href="#izlaz" role="tab" aria-controls="izlaz"
					   aria-selected="false"><span class="fas fa-arrow-up fa-fw"></span> Izlaz</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade" id="ulaz" role="tabpanel" aria-labelledby="ulaz-tab">
					<h2 class="phut"><span class="fas fa-arrow-down fa-fw"></span> Ulaz</h2>
					<div class="row">
						<div class="col-12">
							<div class="alert alert-primary my-3"><span class="fas fa-plus-circle"></span> Trebate
								unijeti <strong>novi</strong> artikal? Nema
								problema, <a href="#dodajnovim" class="alert-link" data-toggle="modal">kliknite
									ovdje</a></div>
							<div class="alert alert-danger alert-dismissible nd" role="alert" id="alrtgrska">
								<strong><span class="fas fa-exclamation-triangle"></span> Greška!</strong> Desila se
								greška prilikom dodavanja u bazu<br>
								Error: <span id="greskadodavanja"></span>
								<button type="button" class="close closee" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="alert alert-success alert-dismissible nd" role="alert" id="alrt-dobar">
								<strong><span class="fas fa-check"></span> Dodano</strong><br>
								<span id="kojijedodan" class="font-italic"></span><br>
								<span id="ajaksresp"></span>
								<button type="button" class="close closee" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="alert alert-warning alert-dismissible nd alrtrfs" id="nemojovaj" role="alert">
								<strong><span class="fas fa-redo fa-rotate-90"></span> Oprez!</strong> Ne zaboravite <a
										class="alert-link" href="">osvježiti</a>
								stranicu da bi se vidjele izmjene
							</div>
							<div class="row">
								<div class="col-sm-7">
									<h2><span class="fas fa-plus"></span> Unesite artikal</h2>
									<form id="formica" action="/unesiar" method="post">
										{{csrf_field()}}
										<div class=" align-items-center">
											<div class="form-row">
												<div class="col">
													<div class="form-group">
														<label for="select-artikla"><span
																	class="fas fa-fw fa-box"></span>
															Artikal</label>
														<select name="artical" class="custom-select mb-2"
																id="select-artikla"
																required>
															<option value="" class="d-none" selected disabled>Artikal...
															</option>
															@foreach($skladiste as $a)
																<option value="{{$a->id}}" class="select-art"
																		data-steps="{{$a->mj->steps}}"
																		data-mjid="{{$a->mj->id}}"
																		data-dugamj="{{$a->mj->ime}}"
																		data-mjjd="{{$a->mj->skracenica}}">{{$a->ime}}</option>
															@endforeach
														</select>
													</div>
												</div>
											</div>
											<div class="form-row">
												<div class="col-6">
													<div class="form-group">
														<label for="idkolicine"><span class="fas fa-fw fa-cubes"></span>
															Količina</label>
														<div class="input-group mb-2">
															<input type="number" min="0" step="1" name="koliciina"
																   class="form-control"
																   id="idkolicine" placeholder="Količina" required>
															<div class="input-group-append">
												<span class="input-group-text" id="mjernajedtext"
													  data-mjid="{{$mjjdnce[0]->id}}" data-toggle="tooltip"
													  data-placement="top"
													  title="{{$mjjdnce[0]->ime}}">{{$mjjdnce[0]->skracenica}}</span>
															</div>
														</div>
													</div>
												</div>
												<div class="col-6">
													<div class="form-group">
														<label for="cijenaa"><span
																	class="fas fa-fw fa-dollar-sign"></span>
															Cijena</label>
														<div class="input-group mb-2">
															<input type="number" min="0" step="0.01" name="cijenaa"
																   class="form-control"
																   id="cijenaa" placeholder="Cijena" required>
															<div class="input-group-append">
												<span class="input-group-text" data-toggle="tooltip"
													  data-placement="top" title="Konvertibilna Marka">KM</span>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="form-row">
												<div class="col-6">
													<div class="form-group">
														<label for="dbvljc"><span class="fas fa-fw fa-truck"></span>
															Dobavljač</label>
														<select name="dobavljac" class="custom-select mb-2" id="dbvljc"
																required>
															<option value="" class="d-none" selected disabled>
																Dobavljač...
															</option>
															@foreach($dbv as $a)
																<option value="{{$a->id}}"
																		class="select-art">{{$a->ime}}</option>
															@endforeach
														</select>
													</div>
												</div>
												<div class="col-6">
													<div class="form-group">
														<label for="opiss"><span class="fas fa-fw fa-file-alt"></span>
															Opis</label>
														<div class="input-group mb-2">
															<input type="text" placeholder="Opis" id="opiss" name="opis"
																   class="form-control">
														</div>
													</div>
												</div>
											</div>
											<div class="form-row">
												<div class="col-6">
													<div class="form-group">
														<label for="datumun"><span
																	class="fas fa-fw fa-calendar-alt"></span>
															Datum ulaza</label>
														<div class="input-group mb-2">
															<input type="date" placeholder="Datum" id="datumun"
																   name="datumzaunos"
																   class="form-control" value="{{date("Y-m-d")}}"
																   required>
														</div>
													</div>
												</div>
												<div class="col-6">
													<div class="form-group">
														<label>&nbsp;</label>
														<button type="submit"
																class="btn btn-primary btn-block mb-2"><span
																	class="fas fa-check"></span> Unesi
														</button>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="col-sm-5">
									<h2><span class="fas fa-redo fa-rotate-90"></span> Zadnji unešeni artikli</h2>
									<table class="table ntb table-hover">
										<thead>
										<tr>
											<th><span class="fas fa-hashtag"></span> ID</th>
											<th><span class="fas fa-box"></span> Artikal</th>
											<th><span class="fas fa-cubes"></span> Količina</th>
											<th><span class="fas fa-dollar-sign"></span> Cijena</th>
										</tr>
										</thead>
										<tbody>
										@foreach($zadnje as $a)
											<tr>
												<td>{{$a->id}}</td>
												<td>{{$a->art->ime}}</td>
												<td>{{$a->kolicina}} <span class="font-italic" data-toggle="tooltip"
																		   data-placement="top"
																		   title="{{$a->art->mj->ime}}">{{$a->art->mj->skracenica}}</span>
												</td>
												<td>{{number_format($a->cijena/$a->kolicina,2,",",".")}} <span
															data-toggle="tooltip"
															data-placement="top"
															title="Konvertibilna Marka">KM</span>
												</td>
											</tr>
										@endforeach
										</tbody>
									</table>
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="tab-pane fade show active" id="stanje" role="tabpanel" aria-labelledby="stanje-tab">
					<h2 class="phut"><span class="fas fa-cubes fa-fw"></span> {{$tajtll}}</h2>
					<div class="row">
						<div class="col">
							<div class="alert alert-warning alert-dismissible nd alrtrfs" role="alert">
								<strong><span class="fas fa-redo fa-rotate-90"></span> Oprez!</strong> Ne zaboravite <a
										class="alert-link" href="">osvježiti</a>
								stranicu da bi se vidjele izmjene
							</div>
							<form id="stanjefilter" action="{{asset("/stanjef")}}" method="post" class="form-inline text-center form-row">
								<div class="col-sm-5 mb-2">
									<label for="pocetakdate"><span class="fa-fw far fa-calendar-alt"></span> Početni
										datum:&nbsp;</label>
										<input id="pocetakdate" name="pocetakdate" data-odildo="od" type="date"
											   class="datess form-control ptr" value="{{$pocd}}">
								</div>
								<div class="col-sm-5 mb-2">
									<label for="krajdate"><span class="fa-fw far fa-calendar-alt"></span> Krajnji
										datum:&nbsp;</label>
										<input id="krajdate" name="krajdate" data-odildo="do" type="date"
											   class="datess form-control ptr" value="{{$krad}}">
								</div>
								<div class="col-sm-2 mb-2 mt-4">
									<button class="btn btn-primary" type="submit"><span class="fas fa-search"></span> Odaberi</button>
								</div>
							</form>
							<table class="table ntb table-sm table-hover">
								<thead>
								<tr>
									<th><span class="fas fa-hashtag"></span> ID</th>
									<th><span class="fas fa-box"></span> Artikal</th>
									<th class="text-right"><span class="fas fa-cubes"></span> Količina</th>
									<th class="text-right"><span class="fas fa-dollar-sign"></span> Prosječna cijena
									</th>
									<th class="text-right"><span class="fas fa-euro-sign"></span> Vrijednost</th>
								</tr>
								</thead>
								<tbody>
								@php $zbir=0; @endphp
								@foreach($skladiste as $a)
									<tr class="klick" data-idd="{{$a->id}}" data-namee="{{$a->ime}}">
										<td>{{$a->id}}</td>
										<td>{{$a->ime}}</td>
										<td class="text-right">{{$kol[$a->id]}} <span class="font-italic"
																					  data-toggle="tooltip"
																					  data-placement="top"
																					  title="{{$a->mj->ime}}">{{$a->mj->skracenica}}</span>
										</td>
										<td class="text-right">{{number_format($pcjn[$a->id],2,",",".")}} <span
													data-toggle="tooltip"
													data-placement="top"
													title="Konvertibilna Marka">KM</span></td>
										<td class="text-right">{{number_format($pcjn[$a->id]*$kol[$a->id],2,",",".")}}
											<span data-toggle="tooltip"
												  data-placement="top"
												  title="Konvertibilna Marka">KM</span>
										</td>
									</tr>
									@php $zbir+=$pcjn[$a->id]*$kol[$a->id]; @endphp
								@endforeach
								<tr class="ukupnored">
									<td>Σ</td>
									<td colspan="3">Ukupno</td>
									<td class="text-right">{{number_format($zbir,2,",",".")}} <span
												data-toggle="tooltip"
												data-placement="top"
												title="Konvertibilna Marka">KM</span></td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="izlaz" role="tabpanel" aria-labelledby="izlaz-tab">
					<h2 class="phut"><span class="fas fa-arrow-up fa-fw"></span> Izlaz</h2>
					<div class="row">
						<div class="col">
							<div class="alert alert-warning alert-dismissible nd alrtrfs" id="alrtskl" role="alert">
								<strong><span class="fas fa-redo fa-rotate-90"></span> Oprez!</strong> Ne zaboravite <a
										class="alert-link" href="">osvježiti</a>
								stranicu da bi se vidjele izmjene
							</div>
							<div class="alert alert-danger alert-dismissible nd" role="alert" id="alrtgrskaskl">
								<strong><span class="fas fa-exclamation-triangle"></span> Greška!</strong> Desila se
								greška prilikom dodavanja u bazu<br>
								Error: <span id="greskadodavanjaskl"></span>
								<button type="button" class="close closee" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="alert alert-success alert-dismissible nd" role="alert" id="alrt-dobarskl">
								<strong><span class="fas fa-check"></span> Dodano</strong><br>
								<span id="kojijedodanskl" class="font-italic"></span><br>
								<span id="ajaksrespskl"></span>
								<button type="button" class="close closee" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form id="formicaaa" action="/unesisklop" method="post">
								{{csrf_field()}}
								<div class="form-row align-items-center row">
									<div class="col-sm-5">
										<select name="articalskl" class="custom-select mb-2" id="select-artiklaskl"
												required>
											<option value="" selected>Izaberi...</option>
											@foreach($uliz as $a)
												<option value="{{$a->id}}" class="select-art">{{$a->ime}}
													· {{$a->cijena}} KM
												</option>
											@endforeach
										</select>
									</div>
									<div class="col-sm-3">
										<label class="sr-only" for="inlineFormInputGroup">Količina</label>
										<div class="input-group mb-2">
											<input type="number" min="0" step="1" name="koliciinaskl"
												   class="form-control" id="idkolicineskl" placeholder="Količina"
												   required>
											<div class="input-group-append">
												<span class="input-group-text" id="mjernajedtextskl"
													  data-mjid="{{$mjjdnce[0]->id}}" data-toggle="tooltip"
													  data-placement="top"
													  title="{{$mjjdnce[0]->ime}}">{{$mjjdnce[0]->skracenica}}</span>
											</div>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="input-group mb-2">
											<input type="date" placeholder="Datum" id="datumunskl" name="datumzaunosskl"
												   class="form-control" value="{{date("Y-m-d")}}" required>
										</div>
									</div>
									<div class="col-sm-2">
										<button type="submit" class="btn btn-primary btn-block mb-2"><span
													class="fas fa-check"></span> Unesi
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="dodajnovim" tabindex="-1" role="dialog" aria-labelledby="dodajnovimLabel"
		 aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="dodajnovimLabel"><span class="fas fa-certificate"></span> Novi Artikal
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="hmm" class="formm" action="/noviar" method="post">
					<div class="modal-body">
						<div class="alert alert-danger alert-dismissible nd" role="alert" id="alrtgrskamd">
							<strong><span class="fas fa-exclamation-triangle"></span> Greška!</strong> Desila se greška
							prilikom dodavanja u bazu<br>
							Error: <span id="greskadodavanjamd"></span>
							<button type="button" class="close closee" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="alert alert-success alert-dismissible nd" role="alert" id="alrt-dobarmd">
							<strong><span class="fas fa-check"></span> Dodano</strong><br>
							<span id="kojijedodanmd" class="font-italic"></span><br>
							<span id="ajaksrespmd"></span>
							<button type="button" class="close closee" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="form-row align-items-center form-group row">
							<label for="artkl" class="col-3 col-form-label"><span class="fas fa-file-signature"></span>
								Ime artikla:</label>
							<div class="col-9">
								<div class="input-group">
									<input type="text" id="artkl" name="artkl" class="form-control"
										   placeholder="Artikal" required>
									<div class="input-group-append">
										<select name="mjdnica" id="mjdnica" class="custom-select" required>
											@foreach($mjjdnce as $m)
												<option value="{{$m->id}}"
														data-ime="{{$m->ime}}">{{$m->skracenica}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="reset" id="rstbtnmdl" class="btn btn-secondary"><span class="fas fa-undo"></span>
							Resetuj
						</button>
						<button type="submit" id="sbtrr" class="btn btn-primary"><span class="fas fa-save"></span>
							Sačuvaj
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="sveoart" tabindex="-1" role="dialog" aria-labelledby="dodajnovimLabel"
		 aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="sveoLabel"><span class="fas fa-file-signature"></span> Artikal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="grupabtnn" class="nd mb-2 text-center">
						<div class="row text-center mb-2">
							<div class="col-6">
								<label for="pocetakdate"><span class="far fa-calendar-alt"></span> Početni
									datum:</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><span class="fas fa-arrow-left"></span></span>
									</div>
									<input id="pocetakdate" name="pocetakdate" data-odildo="od" type="date"
										   class="dates form-control ptr">
								</div>
							</div>
							<div class="col-6">
								<label for="krajdate"><span class="far fa-calendar-alt"></span> Krajnji datum:</label>
								<div class="input-group">
									<input id="krajdate" name="krajdate" data-odildo="do" type="date"
										   class="dates form-control ptr">
									<div class="input-group-append">
										<span class="input-group-text"><span class="fas fa-arrow-right"></span></span>
									</div>
								</div>
							</div>
						</div>
						<div id="grupabtn" class="btn-group mb-2 btn-group-toggle d-flex" data-toggle="buttons">
							<label class="btn btn-light w-100 clss ptr">
								<input type="radio" name="options" id="option1" data-op="o1" value="o1"
									   autocomplete="off"> <span class="fa-fw fas fa-arrow-down"></span> Ulazi
							</label>
							<label class="btn btn-light w-100 clss ptr active" id="klasiraj">
								<input type="radio" name="options" id="option2" data-op="o2" value="o2"
									   autocomplete="off" checked> <span class="fa-fw fas fa-asterisk"></span> Svi
							</label>
							<label class="btn btn-light w-100 clss ptr">
								<input type="radio" name="options" id="option3" data-op="o3" value="o3"
									   autocomplete="off"> <span class="fa-fw fas fa-arrow-up"></span> Izlazi
							</label>
						</div>
					</div>
					<div id="sveoartrespns">
						<h1 class="text-center"><span class="fas fa-sync-alt fa-fw fa-spin"></span></h1>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
