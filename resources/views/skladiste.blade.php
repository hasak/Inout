<?php
/**
 * Created by PhpStorm.
 * User: Hasak
 * Date: 20.01.2019.
 * Time: 05:39
 */
?>
@extends('sablon')
@section('title')Skladište @endsection
@section('content')
	<div class="row">
		<div class="col">
			<div class="starter-template">
				<h1 class="display-4"><span class="fas fa-box fa-fw"></span> Skladište</h1>
				<p class="lead">U Skladištu možete vidjeti sve izmjene u bazi</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<h2 class="phut"><span class="fas fa-box"></span> Skladište</h2>
			<table class="table table-hover ntb table-sm">
				<thead>
				<tr>
					<th><span class="fas fa-hashtag"></span> ID</th>
					<th><span class="fas fa-box"></span> Artikal</th>
					<th class="text-right"><span class="fas fa-truck"></span> Dobavljač</th>
					<th class="text-center"><span class="fas fa-file-alt"></span> Opis</th>
					<th class="text-center"><span class="fas fa-calendar-alt"></span> Datum</th>
					<th class="text-right"><span class="fas fa-cubes"></span> Količina</th>
					<th class="text-right"><span class="fas fa-dollar-sign"></span> Cijena</th>
					<th class="text-right"><span class="fas fa-euro-sign"></span> Vrijednost</th>
					<th class="text-center"><span class="fas fa-trash"></span></th>
				</tr>
				</thead>
				<tbody>
				@foreach($inout as $io)
					<tr class="rstreddd @if($io->kolicina<0)table-warning @endif klick" data-maid="{{$io->id}}"
						data-idd="{{$io->art['id']}}" data-namee="{{$io->art['ime']}}">
						<td>{{$io->id}}</td>
						<td>{{$io->art->ime}} <span
									class="text-secondary mali">{{$io->puzla?$io->puzle['ime']:""}}</span></td>

						<td class="text-right">{{$io->dobavljaci->ime}}</td>
						<td class="text-center">{{$io->opis}}</td>
						<td class="text-center">{{date("d.m.Y.",strtotime($io->datumunosa))}}</td>
						<td class="text-right">{{$io->kolicina}} <span id="mjernajedtextskl" class="font-italic"
																	   data-mjid="{{$io->art->mj->id}}"
																	   data-toggle="tooltip" data-placement="top"
																	   title="{{$io->art->mj->ime}}">{{$io->art->mj->skracenica}}</span>
						</td>
						<td class="text-right">{{number_format($io->kolicina<0?-$io->cijena/$io->kolicina:$io->cijena/$io->kolicina,2,",",".")}}
							<span data-toggle="tooltip" data-placement="top"
								  title="Konvertibilna Marka">KM</span>/
						</td>
						<td class="text-right">{{number_format($io->cijena,2,",",".")}} <span data-toggle="tooltip"
																							  data-placement="top"
																							  title="Konvertibilna Marka">KM</span>
						</td>
						<td class="text-center">
							<button class="btn btn-sm btn-danger zabr" data-idb="{{$io->id}}"><span
										class="fas fa-trash"></span></button>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
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
